<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin\ApiApp;
use App\Models\Admin\ApiGroup;
use App\Models\Admin\ApiList;
use App\tools\ReturnCode;
use App\tools\Tools;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InterfaceGroupController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->modelObj = new ApiGroup();
    }
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $limit    = $this->request->get('size', config('laravelapi.list_default'));
        $start    = $this->request->get('page', 1);
        $keywords = $this->request->get('keywords', '');
        $type     = $this->request->get('type', '');
        $status   = $this->request->get('status', '');

        $obj = new ApiGroup();
        if (strlen($status)) {
            $obj = $obj->where('status', $status);
        }
        if ($type) {
            switch ($type) {
                case 1:
                    $obj = $obj->where('hash', $keywords);
                    break;
                case 2:
                    $obj = $obj->where('name', "like", "%{$keywords}%");
                    break;
            }
        }
        $listObj = $obj->orderByDesc('create_time')->paginate($limit, ['*'], 'page', $start);

        return $this->buildSuccess([
            'list'  => $listObj->items(),
            'count' => $listObj->total()
        ]);
    }

    /**
     * 获取全部有效的接口组
     * @return array
     */
    public function getAll()
    {
        $listInfo = (new ApiGroup())->where(['status' => 1])->get();
        return $this->buildSuccess([
            'list' => $listInfo->toArray()
        ]);
    }

    /**
     * 接口组状态编辑
     * @return array
     */
    public function changeStatus()
    {
        $res    = $this->_changeStatus();
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR);
        }

        return $this->buildSuccess();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return array
     */
    public function create()
    {
        $postData = $this->request->post();
        $postData = Tools::delEmptyKey($postData);
        $res      = ApiGroup::create($postData);
        if (!$res) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR);
        }

        return $this->buildSuccess();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return array
     */
    public function edit()
    {
        $postData = $this->request->post();
        $res      = $this->modelObj->update($postData);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR);
        }

        return $this->buildSuccess();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return array
     */
    public function destroy()
    {
        $hash = $this->request->get('hash');
        if (!$hash) {
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS, '缺少必要参数');
        }
        if ($hash === 'default') {
            return $this->buildFailed(ReturnCode::INVALID, '系统预留关键数据，禁止删除！');
        }

        (new ApiList())->update(['group_hash' => 'default'], ['group_hash' => $hash]);
        $hashRule = (new ApiApp())->where('app_api_show', "like", "%$hash%")->select();
        if ($hashRule) {
            foreach ($hashRule as $rule) {
                $appApiShowArr = json_decode($rule->app_api_show, true);
                if (!empty($appApiShowArr[$hash])) {
                    if (isset($appApiShowArr['default'])) {
                        $appApiShowArr['default'] = array_merge($appApiShowArr['default'], $appApiShowArr[$hash]);
                    } else {
                        $appApiShowArr['default'] = $appApiShowArr[$hash];
                    }
                }
                unset($appApiShowArr[$hash]);
                $rule->app_api_show = json_encode($appApiShowArr);
                $rule->save();
            }
        }

        ApiGroup::where(['hash' => $hash])->delete();

        return $this->buildSuccess();
    }
}

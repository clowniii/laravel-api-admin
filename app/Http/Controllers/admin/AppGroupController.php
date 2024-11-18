<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin\AdminApp;
use App\Models\Admin\ApiApp;
use App\Models\Admin\ApiAppGroup;
use App\tools\ReturnCode;
use App\tools\Tools;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use mysql_xdevapi\Exception;

class AppGroupController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->modelObj = new ApiAppGroup();
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $limit    = $this->request->get('size', config('laravelapi.limit_default'));
        $start    = $this->request->get('page', 1);
        $keywords = $this->request->get('keywords', '');
        $type     = $this->request->get('type', '');
        $status   = $this->request->get('status', '');

        $obj = new ApiAppGroup();
        if (strlen($status)) {
            $obj = $obj->where('status', $status);
        }
        if ($type) {
            switch ($type) {
                case 1:
                    if (strlen($keywords)) {
                        $obj = $obj->where('hash', $keywords);
                    }
                    break;
                case 2:
                    $obj = $obj->where('name', 'like', "%{$keywords}%");
                    break;
            }
        }
        $listObj = $obj->paginate($limit, ['*'], 'page', $start);

        return $this->buildSuccess([
            'list'  => $listObj->items(),
            'count' => $listObj->total()
        ]);
    }

    public function getAll(): array
    {
        $listInfo = (new ApiAppGroup())->where(['status' => 1])->get()->toArray();

        return $this->buildSuccess([
            'list' => $listInfo
        ]);
    }

    public function changeStatus(): array
    {

        $res = $this->_changeStatus();

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

        try {
            $model = new ApiAppGroup();
            $model->name = $postData['name'];
            $model->description = $postData['description'];
            $model->hash = $postData['hash'];
            $model->create($postData);
            return $this->buildSuccess();
        } catch (Exception $exception) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR, $exception->getMessage());
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return array
     */
    public function edit()
    {
        $postData = $this->request->post();
        unset($postData["API_ADMIN_USER_INFO"]);
        try {
            (new ApiAppGroup)->where("id",$postData["id"])->update($postData);
            return $this->buildSuccess();
        } catch (Exception $exception) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR, $exception->getMessage());
        }
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

        $has = (new ApiApp())->where(['app_group' => $hash])->count();
        if ($has) {
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS, '当前分组存在' . $has . '个应用，禁止删除');
        }

        ApiAppGroup::where(['hash' => $hash])->delete();

        return $this->buildSuccess();
    }
}

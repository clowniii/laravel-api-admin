<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin\ApiFields;
use App\Models\Admin\ApiList;
use App\tools\ReturnCode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InterfaceListController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->modelObj = new ApiList();
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

        $obj = new ApiList();
        if (strlen($status)) {
            $obj = $obj->where('status', $status);
        }
        if ($type) {
            switch ($type) {
                case 1:
                    $obj = $obj->where('hash', $keywords);
                    break;
                case 2:
                    $obj = $obj->where('info', "like", "%{$keywords}%");
                    break;
                case 3:
                    $obj = $obj->where('api_class', "like", "%{$keywords}%");
                    break;
            }
        }
        $listObj = $obj->orderByDesc('id')->paginate($limit, ['*'], 'page', $start);

        return $this->buildSuccess([
            'list'  => $listObj->items(),
            'count' => $listObj->total()
        ]);
    }

    /**
     * 获取接口唯一标识
     * @return array
     */
    public function getHash()
    {
        return $this->buildSuccess(["hash" => uniqid()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return array
     */
    public function create()
    {
        $postData = $this->request->post();
        if (!preg_match("/^[A-Za-z0-9_\/]+$/", $postData['api_class'])) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR, '真实类名只允许填写字母，数字和/');
        }

        $res = ApiList::create($postData);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR);
        }

        return $this->buildSuccess();
    }

    public function changeStatus(): array
    {
        $hash   = $this->request->get('hash');
        $status = $this->request->get('status');
        $res    = ApiList::update([
            'status' => $status
        ], [
            'hash' => $hash
        ]);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR);
        }
        cache('ApiInfo:' . $hash, null);

        return $this->buildSuccess();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return array
     */
    public function edit()
    {
        $postData = $this->request->post();
        if (!preg_match("/^[A-Za-z0-9_\/]+$/", $postData['api_class'])) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR, '真实类名只允许填写字母，数字和/');
        }

        $res = ApiList::update($postData);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR);
        }
        cache('ApiInfo:' . $postData['hash'], null);

        return $this->buildSuccess();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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

        $hashRule = (new AdminApp())->where('app_api', "like", "%$hash%")->select();
        if ($hashRule) {
            $oldInfo = (new ApiList())->where('hash', $hash)->find();
            foreach ($hashRule as $rule) {
                $appApiArr   = explode(',', $rule->app_api);
                $appApiIndex = array_search($hash, $appApiArr);
                array_splice($appApiArr, $appApiIndex, 1);
                $rule->app_api = implode(',', $appApiArr);

                $appApiShowArrOld = json_decode($rule->app_api_show, true);
                $appApiShowArr    = $appApiShowArrOld[$oldInfo->group_hash];
                $appApiShowIndex  = array_search($hash, $appApiShowArr);
                array_splice($appApiShowArr, $appApiShowIndex, 1);
                $appApiShowArrOld[$oldInfo->group_hash] = $appApiShowArr;
                $rule->app_api_show                     = json_encode($appApiShowArrOld);

                $rule->save();
            }
        }

        ApiList::destroy(['hash' => $hash]);
        ApiFields::destroy(['hash' => $hash]);

        cache('ApiInfo:' . $hash, null);

        return $this->buildSuccess();
    }


    /**
     * 刷新接口路由
     * @return array
     */
    public function refresh()
    {
        $rootPath     = base_path();
        $apiRoutePath = $rootPath . 'route/apiRoute.php';
        $tplPath      = $rootPath . 'install/apiRoute.tpl';
        $methodArr    = ['*', 'POST', 'GET'];

        $tplOriginStr = file_get_contents($tplPath);
        $listInfo     = (new ApiList())->where('status', 1)->select();
        $tplStr       = [];
        foreach ($listInfo as $value) {
            if ($value['hash_type'] === 1) {
                $tplStr[] = 'Route::rule(\'' . addslashes($value->api_class) . '\',\'api.' . addslashes($value->api_class) . '\', \'' . $methodArr[$value->method] . '\')->middleware([app\middleware\ApiAuth::class, app\middleware\ApiPermission::class, app\middleware\RequestFilter::class, app\middleware\ApiLog::class]);';
            } else {
                $tplStr[] = 'Route::rule(\'' . addslashes($value->hash) . '\',\'api.' . addslashes($value->api_class) . '\', \'' . $methodArr[$value->method] . '\')->middleware([app\middleware\ApiAuth::class, app\middleware\ApiPermission::class, app\middleware\RequestFilter::class, app\middleware\ApiLog::class]);';
            }
        }
        $tplOriginStr = str_replace(['{$API_RULE}'], [implode(PHP_EOL . '    ', $tplStr)], $tplOriginStr);

        file_put_contents($apiRoutePath, $tplOriginStr);

        return $this->buildSuccess();
    }
}

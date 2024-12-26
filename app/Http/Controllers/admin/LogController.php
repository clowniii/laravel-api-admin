<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin\AdminUserAction;
use App\tools\ReturnCode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LogController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        $limit    = $this->request->get('size', config('apiadmin.limit_default'));
        $start    = $this->request->get('page', 1);
        $type     = $this->request->get('type', '');
        $keywords = $this->request->get('keywords', '');

        $obj = new AdminUserAction();
        if ($type) {
            switch ($type) {
                case 1:
                    $obj = $obj->where('url', "like", "%{$keywords}%");
                    break;
                case 2:
                    $obj = $obj->where('nickname', "like", "%{$keywords}%");
                    break;
                case 3:
                    $obj = $obj->where('uid', $keywords);
                    break;
            }
        }
        $listObj = $obj->orderByDesc('add_time')->paginate($limit, ['*'], 'page', $start);

        return $this->buildSuccess([
            'list'  => $listObj->items(),
            'count' => $listObj->total()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return array
     */
    public function destroy(): array
    {
        $id = $this->request->get('id');
        if (!$id) {
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS, '缺少必要参数');
        }
        AdminUserAction::destroy($id);

        return $this->buildSuccess();
    }
}

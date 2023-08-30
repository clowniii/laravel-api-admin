<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin\AdminAuthGroupAccess;
use App\Models\Admin\AdminUser;
use App\Models\Admin\AdminUserData;
use App\tools\ReturnCode;
use App\tools\Tools;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->modelObj = new AdminUser();
    }

    /**
     * Display a listing of the resource.
     *
     * @return array|Response
     */
    public function index()
    {
        $limit    = $this->request->get('size', config('laravelapi.limit_default'));
        $start    = $this->request->get('page', 1);
        $type     = $this->request->get('type', '');
        $keywords = $this->request->get('keywords', '');
        $status   = $this->request->get('status', '');

        $obj = $this->modelObj;
        if (strlen($status)) {
            $obj = $obj->where('status', $status);
        }
        if ($type) {
            switch ($type) {
                case 1:
                    $obj = $obj->where('username', "like", "%{$keywords}%");
                    break;
                case 2:
                    $obj = $obj->where('nickname', "like", "%{$keywords}%");
                    break;
            }
        }

        $listObj = $obj->with('userData')
            ->orderByDesc('create_time')
            ->paginate($limit, ['*'], "page", $start);

        $listInfo = $listObj->items();
        $idArr    = array_column($listInfo, 'id');

        $userGroup = (new AdminAuthGroupAccess())->whereIn('uid', $idArr)->get()->toArray();
        $userGroup = Tools::buildArrByNewKey($userGroup, 'uid');

        foreach ($listInfo as &$value) {
            if ($value['userData']) {
                $value['userData']['last_login_ip']   = long2ip($value['userData']['last_login_ip']);
                $value['userData']['last_login_time'] = date('Y-m-d H:i:s', $value['userData']['last_login_time']);
                $value['create_ip']                   = long2ip($value['create_ip']);
            }
            if (isset($userGroup[$value['id']])) {
                $value['group_id'] = explode(',', $userGroup[$value['id']]['group_id']);
            } else {
                $value['group_id'] = [];
            }
        }

        return $this->buildSuccess([
            'list'  => $listInfo,
            'count' => $listObj->total(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return array
     */
    public function create()
    {
        $groups                = '';
        $postData              = $this->request->post();
        $postData['create_ip'] = sprintf("%u", ip2long($this->request->ip()));
        $postData['password']  = Tools::userMd5($postData['password']);
        if (isset($postData['group_id']) && $postData['group_id']) {
            $groups = trim(implode(',', $postData['group_id']), ',');
            unset($postData['group_id']);
        }
        $res = AdminUser::create($postData);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR);
        }
        AdminAuthGroupAccess::create([
            'uid'      => $res->id,
            'group_id' => $groups,
        ]);

        return $this->buildSuccess();
    }

    /**
     * 获取当前组的全部用户
     * @return array
     */
    public function getUsers()
    {
        $limit = $this->request->get('size', config('apiadmin.ADMIN_LIST_DEFAULT'));
        $page  = $this->request->get('page', 1);
        $gid   = $this->request->get('gid', 0);
        if (!$gid) {
            return $this->buildFailed(ReturnCode::PARAM_INVALID, '非法操作');
        }

        $totalNum = (new AdminAuthGroupAccess())->where('find_in_set("' . $gid . '", `group_id`)')->count();
        $start    = $limit * ($page - 1);
        $sql      = "SELECT au.* FROM admin_user as au LEFT JOIN admin_auth_group_access as aaga " .
            " ON aaga.`uid` = au.`id` WHERE find_in_set('{$gid}', aaga.`group_id`) " .
            " ORDER BY au.create_time DESC LIMIT {$start}, {$limit}";
        $userInfo = Db::query($sql);

        $uidArr   = array_column((array)$userInfo, 'id');
        $userData = (new AdminUserData())->whereIn('uid', $uidArr)->select();
        $userData = Tools::buildArrByNewKey($userData, 'uid');

        foreach ($userInfo as $key => $value) {
            if (isset($userData[$value['id']])) {
                $userInfo[$key]['last_login_ip']   = long2ip($userData[$value['id']]['last_login_ip']);
                $userInfo[$key]['login_times']     = $userData[$value['id']]['login_times'];
                $userInfo[$key]['last_login_time'] = date('Y-m-d H:i:s', $userData[$value['id']]['last_login_time']);
            }
            $userInfo[$key]['create_ip'] = long2ip($userInfo[$key]['create_ip']);
        }

        return $this->buildSuccess([
            'list'  => $userInfo,
            'count' => $totalNum,
        ]);
    }

    public function changeStatus()
    {
        $id = $this->request->get('id');

        if (Tools::isAdministrator($id)) {
            return $this->buildFailed(ReturnCode::INVALID, "超级管理员不允许修改状态");
        }
        $res = $this->_changeStatus();
        if (!$res) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR);
        }
        if ($oldAdmin = cache('Login:' . $id)) {
            Cache::delete('Login:' . $oldAdmin);
        }

        return $this->buildSuccess();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return array
     */
    public function edit()
    {
        $groups   = '';
        $postData = $this->request->post();
        if ($postData['password'] === 'ApiAdmin') {
            unset($postData['password']);
        } else {
            $postData['password'] = Tools::userMd5($postData['password']);
        }
        if (isset($postData['group_id']) && $postData['group_id']) {
            $groups = trim(implode(',', $postData['group_id']), ',');
            unset($postData['group_id']);
        }
        $res = $this->modelObj->update($postData);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR);
        }
        $has = (new AdminAuthGroupAccess())->where('uid', $postData['id'])->select()->toArray();
        if (count($has)) {
            (new AdminAuthGroupAccess())->update([
                'group_id' => $groups,
            ], [
                'uid' => $postData['id'],
            ]);
        } else {
            (new AdminAuthGroupAccess())->create([
                'uid'      => $postData['id'],
                'group_id' => $groups,
            ]);
        }
        if ($oldAdmin = cache('Login:' . $postData['id'])) {
            cache('Login:' . $oldAdmin, null);
        }

        return $this->buildSuccess();
    }

    /**
     * 修改自己的信息
     * @return array
     */
    public function own()
    {
        $postData = $this->request->post();
        $headImg  = $postData['head_img'];

        if ($postData['password'] && $postData['oldPassword']) {
            $oldPass = Tools::userMd5($postData['oldPassword']);
            unset($postData['oldPassword']);
            if ($oldPass === $this->userInfo['password']) {
                $postData['password'] = Tools::userMd5($postData['password']);
            } else {
                return $this->buildFailed(ReturnCode::INVALID, '原始密码不正确');
            }
        } else {
            unset($postData['password']);
            unset($postData['oldPassword']);
        }
        $postData['id'] = $this->userInfo['id'];
        unset($postData['head_img']);
        $res = $this->modelObj->update($postData);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR);
        }
        $userData           = (new AdminUserData())->where('uid', $postData['id'])->find();
        $userData->head_img = $headImg;
        $userData->save();
        if ($oldWiki = cache('WikiLogin:' . $postData['id'])) {
            cache('WikiLogin:' . $oldWiki, null);
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
        $id = $this->request->get('id/d');
        if (!$id) {
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS, '缺少必要参数');
        }

        $isAdmin = Tools::isAdministrator($id);
        if ($isAdmin) {
            return $this->buildFailed(ReturnCode::INVALID, '超级管理员不能被删除');
        }
        AdminUser::destroy($id);
        AdminAuthGroupAccess::destroy(['uid' => $id]);
        if ($oldAdmin = cache('Login:' . $id)) {
            cache('Login:' . $oldAdmin, null);
        }

        return $this->buildSuccess();
    }
}

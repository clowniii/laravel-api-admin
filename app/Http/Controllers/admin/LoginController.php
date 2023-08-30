<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin\AdminAuthGroupAccess;
use App\Models\Admin\AdminAuthRule;
use App\Models\Admin\AdminMenu;
use App\Models\Admin\AdminUser;
use App\Models\Admin\AdminUserData;
use App\tools\ReturnCode;
use App\tools\RouterTool;
use App\tools\Tools;
use Cache;
use Illuminate\Http\Request;

class LoginController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */


    public function index()
    {
        $username = $this->request->post('username');
        $password = $this->request->post('password');

        if (!$username) {
            return $this->buildFailed(ReturnCode::LOGIN_ERROR, '缺少用户名!');
        }
        if (!$password) {
            return $this->buildFailed(ReturnCode::LOGIN_ERROR, '缺少密码!');
        } else {
            $password = Tools::userMd5($password);
        }
        $userInfo = (new AdminUser())->where('username', $username)->where('password', $password)->first();
        if ($userInfo) {
            if ($userInfo->status) {
                //更新用户数据
                $userData = $userInfo->userData;
                $data     = [];
                if ($userData) {
                    $userData->login_times++;
                    $userData->last_login_ip   = sprintf("%u", ip2long($this->request->ip()));
                    $userData->last_login_time = time();
                    $userData->save();
                } else {
                    $data['login_times']     = 1;
                    $data['uid']             = $userInfo->id;
                    $data['last_login_ip']   = sprintf("%u", ip2long($this->request->ip()));
                    $data['last_login_time'] = time();
                    $data['head_img']        = '';

                    $res = (new AdminUserData)->create($data);

                    $userInfo->userData = $data;
                }
            } else {
                return $this->buildFailed(ReturnCode::LOGIN_ERROR, '用户已被封禁，请联系管理员');
            }
        } else {
            return $this->buildFailed(ReturnCode::LOGIN_ERROR, '用户名密码不正确');
        }
        $userInfo->access = $this->getAccess($userInfo->id);
        $userInfo->menu   = $this->getAccessMenuData($userInfo->id);

        $apiAuth    = md5(uniqid() . time());
        $oldApiAuth = \Cache::get('Login:' . $userInfo['id']);
        \Cache::forget('Login:' . $oldApiAuth);
        \Cache::put('Login:' . $apiAuth, json_encode($userInfo), config('laravelapi.online_time'));
        \Cache::put('Login:' . $userInfo['id'], $apiAuth, config('laravelapi.online_time'));

        $userInfo->apiAuth = $apiAuth;

        return $this->buildSuccess($userInfo->toArray(), '登录成功');
    }

    public function getUserInfo(Request $request): array
    {
        return $this->buildSuccess($request["API_ADMIN_USER_INFO"]);
    }

    public function logout(): array
    {
        $ApiAuth = $this->request->header('Api-Auth');
        Cache::delete('Login:' . $ApiAuth);
        Cache::delete('Login:' . $this->userInfo['id']);

        return $this->buildSuccess([], '登出成功');
    }

    public function getAccessMenu(): array
    {
        return $this->buildSuccess($this->getAccessMenuData($this->userInfo['id']));
    }

    /**
     * 获取当前用户的允许菜单
     * @param int $uid
     * @return array
     */
    public function getAccessMenuData(int $uid): array
    {
        $returnData = [];
        $isSupper   = Tools::isAdministrator($uid);
        if ($isSupper) {
            $access     = (new AdminMenu())->where('router', '<>', '')->get()->toArray();
            $returnData = Tools::listToTree($access);
        } else {
            $groups = (new AdminAuthGroupAccess())->where('uid', $uid)->first();
            if (isset($groups) && $groups->group_id) {
                $access     = (new AdminAuthRule())->whereIn('group_id', $groups->group_id)->get()->toArray();
                $access     = array_unique(array_column($access, 'url'));
                $access[]   = "";
                $menus      = (new AdminMenu())->whereIn('url', $access)->where('show', 1)->get()->toArray();
                $returnData = Tools::listToTree($menus);
                RouterTool::buildVueRouter($returnData);
            }
        }

        return array_values($returnData);
    }

    /**
     * 获取用户权限数据
     * @param int $uid
     * @return array
     */
    public function getAccess(int $uid): array
    {
        $isSupper = Tools::isAdministrator($uid);
        if ($isSupper) {
            $AdminMenu = new AdminMenu();
            $access    = $AdminMenu->get()->toArray();
            return array_values(array_filter(array_column($access, 'url')));
        } else {
            $groups = (new AdminAuthGroupAccess())->where('uid', $uid)->first();
            if (isset($groups) && $groups->group_id) {
                $access = (new AdminAuthRule())->whereIn('group_id', $groups->group_id)->get()->toArray();
                return array_values(array_unique(array_column($access, 'url')));
            } else {
                return [];
            }
        }
    }
}

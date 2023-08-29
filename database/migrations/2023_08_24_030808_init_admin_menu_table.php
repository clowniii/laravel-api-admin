<?php

use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $data = [
            [
                'id'    => 1,
                'title'  => '用户登录',
                'fid'   => 0,
                'url'   => 'admin/Login/index',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 2,
                'title'  => '用户登出',
                'fid'   => 0,
                'url'   => 'admin/Login/logout',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 3,
                'title'  => '系统管理',
                'fid'   => 0,
                'url'   => '',
                'auth'  => 0,
                'sort'  => 1,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 4,
                'title'  => '菜单维护',
                'fid'   => 3,
                'url'   => '',
                'auth'  => 0,
                'sort'  => 1,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 5,
                'title'  => '菜单状态修改',
                'fid'   => 4,
                'url'   => 'admin/Menu/changeStatus',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 6,
                'title'  => '新增菜单',
                'fid'   => 4,
                'url'   => 'admin/Menu/add',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 7,
                'title'  => '编辑菜单',
                'fid'   => 4,
                'url'   => 'admin/Menu/edit',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 8,
                'title'  => '菜单删除',
                'fid'   => 4,
                'url'   => 'admin/Menu/del',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 9,
                'title'  => '用户管理',
                'fid'   => 3,
                'url'   => '',
                'auth'  => 0,
                'sort'  => 2,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 10,
                'title'  => '获取当前组的全部用户',
                'fid'   => 9,
                'url'   => 'admin/User/getUsers',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 11,
                'title'  => '用户状态修改',
                'fid'   => 9,
                'url'   => 'admin/User/changeStatus',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 12,
                'title'  => '新增用户',
                'fid'   => 9,
                'url'   => 'admin/User/add',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 13,
                'title'  => '用户编辑',
                'fid'   => 9,
                'url'   => 'admin/User/edit',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 14,
                'title'  => '用户删除',
                'fid'   => 9,
                'url'   => 'admin/User/del',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 15,
                'title'  => '权限管理',
                'fid'   => 3,
                'url'   => '',
                'auth'  => 0,
                'sort'  => 3,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 16,
                'title'  => '权限组状态编辑',
                'fid'   => 15,
                'url'   => 'admin/Auth/changeStatus',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 17,
                'title'  => '从指定组中删除指定用户',
                'fid'   => 15,
                'url'   => 'admin/Auth/delMember',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 18,
                'title'  => '新增权限组',
                'fid'   => 15,
                'url'   => 'admin/Auth/add',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 19,
                'title'  => '权限组编辑',
                'fid'   => 15,
                'url'   => 'admin/Auth/edit',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 20,
                'title'  => '删除权限组',
                'fid'   => 15,
                'url'   => 'admin/Auth/del',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 21,
                'title'  => '获取全部已开放的可选组',
                'fid'   => 15,
                'url'   => 'admin/Auth/getGroups',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 22,
                'title'  => '获取组所有的权限列表',
                'fid'   => 15,
                'url'   => 'admin/Auth/getRuleList',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 23,
                'title'  => '应用接入',
                'fid'   => 0,
                'url'   => '',
                'auth'  => 0,
                'sort'  => 2,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 24,
                'title'  => '应用管理',
                'fid'   => 23,
                'url'   => '',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 25,
                'title'  => '应用状态编辑',
                'fid'   => 24,
                'url'   => 'admin/App/changeStatus',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 26,
                'title'  => '获取AppId,AppSecret,接口列表,应用接口权限细节',
                'fid'   => 24,
                'url'   => 'admin/App/getAppInfo',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 27,
                'title'  => '新增应用',
                'fid'   => 24,
                'url'   => 'admin/App/add',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 28,
                'title'  => '编辑应用',
                'fid'   => 24,
                'url'   => 'admin/App/edit',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 29,
                'title'  => '删除应用',
                'fid'   => 24,
                'url'   => 'admin/App/del',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 30,
                'title'  => '接口管理',
                'fid'   => 0,
                'url'   => '',
                'auth'  => 0,
                'sort'  => 3,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 31,
                'title'  => '接口维护',
                'fid'   => 30,
                'url'   => '',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 32,
                'title'  => '接口状态编辑',
                'fid'   => 31,
                'url'   => 'admin/InterfaceList/changeStatus',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 33,
                'title'  => '获取接口唯一标识',
                'fid'   => 31,
                'url'   => 'admin/InterfaceList/getHash',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 34,
                'title'  => '添加接口',
                'fid'   => 31,
                'url'   => 'admin/InterfaceList/add',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 35,
                'title'  => '编辑接口',
                'fid'   => 31,
                'url'   => 'admin/InterfaceList/edit',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 36,
                'title'  => '删除接口',
                'fid'   => 31,
                'url'   => 'admin/InterfaceList/del',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 37,
                'title'  => '获取接口请求字段',
                'fid'   => 31,
                'url'   => 'admin/Fields/request',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 38,
                'title'  => '获取接口返回字段',
                'fid'   => 31,
                'url'   => 'admin/Fields/response',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 39,
                'title'  => '添加接口字段',
                'fid'   => 31,
                'url'   => 'admin/Fields/add',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 40,
                'title'  => '上传接口返回字段',
                'fid'   => 31,
                'url'   => 'admin/Fields/upload',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 41,
                'title'  => '编辑接口字段',
                'fid'   => 31,
                'url'   => 'admin/Fields/edit',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 42,
                'title'  => '删除接口字段',
                'fid'   => 31,
                'url'   => 'admin/Fields/del',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 43,
                'title'  => '接口分组',
                'fid'   => 30,
                'url'   => '',
                'auth'  => 0,
                'sort'  => 1,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 44,
                'title'  => '添加接口组',
                'fid'   => 43,
                'url'   => 'admin/InterfaceGroup/add',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 45,
                'title'  => '编辑接口组',
                'fid'   => 43,
                'url'   => 'admin/InterfaceGroup/edit',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 46,
                'title'  => '删除接口组',
                'fid'   => 43,
                'url'   => 'admin/InterfaceGroup/del',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 47,
                'title'  => '获取全部有效的接口组',
                'fid'   => 43,
                'url'   => 'admin/InterfaceGroup/getAll',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 48,
                'title'  => '接口组状态维护',
                'fid'   => 43,
                'url'   => 'admin/InterfaceGroup/changeStatus',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 49,
                'title'  => '应用分组',
                'fid'   => 23,
                'url'   => '',
                'auth'  => 0,
                'sort'  => 1,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 50,
                'title'  => '添加应用组',
                'fid'   => 49,
                'url'   => 'admin/AppGroup/add',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 51,
                'title'  => '编辑应用组',
                'fid'   => 49,
                'url'   => 'admin/AppGroup/edit',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 52,
                'title'  => '删除应用组',
                'fid'   => 49,
                'url'   => 'admin/AppGroup/del',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 53,
                'title'  => '获取全部可用应用组',
                'fid'   => 49,
                'url'   => 'admin/AppGroup/getAll',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 54,
                'title'  => '应用组状态编辑',
                'fid'   => 49,
                'url'   => 'admin/AppGroup/changeStatus',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 55,
                'title'  => '菜单列表',
                'fid'   => 4,
                'url'   => 'admin/Menu/index',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 56,
                'title'  => '用户列表',
                'fid'   => 9,
                'url'   => 'admin/User/index',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 57,
                'title'  => '权限列表',
                'fid'   => 15,
                'url'   => 'admin/Auth/index',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 58,
                'title'  => '应用列表',
                'fid'   => 24,
                'url'   => 'admin/App/index',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 59,
                'title'  => '应用分组列表',
                'fid'   => 49,
                'url'   => 'admin/AppGroup/index',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 60,
                'title'  => '接口列表',
                'fid'   => 31,
                'url'   => 'admin/InterfaceList/index',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 61,
                'title'  => '接口分组列表',
                'fid'   => 43,
                'url'   => 'admin/InterfaceGroup/index',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 62,
                'title'  => '日志管理',
                'fid'   => 3,
                'url'   => '',
                'auth'  => 0,
                'sort'  => 4,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 63,
                'title'  => '获取操作日志列表',
                'fid'   => 62,
                'url'   => 'admin/Log/index',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 64,
                'title'  => '删除单条日志记录',
                'fid'   => 62,
                'url'   => 'admin/Log/del',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 65,
                'title'  => '刷新路由',
                'fid'   => 31,
                'url'   => 'admin/InterfaceList/refresh',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 67,
                'title'  => '文件上传',
                'fid'   => 0,
                'url'   => 'admin/Index/upload',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 68,
                'title'  => '更新个人信息',
                'fid'   => 9,
                'url'   => 'admin/User/own',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 69,
                'title'  => '刷新AppSecret',
                'fid'   => 24,
                'url'   => 'admin/App/refreshAppSecret',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 70,
                'title'  => '获取用户信息',
                'fid'   => 9,
                'url'   => 'admin/Login/getUserInfo',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ], [
                'id'    => 71,
                'title'  => '编辑权限细节',
                'fid'   => 15,
                'url'   => 'admin/Auth/editRule',
                'auth'  => 0,
                'sort'  => 0,
                'show'  => 0,
                'icon'  => '',
                'level' => 0
            ]
        ];

        DB::table('admin_menu')->insert($data);
        var_dump(1);
        DB::statement('UPDATE `admin_menu` SET `show` = 2 WHERE `show` = 0;');
        DB::statement('UPDATE `admin_menu` SET `show` = 0 WHERE `show` = 1;');
        DB::statement('UPDATE `admin_menu` SET `show` = 1 WHERE `show` = 2;');
        DB::statement('UPDATE `admin_menu` SET `level` = 1 WHERE `fid` = 0;');
        DB::statement('UPDATE `admin_menu` SET `level` = 3 WHERE `url` != "";');
        DB::statement('UPDATE `admin_menu` SET `level` = 2 WHERE `level` = 0;');
        DB::statement('UPDATE `admin_menu` SET `auth` = 1 WHERE `url` != "admin/Login/index";');
        DB::statement('UPDATE `admin_menu` SET `method` = 2 WHERE `url` LIKE "%/upload" OR `url` LIKE "%/add" OR `url` LIKE "%/edit%";');
        DB::statement('UPDATE `admin_menu` SET `icon` = "ios-build", `component` = "", `router` = "/system" WHERE `id` = 3;');
        DB::statement('UPDATE `admin_menu` SET `icon` = "md-menu", `component` = "system/menu", `router` = "menu" WHERE `id` = 4;');
        DB::statement('UPDATE `admin_menu` SET `icon` = "ios-people", `component` = "system/user", `router` = "user" WHERE `id` = 9;');
        DB::statement('UPDATE `admin_menu` SET `icon` = "md-lock", `component` = "system/auth", `router` = "auth" WHERE `id` = 15;');
        DB::statement('UPDATE `admin_menu` SET `icon` = "ios-appstore", `component` = "", `router` = "/apps" WHERE `id` = 23;');
        DB::statement('UPDATE `admin_menu` SET `icon` = "md-list-box", `component` = "app/list", `router` = "appsList" WHERE `id` = 24;');
        DB::statement('UPDATE `admin_menu` SET `icon` = "ios-link", `component` = "", `router` = "/interface" WHERE `id` = 30;');
        DB::statement('UPDATE `admin_menu` SET `icon` = "md-infinite", `component` = "interface/list", `router` = "interfaceList" WHERE `id` = 31;');
        DB::statement('UPDATE `admin_menu` SET `icon` = "", `component` = "interface/request", `router` = "request/:hash" WHERE `id` = 37;');
        DB::statement('UPDATE `admin_menu` SET `icon` = "", `component` = "interface/response", `router` = "response/:hash" WHERE `id` = 38;');
        DB::statement('UPDATE `admin_menu` SET `icon` = "md-archive", `component` = "interface/group", `router` = "interfaceGroup" WHERE `id` = 43;');
        DB::statement('UPDATE `admin_menu` SET `icon` = "ios-archive", `component` = "app/group", `router` = "appsGroup" WHERE `id` = 49;');
        DB::statement('UPDATE `admin_menu` SET `icon` = "md-clipboard", `component` = "system/log", `router` = "log" WHERE `id` = 62;');
        DB::statement("INSERT INTO `admin_menu` (`id`, `title`, `fid`, `url`, `auth`, `sort`, `show`, `icon`, `level`, `component`, `router`, `log`, `permission`, `method`) VALUES (72, '获取用户有权限的菜单', 73, 'admin/Login/getAccessMenu', 1, 0, 0, '', 2, '', '', 0, 0, 1);");
        DB::statement("INSERT INTO `admin_menu` (`id`, `title`, `fid`, `url`, `auth`, `sort`, `show`, `icon`, `level`, `component`, `router`, `log`, `permission`, `method`) VALUES (73, '系统支撑', 0, '', 0, 0, 0, 'logo-tux', 1, '', '', 0, 0, 1);");
        DB::statement('UPDATE `admin_menu` SET `fid` = 73, `show` = 0, `level` = 2, `log` = 0, `permission` = 0, `method` = 2 WHERE `id` = 1;');
        DB::statement('UPDATE `admin_menu` SET `fid` = 73, `show` = 0, `level` = 2, `log` = 1, `permission` = 0, `method` = 1 WHERE `id` = 2;');
        DB::statement('UPDATE `admin_menu` SET `fid` = 73, `show` = 0, `level` = 2, `log` = 1, `permission` = 1, `method` = 2 WHERE `id` = 67;');
        DB::statement('UPDATE `admin_menu` SET `fid` = 73, `show` = 0, `level` = 2, `log` = 1, `permission` = 1, `method` = 2 WHERE `id` = 68;');
        DB::statement('UPDATE `admin_menu` SET `fid` = 73, `show` = 0, `level` = 2, `log` = 0, `permission` = 1, `method` = 1 WHERE `id` = 70;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

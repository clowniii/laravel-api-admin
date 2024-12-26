<?php

use Illuminate\Support\Facades\Facade;

return [

    'app_version'           => '1.0',
    'app_name'              => '【*】API管理中心',

    //鉴权相关
    'user_administrator'    => [1],

    //后台登录状态维持时间[目前只有登录和解锁会重置登录时间]
    'online_time'           => 86400,
    //AccessToken失效时间
    'access_token_time_out' => 86400,
    'company_name'          => '个人开发维护',

    //跨域配置
    'cross_domain'          => [
        'Access-Control-Allow-Origin'      => '*',
        'Access-Control-Allow-Methods'     => 'POST,PUT,GET,DELETE',
        'Access-Control-Allow-Headers'     => 'Version, Access-Token, User-Token, Api-Auth, User-Agent, Keep-Alive, Origin, No-Cache, X-Requested-With, If-Modified-Since, Pragma, Last-Modified, Cache-Control, Expires, Content-Type, X-E4M-With',
        'Access-Control-Allow-Credentials' => 'true'
    ],

    //后台列表默认一页显示数量
    'limit_default'         => 20,

];

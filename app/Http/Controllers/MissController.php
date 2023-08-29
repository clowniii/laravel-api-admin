<?php

namespace App\Http\Controllers;

use App\Http\Controllers\admin\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class MissController extends BaseController
{
    //
    public function index(Request $request)
    {

//        $value = DB::table('users')->select("*")->get();
//        foreach ($value as $k => $v){
//            Redis::hset("users","id-".$v->id,json_encode($v));
//        }
//        $value = Cache::remember('users', $seconds=10, function () {
//            return DB::table('users')->select("*")->limit(10)->get();
//        });
        return $this->buildSuccess();
//        return DB::table('admin_users')->select("*")->limit("50")->get();

//        Log::info('User failed to login.', ['id' => 111]);
//        return response("", HttpCode::HTTP_FORBIDDEN);
    }
}

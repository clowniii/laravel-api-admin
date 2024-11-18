<?php

namespace App\Http\Middleware;

use App\Models\Admin\AdminApp;
use App\Models\Admin\ApiList;
use App\tools\ReturnCode;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (\Illuminate\Http\Response|RedirectResponse) $next
     * @return JsonResponse|RedirectResponse|\Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {

        $pathParam    = [];
        $pathParamStr = str_replace($request->url() . '/', '', $request->path());
        $pathArr      = explode('/', $pathParamStr);
        $pathArrLen   = count($pathArr);
        for ($index = 0; $index < $pathArrLen; $index += 2) {
            if ($index + 1 < $pathArrLen) {
                $pathParam[$pathArr[$index]] = $pathArr[$index + 1];
            }
        }
        $apiHash = str_replace('api/', '', $request->path());

        if ($apiHash) {
            $cached = Cache::has('ApiInfo:' . $apiHash);
            if ($cached) {
                $apiInfo = Cache::get('ApiInfo:' . $apiHash);
            } else {
                $apiInfo = (new ApiList())->where('hash', $apiHash)->where('hash_type', 2)->first();
                if ($apiInfo) {
                    $apiInfo = $apiInfo->toArray();
                    Cache::delete('ApiInfo:' . $apiInfo['api_class']);
                    Cache::set('ApiInfo:' . $apiHash, $apiInfo);
                } else {
                    $apiInfo = (new ApiList())->where('api_class', $apiHash)->where('hash_type', 1)->first();
                    if ($apiInfo) {
                        $apiInfo = $apiInfo->toArray();
                        Cache::delete('ApiInfo:' . $apiInfo['hash']);
                        Cache::set('ApiInfo:' . $apiHash, $apiInfo);
                    } else {
                        return Response::json([
                            'code' => ReturnCode::DB_READ_ERROR,
                            'msg'  => '获取接口配置数据失败',
                            'data' => []
                        ]);
                    }
                }
            }

            $accessToken = $request->header('Access-Token', '');
            if (!$accessToken) {
                $accessToken = $request->post('Access-Token', '');
            }
            if (!$accessToken) {
                $accessToken = $request->get('Access-Token', '');
            }
            if (!$accessToken && !empty($pathParam['Access-Token'])) {
                $accessToken = $pathParam['Access-Token'];
            }
            if (!$accessToken) {
                return Response::json([
                    'code' => ReturnCode::AUTH_ERROR,
                    'msg'  => '缺少必要参数Access-Token',
                    'data' => []
                ]);
            }
            if ($apiInfo['access_token']) {
                $appInfo = $this->doCheck($accessToken);
            } else {
                $appInfo = $this->doEasyCheck($accessToken);
            }
            if ($appInfo === false) {
                return Response::json([
                    'code' => ReturnCode::ACCESS_TOKEN_TIMEOUT,
                    'msg'  => 'Access-Token已过期',
                    'data' => []
                ]);
            }

            $request->APP_CONF_DETAIL = $appInfo;
            $request->API_CONF_DETAIL = $apiInfo;

            return $next($request);
        } else {
            return Response::json([
                'code' => ReturnCode::AUTH_ERROR,
                'msg'  => '缺少接口Hash',
                'data' => []
            ]);
        }
    }

    /**
     * 简易鉴权，更具APP_SECRET获取应用信息
     * @param $accessToken
     * @return array|false|mixed|object
     */
    private function doEasyCheck($accessToken)
    {
        $appInfo = cache('AccessToken:Easy:' . $accessToken);
        if (!$appInfo) {
            $appInfo = (new AdminApp())->where('app_secret', $accessToken)->first();
            if (!$appInfo) {
                return false;
            } else {
                $appInfo = $appInfo->toArray();
                cache('AccessToken:Easy:' . $accessToken, $appInfo);
            }
        }

        return $appInfo;
    }

    /**
     * 复杂鉴权，需要先通过接口获取AccessToken
     * @param $accessToken
     * @return bool|mixed
     */
    private function doCheck($accessToken)
    {
        $appInfo = cache('AccessToken:' . $accessToken);
        if (!$appInfo) {
            return false;
        } else {
            return $appInfo;
        }
    }
}

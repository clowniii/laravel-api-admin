<?php

namespace App\Http\Middleware;

use App\tools\ReturnCode;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApiPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {
        $appInfo = $request->APP_CONF_DETAIL;
        $apiInfo = $request->API_CONF_DETAIL;

        $allRules = explode(',', $appInfo['app_api']);
        if (!in_array($apiInfo['hash'], $allRules)) {
            return Response::json([
                'code' => ReturnCode::INVALID,
                'msg'  => '非常抱歉，您没有权限这么做！',
                'data' => []
            ]);
        }

        return $next($request);
    }
}

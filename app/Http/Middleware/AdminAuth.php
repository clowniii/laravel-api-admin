<?php

namespace App\Http\Middleware;

use App\tools\ReturnCode;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return JsonResponse|RedirectResponse|Response
     */
    public function handle(Request $request, Closure $next)
    {
        $ApiAuth = $request->header('Api-Auth', '');

        if ($ApiAuth) {
            $userInfo = Cache::get('Login:' . $ApiAuth);
            if ($userInfo) {
                $userInfo = json_decode($userInfo, true);
            }
            if (!$userInfo || !isset($userInfo['id'])) {
                return \Illuminate\Support\Facades\Response::json([
                    'code' => ReturnCode::AUTH_ERROR,
                    'msg'  => 'ApiAuth不匹配',
                    'data' => []
                ]);
            } else {
                $request->merge(['API_ADMIN_USER_INFO' => $userInfo]);
            }
            return $next($request);
        } else {
            return \Illuminate\Support\Facades\Response::json([
                'code' => ReturnCode::AUTH_ERROR,
                'msg'  => '缺少ApiAuth',
                'data' => []
            ]);

        }
    }
}

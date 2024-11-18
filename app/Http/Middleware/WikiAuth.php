<?php

namespace App\Http\Middleware;

use App\tools\ReturnCode;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class WikiAuth
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
        $ApiAuth = $request->header('Api-Auth', '');
        if ($ApiAuth) {
            $userInfo = cache('Login:' . $ApiAuth);
            if (!$userInfo) {
                $userInfo = cache('WikiLogin:' . $ApiAuth);
            } else {
                $userInfo           = json_decode($userInfo, true);
                $userInfo['app_id'] = -1;
            }
            if (!$userInfo || !isset($userInfo['id'])) {
                return Response::json([
                    'code' => ReturnCode::AUTH_ERROR,
                    'msg'  => 'ApiAuth不匹配',
                    'data' => []
                ]);
            } else {
                $request->merge(["API_WIKI_USER_INFO"=> $userInfo]);
            }
            return $next($request);
        } else {
            return Response::json([
                'code' => ReturnCode::AUTH_ERROR,
                'msg'  => '缺少ApiAuth',
                'data' => []
            ]);
        }
    }
}

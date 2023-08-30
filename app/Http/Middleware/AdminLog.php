<?php

namespace App\Http\Middleware;

use App\Models\Admin\AdminMenu;
use App\Models\Admin\AdminUserAction;
use App\tools\ReturnCode;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminLog
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
        $userInfo = $request->API_ADMIN_USER_INFO;
        $menuInfo = (new AdminMenu())->where('url', $request->path())->first();

        if ($menuInfo) {
            $menuInfo = $menuInfo->toArray();
        } else {
            return \Illuminate\Support\Facades\Response::json([
                'code' => ReturnCode::INVALID,
                'msg'  => '当前路由非法：' . $request->path(),
                'data' => []
            ]);
        }

        AdminUserAction::create([
            'action_name' => $menuInfo['title'],
            'uid'         => $userInfo['id'],
            'nickname'    => $userInfo['nickname'],
            'add_time'    => time(),
            'url'         => $request->path(),
            'data'        => json_encode($request->except('API_ADMIN_USER_INFO'))
        ]);
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\Admin\AdminAuthGroupAccess;
use App\Models\Admin\AdminAuthGroup;
use App\Models\Admin\AdminAuthRule;
use App\tools\ReturnCode;
use App\tools\Tools;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminPermission
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
        // rule里包含了rule(路由规则), ruoter(完整路由)
        if (!$this->checkAuth($userInfo['id'], $request->path())) {
            return \Illuminate\Support\Facades\Response::json([
                'code' => ReturnCode::INVALID,
                'msg'  => '非常抱歉，您没有权限这么做！',
                'data' => []
            ]);
        }
        return $next($request);
    }

    private function checkAuth($uid, $route)
    {
        $isSupper = Tools::isAdministrator($uid);
        if (!$isSupper) {
            $rules = $this->getAuth($uid);
            return in_array($route, $rules);
        } else {
            return true;
        }
    }

    private function getAuth($uid)
    {
        $groups = (new AdminAuthGroupAccess())->where('uid', $uid)->first();
        if (isset($groups) && $groups->group_id) {
            $openGroup = (new AdminAuthGroup())->whereIn('id', $groups->group_id)->where(['status' => 1])->get();
            if (isset($openGroup)) {
                $openGroupArr = [];
                foreach ($openGroup as $group) {
                    $openGroupArr[] = $group->id;
                }
                $allRules = (new AdminAuthRule())->whereIn('group_id', $openGroupArr)->get();
                if (isset($allRules)) {
                    $rules = [];
                    foreach ($allRules as $rule) {
                        $rules[] = $rule->url;
                    }
                    return array_unique($rules);
                } else {
                    return [];
                }
            } else {
                return [];
            }
        } else {
            return [];
        }
    }
}

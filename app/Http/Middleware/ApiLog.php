<?php

namespace App\Http\Middleware;

use App\tools\ApiLogTool;
use Closure;
use Illuminate\Http\Request;

class ApiLog
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response    = $next($request);
        $requestInfo = $request->all();
        unset($requestInfo['API_CONF_DETAIL']);
        unset($requestInfo['APP_CONF_DETAIL']);

        ApiLogTool::setApiInfo((array)$request->API_CONF_DETAIL);
        ApiLogTool::setAppInfo((array)$request->APP_CONF_DETAIL);
        ApiLogTool::setRequest($requestInfo);
        ApiLogTool::setResponse($response->getData(), isset($response->getData()['code']) ? strval($response->getData()['code']) : 'null');
        ApiLogTool::setHeader((array)$request->header());
        ApiLogTool::save();

        return $response;
    }
}

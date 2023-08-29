<?php

namespace App\Http\Middleware;

use App\Models\Admin\ApiFields;
use App\tools\DataType;
use App\tools\ReturnCode;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class RequestFilter
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {
        $apiInfo = $request->API_CONF_DETAIL;
        $data    = $request->all();

        $has = Cache::has('RequestFields:NewRule:' . $apiInfo['hash']);
        if ($has) {
            $newRule = cache('RequestFields:NewRule:' . $apiInfo['hash']);
        } else {
            $rule    = (new ApiFields())->where('hash', $apiInfo['hash'])->where('type', 0)->select();
            $newRule = $this->buildValidateRule((array)$rule);
            cache('RequestFields:NewRule:' . $apiInfo['hash'], $newRule);
        }

        if ($newRule) {
            $validate = $request->validate($newRule);
            if (!$validate->check($data)) {
                return Response::json(['code' => ReturnCode::PARAM_INVALID, 'msg' => $validate->getError(), 'data' => []]);
            }
        }

        return $next($request);
    }


    /**
     * 将数据库中的规则转换成TP_Validate使用的规则数组
     * @param array $rule
     * @return array
     * @author zhaoxiang <zhaoxiang051405@gmail.com>
     */
    public function buildValidateRule(array $rule = [])
    {
        $newRule = [];
        if ($rule) {
            foreach ($rule as $value) {
                if ($value['is_must']) {
                    $newRule[$value['field_name'] . '|' . $value['info']][] = 'require';
                }
                switch ($value['data_type']) {
                    case DataType::TYPE_INTEGER:
                        $newRule[$value['field_name'] . '|' . $value['info']][] = 'number';
                        if ($value['range']) {
                            $range = htmlspecialchars_decode($value['range']);
                            $range = json_decode($range, true);
                            if (isset($range['min'])) {
                                $newRule[$value['field_name'] . '|' . $value['info']]['egt'] = $range['min'];
                            }
                            if (isset($range['max'])) {
                                $newRule[$value['field_name'] . '|' . $value['info']]['elt'] = $range['max'];
                            }
                        }
                        break;
                    case DataType::TYPE_STRING:
                        if ($value['range']) {
                            $range = htmlspecialchars_decode($value['range']);
                            $range = json_decode($range, true);
                            if (isset($range['min'])) {
                                $newRule[$value['field_name'] . '|' . $value['info']]['min'] = $range['min'];
                            }
                            if (isset($range['max'])) {
                                $newRule[$value['field_name'] . '|' . $value['info']]['max'] = $range['max'];
                            }
                        }
                        break;
                    case DataType::TYPE_ENUM:
                        if ($value['range']) {
                            $range                                                      = htmlspecialchars_decode($value['range']);
                            $range                                                      = json_decode($range, true);
                            $newRule[$value['field_name'] . '|' . $value['info']]['in'] = implode(',', $range);
                        }
                        break;
                    case DataType::TYPE_FLOAT:
                        $newRule[$value['field_name'] . '|' . $value['info']][] = 'float';
                        if ($value['range']) {
                            $range = htmlspecialchars_decode($value['range']);
                            $range = json_decode($range, true);
                            if (isset($range['min'])) {
                                $newRule[$value['field_name'] . '|' . $value['info']]['egt'] = $range['min'];
                            }
                            if (isset($range['max'])) {
                                $newRule[$value['field_name'] . '|' . $value['info']]['elt'] = $range['max'];
                            }
                        }
                        break;
                    case DataType::TYPE_ARRAY:
                        $newRule[$value['field_name']][] = 'array';
                        if ($value['range']) {
                            $range = htmlspecialchars_decode($value['range']);
                            $range = json_decode($range, true);
                            if (isset($range['min'])) {
                                $newRule[$value['field_name'] . '|' . $value['info']]['min'] = $range['min'];
                            }
                            if (isset($range['max'])) {
                                $newRule[$value['field_name'] . '|' . $value['info']]['max'] = $range['max'];
                            }
                        }
                        break;
                    case DataType::TYPE_MOBILE:
                        $newRule[$value['field_name'] . '|' . $value['info']]['regex'] = '/^1[3456789]\d{9}$/';
                        break;
                }
            }
        }

        return $newRule;
    }
}

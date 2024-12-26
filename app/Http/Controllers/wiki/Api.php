<?php

namespace App\Http\Controllers\wiki;

use App\Models\Admin\ApiApp;
use App\Models\Admin\ApiFields;
use App\Models\Admin\ApiGroup;
use App\Models\Admin\ApiList;
use App\tools\ReturnCode;
use App\tools\DataType;
use App\tools\Tools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;

class Api extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
    public function errorCode()
    {
        $codeArr = ReturnCode::getConstants();
        $codeArr = array_flip($codeArr);
        $result = [];
        $errorInfo = [
            ReturnCode::SUCCESS => '请求成功',
            ReturnCode::INVALID => '非法操作',
            ReturnCode::DB_SAVE_ERROR => '数据存储失败',
            ReturnCode::DB_READ_ERROR => '数据读取失败',
            ReturnCode::CACHE_SAVE_ERROR => '缓存存储失败',
            ReturnCode::CACHE_READ_ERROR => '缓存读取失败',
            ReturnCode::FILE_SAVE_ERROR => '文件读取失败',
            ReturnCode::LOGIN_ERROR => '登录失败',
            ReturnCode::NOT_EXISTS => '不存在',
            ReturnCode::JSON_PARSE_FAIL => 'JSON数据格式错误',
            ReturnCode::TYPE_ERROR => '类型错误',
            ReturnCode::NUMBER_MATCH_ERROR => '数字匹配失败',
            ReturnCode::EMPTY_PARAMS => '丢失必要数据',
            ReturnCode::DATA_EXISTS => '数据已经存在',
            ReturnCode::AUTH_ERROR => '权限认证失败',
            ReturnCode::OTHER_LOGIN => '别的终端登录',
            ReturnCode::VERSION_INVALID => 'API版本非法',
            ReturnCode::CURL_ERROR => 'CURL操作异常',
            ReturnCode::RECORD_NOT_FOUND => '记录未找到',
            ReturnCode::DELETE_FAILED => '删除失败',
            ReturnCode::ADD_FAILED => '添加记录失败',
            ReturnCode::UPDATE_FAILED => '更新记录失败',
            ReturnCode::PARAM_INVALID => '数据类型非法',
            ReturnCode::ACCESS_TOKEN_TIMEOUT => '身份令牌过期',
            ReturnCode::SESSION_TIMEOUT => 'SESSION过期',
            ReturnCode::UNKNOWN => '未知错误',
            ReturnCode::EXCEPTION => '系统异常',
        ];

        foreach ($errorInfo as $key => $value) {
            $result[] = [
                'en_code' => $codeArr[$key],
                'code' => $key,
                'chinese' => $value,
            ];
        }

        return $this->buildSuccess([
            'data' => $result,
            'co' => config('apiadmin.APP_NAME') . ' ' . config('apiadmin.APP_VERSION'),
        ]);
    }

    public function login(Request $request)
    {
        $appId = $request->post('username');
        $appSecret = $request->post('password');

        $appInfo = ApiApp::where('app_id', $appId)
            ->where('app_secret', $appSecret)
            ->first();

        if ($appInfo) {
            if ($appInfo->app_status) {
                $appInfo = $appInfo->toArray();
                $apiAuth = md5(uniqid() . time());
                Cache::put('WikiLogin:' . $apiAuth, $appInfo, config('apiadmin.ONLINE_TIME'));
                Cache::put('WikiLogin:' . $appInfo['id'], $apiAuth, config('apiadmin.ONLINE_TIME'));
                $appInfo['apiAuth'] = $apiAuth;

                return $this->buildSuccess($appInfo);
            } else {
                return $this->buildFailed(ReturnCode::LOGIN_ERROR,'当前应用已被封禁，请联系管理员');
            }
        } else {
            return $this->buildFailed(ReturnCode::LOGIN_ERROR,'AppId或AppSecret错误');
        }
    }

    public function groupList(Request $request)
    {
        $groupInfo = ApiGroup::all();
        $apiInfo = ApiList::all();

        $listInfo = [];
        $this->userInfo = $request["API_WIKI_USER_INFO"];
        if ($this->userInfo["app_id"] == -1) {
            $_apiInfo = [];
            foreach ($apiInfo as $aVal) {
                $_apiInfo[$aVal['group_hash']][] = $aVal;
            }
            foreach ($groupInfo as $gVal) {
                if (isset($_apiInfo[$gVal['hash']])) {
                    $gVal['api_info'] = $_apiInfo[$gVal['hash']];
                }
                $listInfo[] = $gVal;
            }
        } else {
            $apiInfo = Tools::buildArrFromObj($apiInfo, 'hash');
            $groupInfo = Tools::buildArrFromObj($groupInfo, 'hash');
            $app_api_show = json_decode($this->userInfo['app_api_show'], true);
            foreach ($app_api_show as $key => $item) {
                $_listInfo = $groupInfo[$key];
                foreach ($item as $apiItem) {
                    $_listInfo['api_info'][] = $apiInfo[$apiItem];
                }
                if (isset($_listInfo['api_info'])) {
                    $listInfo[] = $_listInfo;
                }
            }
        }

        return $this->buildSuccess([
            'data' => $listInfo,
            'co' => config('laravelApi.app_name') . ' ' . config('laravelApi.app_version'),
        ]);
    }

    public function detail(Request $request)
    {
        $hash = $request->get('hash');
        if (!$hash) {
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS,'缺少必要参数');
        }

        $apiList = ApiList::where('hash', $hash)->first();
        if (!$apiList) {
            return $this->buildFailed(ReturnCode::PARAM_INVALID,'接口hash非法');
        }
        $requestFields = ApiFields::where('hash', $hash)->where('type', 0)->get();
        $responseFields = ApiFields::where('hash', $hash)->where('type', 1)->get();
        $dataType = [
            DataType::TYPE_INTEGER => 'Integer',
            DataType::TYPE_STRING => 'String',
            DataType::TYPE_BOOLEAN => 'Boolean',
            DataType::TYPE_ENUM => 'Enum',
            DataType::TYPE_FLOAT => 'Float',
            DataType::TYPE_FILE => 'File',
            DataType::TYPE_ARRAY => 'Array',
            DataType::TYPE_OBJECT => 'Object',
            DataType::TYPE_MOBILE => 'Mobile',
        ];

        $groupInfo = ApiGroup::where('hash', $apiList['group_hash'])->first();
        ApiGroup::where('hash', $apiList['group_hash'])->increment('hot');

        $url = $request->getSchemeAndHttpHost() . '/api/' . ($apiList['hash_type'] === 1 ? $apiList['api_class'] : $hash);

        return $this->buildSuccess([
            'request' => $requestFields,
            'response' => $responseFields,
            'dataType' => $dataType,
            'apiList' => $apiList,
            'url' => $url,
            'co' => config('laravelApi.app_name') . ' ' . config('laravelApi.app_version'),
        ]);
    }

    public function logout(Request $request)
    {
        $ApiAuth = $request->header('ApiAuth');
        Cache::forget('WikiLogin:' . $ApiAuth);
        Cache::forget('WikiLogin:' . $request["API_WIKI_USER_INFO"]["id"]);

        $oldAdmin = Cache::get('Login:' . $ApiAuth);
        if ($oldAdmin) {
            Cache::forget('Login:' . $ApiAuth);
            Cache::forget('Login:' . $oldAdmin['id']);
        }

        return $this->buildSuccess();
    }
}


<?php
/**
 * 数据类型维护
 * 特别注意：这里的数据类型包含但不限于常规数据类型，可能会存在系统自己定义的数据类型
 */

namespace App\tools;

use App\Models\Admin\AdminMenu;

class ApiLogTool
{
    private static $appInfo   = 'null';
    private static $apiInfo   = 'null';
    private static $request   = 'null';
    private static $response  = 'null';
    private static $header    = 'null';
    private static $userInfo  = 'null';
    private static $separator = ' | ';

    /**
     * 设置应用信息
     * @param array $data
     * @desc appId|appName|deviceId
     */
    public static function setAppInfo(array $data): void
    {
        self::$appInfo =
            ($data['app_id'] ?? 'null') . self::$separator .
            ($data['app_name'] ?? 'null') . self::$separator .
            ($data['device_id'] ?? 'null');
    }

    /**
     * 设置请求头日志数据
     * @param array $data
     * @desc accessToken|version
     */
    public static function setHeader(array $data): void
    {
        $accessToken  = (isset($data['access-token']) && !empty($data['access-token'])) ? $data['access-token'] : 'null';
        $version      = (isset($data['version']) && !empty($data['version'])) ? $data['version'] : 'null';
        self::$header = $accessToken . self::$separator . $version;
    }

    /**
     * 设置Api日志数据
     * @param array $data
     * @desc hash|apiClass
     */
    public static function setApiInfo(array $data): void
    {
        self::$apiInfo =
            ($data['hash'] ?? 'null') . self::$separator .
            ($data['api_class'] ?? 'null');
    }

    /**
     * 这部分的日志其实很关键，但是由于不再强制检测UserToken，所以这部分日志暂时不生效，请大家各自适配
     * @param $data
     */
    public static function setUserInfo($data): void
    {
        if (is_array($data) || is_object($data)) {
            $data           = json_encode($data);
            self::$userInfo = $data;
        }
    }

    /**
     * 设置请求信息
     * @param $data
     */
    public static function setRequest($data): void
    {
        if (is_array($data) || is_object($data)) {
            $data = json_encode($data);
        }
        self::$request = $data;
    }

    /**
     * 设置返回的信息
     * @param $data
     * @param string $code
     * @desc 返回码|数据
     */
    public static function setResponse($data, string $code = ''): void
    {
        if (is_array($data) || is_object($data)) {
            $data = json_encode($data);
        }
        self::$response = $code . self::$separator . $data;
    }

    /**
     * 保存接口日志数据
     */
    public static function save(): void
    {
        $logPath = storage_path() . 'ApiLog' . DIRECTORY_SEPARATOR;
        $logStr  = implode(self::$separator, array(
            '[' . date('Y-m-d H:i:s') . ']',
            self::$apiInfo,
            self::$request,
            self::$header,
            self::$response,
            self::$appInfo,
            self::$userInfo
        ));
        if (!file_exists($logPath)) {
            mkdir($logPath, 0755, true);
        }
        @file_put_contents($logPath . date('YmdH') . '.log', $logStr . "\n", FILE_APPEND);
    }

    /**
     * 保存日志文件
     * @param string $log 被记录的内容
     * @param string $type 日志文件名称
     * @param string $filePath
     */
    public static function writeLog(string $log, string $type = 'sql', string $filePath = ''): void
    {
        if (!$filePath) {
            $filePath = storage_path() . $type . DIRECTORY_SEPARATOR;
        } else {
            $filePath = $filePath . $type . DIRECTORY_SEPARATOR;
        }
        $filename = $filePath . date("YmdH") . ".log";
        if (!file_exists($filePath)) {
            mkdir($filePath, 0755, true);
        }
        @$handle = fopen($filename, "a+");
        @fwrite($handle, date('Y-m-d H:i:s') . "\t" . $log . "\r\n");
        @fclose($handle);
    }
}

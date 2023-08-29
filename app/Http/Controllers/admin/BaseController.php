<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin\AdminUser;
use App\Models\Admin\AdminUserData;
use App\tools\ReturnCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    //
    private array        $debug    = [];
    protected array|null $userInfo;
    public Request       $request;
    public Model|null    $modelObj = null;

    public function __construct(Request $request)
    {
        $this->request  = $request;

        $this->userInfo = $request['API_ADMIN_USER_INFO'];
    }

    public function buildSuccess(array|null $data = [], string $msg = '操作成功', int $code = ReturnCode::SUCCESS)
    {
        $return = [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        ];
        if (config('app.debug') && $this->debug) {
            $return['debug'] = $this->debug;
        }

        return $return;
    }

    public function buildFailed(int $code, string $msg = '操作失败', array|null $data = [])
    {
        $return = [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        ];
        if (config('app.debug') && $this->debug) {
            $return['debug'] = $this->debug;
        }

        return $return;
    }

    /**
     * debug参数收集
     * @param $data
     */
    protected function debug($data): void
    {
        if ($data) {
            $this->debug[] = $data;
        }
    }

    public function updateUserInfo(array $data, bool $isDetail = false): void
    {
        $apiAuth = $this->request->header('Api-Auth');
        if ($isDetail) {
            (new \App\Models\Admin\AdminUserData)->update($data, ['uid' => $this->userInfo['id']]);
            $this->userInfo['userData'] = (new AdminUserData())->where('uid', $this->userInfo['id'])->find();
        } else {
            (new \App\Models\Admin\AdminUser)->update($data, ['id' => $this->userInfo['id']]);
            $detail                     = $this->userInfo['userData'];
            $this->userInfo             = (new AdminUser())::where('id', $this->userInfo['id'])->find();
            $this->userInfo['userData'] = $detail;
        }

        cache('Login:' . $apiAuth, json_encode($this->userInfo), config('laravelapi.ONLINE_TIME'));
    }

    public function _changeStatus($data, $model): bool
    {

        if ($model->update($data)) {
            return true;
        }
        return false;
    }

    public function upload(): array
    {
        $path     = '/upload/' . date('Ymd', time()) . '/';
        $name     = $_FILES['file']['name'];
        $tmp_name = $_FILES['file']['tmp_name'];
        $error    = $_FILES['file']['error'];
        //过滤错误
        if ($error) {
            $error_message = match ($error) {
                1 => '您上传的文件超过了PHP.INI配置文件中UPLOAD_MAX-FILESIZE的大小',
                2 => '您上传的文件超过了PHP.INI配置文件中的post_max_size的大小',
                3 => '文件只被部分上传',
                4 => '文件不能为空',
                default => '未知错误',
            };
            die($error_message);
        }
        $arr_name = explode('.', $name);
        $hz       = array_pop($arr_name);
        $new_name = md5(time() . uniqid()) . '.' . $hz;
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $path)) {
            mkdir($_SERVER['DOCUMENT_ROOT'] . $path, 0755, true);
        }
        if (move_uploaded_file($tmp_name, $_SERVER['DOCUMENT_ROOT'] . $path . $new_name)) {
            return $this->buildSuccess([
                'fileName' => $new_name,
                'fileUrl'  => $this->request->domain() . $path . $new_name
            ]);
        } else {
            return $this->buildFailed(ReturnCode::FILE_SAVE_ERROR, '文件上传失败');
        }
    }
}

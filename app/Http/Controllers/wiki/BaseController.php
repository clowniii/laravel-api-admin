<?php

namespace App\Http\Controllers\wiki;

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
        $this->request = $request;
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

}

<?php

namespace App\Models\Admin;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Admin\AdminApp
 *
 * @mixin Eloquent
 * @method static Builder|ApiApp newModelQuery()
 * @method static Builder|ApiApp newQuery()
 * @method static Builder|ApiApp query()
 * @property int $id
 * @property string $app_id 应用id
 * @property string $app_secret 应用密码
 * @property string $app_name 应用名称
 * @property int $app_status 应用状态：0表示禁用，1表示启用
 * @property string|null $app_info 应用说明
 * @property string|null $app_api 当前应用允许请求的全部API接口
 * @property string $app_group 当前应用所属的应用组唯一标识
 * @property int $app_add_time 应用创建时间
 * @property string|null $app_api_show 前台样式显示所需数据格式
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|ApiApp whereAppAddTime($value)
 * @method static Builder|ApiApp whereAppApi($value)
 * @method static Builder|ApiApp whereAppApiShow($value)
 * @method static Builder|ApiApp whereAppGroup($value)
 * @method static Builder|ApiApp whereAppId($value)
 * @method static Builder|ApiApp whereAppInfo($value)
 * @method static Builder|ApiApp whereAppName($value)
 * @method static Builder|ApiApp whereAppSecret($value)
 * @method static Builder|ApiApp whereAppStatus($value)
 * @method static Builder|ApiApp whereCreatedAt($value)
 * @method static Builder|ApiApp whereId($value)
 * @method static Builder|ApiApp whereUpdatedAt($value)
 */
class ApiApp extends Model
{
    use HasFactory;

    protected $table = "api_app";

    protected int         $id;
    protected string      $app_id;//应用id
    protected string      $app_secret;//应用密码
    protected string      $app_name;//应用名称
    protected int         $app_status;//应用状态：0表示禁用，1表示启用
    protected string|null $app_info;//应用说明
    protected string|null $app_api;//当前应用允许请求的全部API接口
    protected string      $app_group;//当前应用所属的应用组唯一标识
    protected int         $app_add_time;//应用创建时间
    protected string|null $app_api_show;//前台样式显示所需数据格式

    protected $fillable = [
        'id',
        'app_id',
        'app_secret',//应用密码
        'app_name',//应用名称
        'app_status',//应用状态：0表示禁用，1表示启用
        'app_info',//应用说明
        'app_api',//当前应用允许请求的全部API接口
        'app_group',//当前应用所属的应用组唯一标识
        'app_add_time',//应用创建时间
        'app_api_show'//前台样式显示所需数据格式
    ];
}

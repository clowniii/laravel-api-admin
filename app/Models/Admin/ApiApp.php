<?php

namespace App\Models\Admin;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\AdminApp
 *
 * @mixin Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|AdminApp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminApp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminApp query()
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AdminApp whereAppAddTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminApp whereAppApi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminApp whereAppApiShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminApp whereAppGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminApp whereAppId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminApp whereAppInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminApp whereAppName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminApp whereAppSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminApp whereAppStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminApp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminApp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminApp whereUpdatedAt($value)
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
}

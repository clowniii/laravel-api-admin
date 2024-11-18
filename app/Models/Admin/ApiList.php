<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\ApiList
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ApiList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApiList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApiList query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $api_class api索引，保存了类和方法
 * @property string $hash api唯一标识
 * @property int $access_token 认证方式 1：复杂认证，0：简易认证
 * @property int $status API状态：0表示禁用，1表示启用
 * @property int $method 请求方式0：不限1：Post，2：
 * @property string $info api中文说明
 * @property int $is_test 是否是测试模式：0:生产模式，1：测试模式
 * @property string|null $return_str 返回数据示例
 * @property string $group_hash 当前接口所属的接口分组
 * @property int $hash_type 是否采用hash映射， 1：普通模式 2：加密模式
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ApiList whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiList whereApiClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiList whereGroupHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiList whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiList whereHashType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiList whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiList whereIsTest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiList whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiList whereReturnStr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiList whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiList whereUpdatedAt($value)
 */
class ApiList extends Model
{
    use HasFactory;

    protected $table = "api_list";

    protected int         $id;
    protected string      $api_class;// api索引，保存了类和方法
    protected string      $hash;// api唯一标识
    protected int         $access_token;//认证方式 1：复杂认证，0：简易认证
    protected int         $status;//API状态：0表示禁用，1表示启用
    protected int         $method;// 请求方式0：不限1：Post，2：
    protected string      $info;//api中文说明
    protected int         $is_test;//是否是测试模式：0:生产模式，1：测试模式
    protected string|null $return_str;//返回数据示例
    protected string      $group_hash;// 当前接口所属的接口分组
    protected int         $hash_type;//是否采用hash映射， 1：普通模式 2：加密模式
    protected $fillable = [
        'api_class',
        'hash',
        'access_token',
        'status',
        'method',
        'info',
        'is_test',
        'return_str',
        'group_hash',
        'hash_type',
    ];
}

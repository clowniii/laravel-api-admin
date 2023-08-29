<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\ApiFields
 *
 * @property int $id
 * @property string $field_name 字段名称
 * @property string $hash 权限所属组的ID
 * @property int $data_type 数据类型，来源于DataType类库
 * @property string $default 默认值
 * @property int $is_must 是否必须 0为不必须，1为必须
 * @property string $range 范围，Json字符串，根据数据类型有不一样的含义
 * @property string $info 字段说明
 * @property int $type 字段用处：0为request，1为response
 * @property string $show_name wiki显示用字段
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ApiFields newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApiFields newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApiFields query()
 * @method static \Illuminate\Database\Eloquent\Builder|ApiFields whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiFields whereDataType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiFields whereDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiFields whereFieldName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiFields whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiFields whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiFields whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiFields whereIsMust($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiFields whereRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiFields whereShowName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiFields whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiFields whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $show_title wiki显示用字段
 * @method static \Illuminate\Database\Eloquent\Builder|ApiFields whereShowTitle($value)
 */
class ApiFields extends Model
{
    use HasFactory;

    protected $table = "api_fields";

    protected int    $id;
    protected string $field_name;//字段名称
    protected string $hash;//权限所属组的ID
    protected int    $data_type;//数据类型，来源于DataType类库
    protected string $default;// 默认值
    protected int    $is_must;//是否必须 0为不必须，1为必须
    protected string $range;//范围，Json字符串，根据数据类型有不一样的含义
    protected string $info;//字段说明
    protected int    $type;//字段用处：0为request，1为response
    protected string $show_name;//wiki显示用字段
}

<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\ApiGroup
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ApiGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApiGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApiGroup query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name 组名称
 * @property string|null $description 组说明
 * @property int $status 状态：为1正常，为0禁用
 * @property string $hash 组标识
 * @property int $create_time 创建时间
 * @property int $update_time 修改时间
 * @property string|null $image 分组封面图
 * @property int $hot 分组热度
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ApiGroup whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiGroup whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiGroup whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiGroup whereHot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiGroup whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiGroup whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiGroup whereUpdateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiGroup whereUpdatedAt($value)
 */
class ApiGroup extends Model
{
    use HasFactory;

    protected $table = "api_group";

    protected int         $id;
    protected string      $name;//组名称
    protected string|null $description;// 组说明
    protected int         $status;//状态：为1正常，为0禁用
    protected string      $hash;// 组标识
    protected int         $create_time;//创建时间
    protected int         $update_time;//修改时间
    protected string|null $image;//分组封面图
    protected int         $hot;//分组热度
}

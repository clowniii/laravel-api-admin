<?php

namespace App\Models\Front;

use App\Models\Front\FrontRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Front\FrontRights
 *
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $id 权限ID
 * @property int $parent_id 父级权限ID
 * @property string $right_name 权限名称
 * @property string|null $description 权限描述
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRights newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRights newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRights query()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRights whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRights whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRights whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRights whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRights whereRightName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRights whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FrontRights extends Model
{
    use HasFactory;
    //数据库表名
    protected $table = 'front_rights';

    //不可批量赋值字段
    protected $guarded = [];

    //禁止自动维护时间字段
    public $timestamps = false;

}

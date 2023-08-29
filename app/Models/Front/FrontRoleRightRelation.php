<?php

namespace App\Models\Front;

use App\Models\Front\FrontRoles;
use App\Models\Front\FrontRights;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Front\FrontRoleRightRelation
 *
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $id 记录标识
 * @property int $role_id 角色
 * @property int $right_id 权限
 * @property int $right_type 权限类型
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRoleRightRelation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRoleRightRelation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRoleRightRelation query()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRoleRightRelation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRoleRightRelation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRoleRightRelation whereRightId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRoleRightRelation whereRightType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRoleRightRelation whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRoleRightRelation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FrontRoleRightRelation extends Model
{
    use HasFactory;
    //数据库表名
    protected $table = 'front_role_right_relation';

    //不可批量赋值字段
    protected $guarded = [];

    //禁止自动维护时间字段
    public $timestamps = false;

}

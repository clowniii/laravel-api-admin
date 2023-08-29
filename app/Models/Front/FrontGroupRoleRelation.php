<?php

namespace App\Models\Front;

use App\Models\Front\FrontRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Front\FrontGroupRoleRelation
 *
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $id 记录标识
 * @property int $group_id 组
 * @property int $role_id 角色
 * @method static \Illuminate\Database\Eloquent\Builder|FrontGroupRoleRelation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontGroupRoleRelation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontGroupRoleRelation query()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontGroupRoleRelation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontGroupRoleRelation whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontGroupRoleRelation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontGroupRoleRelation whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontGroupRoleRelation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FrontGroupRoleRelation extends Model
{
    use HasFactory;

    //数据库表名
    protected $table = 'front_group_role_relation';
    //不可批量赋值字段
    protected $guarded = [];
    //禁止自动维护时间字段
    public $timestamps = false;

}

<?php

namespace App\Models\Front;

use App\Models\Front\FrontRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Front\FrontUserRoleRelation
 *
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $id 记录标识
 * @property int $user_id 用户
 * @property int $role_id 角色
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserRoleRelation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserRoleRelation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserRoleRelation query()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserRoleRelation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserRoleRelation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserRoleRelation whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserRoleRelation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserRoleRelation whereUserId($value)
 * @mixin \Eloquent
 */
class FrontUserRoleRelation extends Model
{
    use HasFactory;

    //数据库表名
    protected $table = 'front_user_role_relation';

    //不可批量赋值字段
    protected $guarded = [];

    //禁止自动维护时间字段
    public $timestamps = false;

}

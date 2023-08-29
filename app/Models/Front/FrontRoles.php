<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Front\FrontRoles
 *
 * @property int $id 角色ID
 * @property int $parent_id 父级角色ID
 * @property string $role_name 角色名称
 * @property string|null $description 角色描述
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRoles newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRoles newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRoles query()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRoles whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRoles whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRoles whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRoles whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRoles whereRoleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontRoles whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FrontRoles extends Model
{
    use HasFactory;
    //数据库表名
    protected $table = 'front_roles';

    //不可批量赋值字段
    protected $guarded = [];

    //禁止自动维护时间字段
    public $timestamps = false;

}

<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Front\FrontOrganization
 *
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $id 记录标识
 * @property int $parent_id 父级组织
 * @property string $org_name 组织名称
 * @property string|null $description 描述
 * @method static \Illuminate\Database\Eloquent\Builder|FrontOrganization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontOrganization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontOrganization query()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontOrganization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontOrganization whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontOrganization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontOrganization whereOrgName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontOrganization whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontOrganization whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FrontOrganization extends Model
{
    use HasFactory;

    //数据库表名
    protected $table = 'front_organization';

    //不可批量赋值字段
    protected $guarded = [];

    //禁止自动维护时间字段
    public $timestamps = false;

}

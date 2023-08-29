<?php

namespace App\Models\Front;

use App\Models\Front\FrontRights;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Front\FrontGroupRightRelation
 *
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $id 记录标识
 * @property int $group_id 组
 * @property int $right_id 权限
 * @property int $right_type 权限类型
 * @method static \Illuminate\Database\Eloquent\Builder|FrontGroupRightRelation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontGroupRightRelation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontGroupRightRelation query()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontGroupRightRelation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontGroupRightRelation whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontGroupRightRelation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontGroupRightRelation whereRightId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontGroupRightRelation whereRightType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontGroupRightRelation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FrontGroupRightRelation extends Model
{
    use HasFactory;

    //数据库表名
    protected $table = 'front_group_right_relation';
    //不可批量赋值字段
    protected $guarded = [];
    //禁止自动维护时间字段
    public $timestamps = false;

}

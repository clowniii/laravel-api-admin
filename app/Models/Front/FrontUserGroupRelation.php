<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Front\FrontUserGroupRelation
 *
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $id 记录标识
 * @property int $user_id 用户
 * @property int $group_id 组
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserGroupRelation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserGroupRelation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserGroupRelation query()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserGroupRelation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserGroupRelation whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserGroupRelation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserGroupRelation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserGroupRelation whereUserId($value)
 * @mixin \Eloquent
 */
class FrontUserGroupRelation extends Model
{
    use HasFactory;

    //数据库表名
    protected $table = 'front_user_group_relation';

    //不可批量赋值字段
    protected $guarded = [];

    //禁止自动维护时间字段
    public $timestamps = false;

}

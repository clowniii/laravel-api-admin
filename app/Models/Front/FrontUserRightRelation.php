<?php

namespace App\Models\Front;

use App\Models\Front\FrontRights;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Front\FrontUserRightRelation
 *
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $id 记录标识
 * @property int $user_id 用户
 * @property int $right_id 权限
 * @property int $right_type 权限类型
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserRightRelation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserRightRelation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserRightRelation query()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserRightRelation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserRightRelation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserRightRelation whereRightId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserRightRelation whereRightType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserRightRelation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUserRightRelation whereUserId($value)
 * @mixin \Eloquent
 */
class FrontUserRightRelation extends Model
{
    use HasFactory;

    //数据库表名
    protected $table = 'front_user_right_relation';

    //不可批量赋值字段
    protected $guarded = [];

    //禁止自动维护时间字段
    public $timestamps = false;

}

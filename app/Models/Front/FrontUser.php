<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Front\FrontUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontUser query()
 * @mixin \Eloquent
 */
class FrontUser extends Model
{
    use HasFactory;
    //数据库表名
    protected $table = 'front_users';

    //不可批量赋值字段
    protected $guarded = [];

    //隐藏的字段
    protected $hidden = ['password'];

    //禁止自动维护时间字段
    public $timestamps = false;
}

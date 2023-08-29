<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Front\FrontGroup
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FrontGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontGroup query()
 * @mixin \Eloquent
 */
class FrontGroup extends Model
{
    use HasFactory;
    //数据库表名
    protected $table = 'front_groups';

    //不可批量赋值字段
    protected $guarded = [];

    //禁止自动维护时间字段
    public $timestamps = false;


}

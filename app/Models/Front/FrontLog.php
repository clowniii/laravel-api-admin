<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Front\FrontLog
 *
 * @property int $log_id 记录标识
 * @property int $op_type 操作类型
 * @property string $content 操作内容
 * @property int $user_id 操作用户
 * @property string $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|FrontLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontLog whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontLog whereLogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontLog whereOpType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontLog whereUserId($value)
 * @mixin \Eloquent
 */
class FrontLog extends Model
{
    use HasFactory;
    //数据库表名
    protected $table = 'front_log';
    //不可批量赋值字段
    protected $guarded = [];
    //禁止自动维护时间字段
    public $timestamps = false;

}

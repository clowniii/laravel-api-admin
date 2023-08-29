<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\AdminUserAction
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserAction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserAction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserAction query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $action_name 行为名称
 * @property int $uid 操作用户ID
 * @property string $nickname 用户昵称
 * @property int $add_time 操作时间
 * @property string|null $data 用户提交的数据
 * @property string $url 操作URL
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserAction whereActionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserAction whereAddTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserAction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserAction whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserAction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserAction whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserAction whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserAction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserAction whereUrl($value)
 * @property string $nicktitle 用户昵称
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserAction whereNicktitle($value)
 */
class AdminUserAction extends Model
{
    use HasFactory;

    protected $table = "admin_user_action";

    protected int         $id;
    protected string      $action_name; //行为名称
    protected int         $uid; //操作用户ID
    protected string      $nickname; //用户昵称
    protected int         $add_time; //操作时间
    protected string|null $data; //用户提交的数据
    protected string      $url; //操作URL

    protected $fillable = [
        'action_name',
        'uid',
        'nickname',
        'add_time',
        'url',
        'data'
    ];
}

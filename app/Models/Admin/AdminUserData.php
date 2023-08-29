<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Admin\AdminUserData
 *
 * @property int $id
 * @property int $login_times 账号登录次数
 * @property int $last_login_ip 最后登录IP
 * @property int $last_login_time 最后登录时间
 * @property int $uid 用户ID
 * @property string|null $head_img 用户头像
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|AdminUserData newModelQuery()
 * @method static Builder|AdminUserData newQuery()
 * @method static Builder|AdminUserData query()
 * @method static Builder|AdminUserData whereCreatedAt($value)
 * @method static Builder|AdminUserData whereHeadImg($value)
 * @method static Builder|AdminUserData whereId($value)
 * @method static Builder|AdminUserData whereLastLoginIp($value)
 * @method static Builder|AdminUserData whereLastLoginTime($value)
 * @method static Builder|AdminUserData whereLoginTimes($value)
 * @method static Builder|AdminUserData whereUid($value)
 * @method static Builder|AdminUserData whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdminUserData extends Model
{
    use HasFactory;

    protected $fillable = [
        'login_times',
        'last_login_ip',
        'last_login_time',
        'uid',
        'head_img',
    ];

    protected int         $id;
    protected int         $login_times;//账号登录次数
    protected int         $last_login_ip;//最后登录IP
    protected int         $last_login_time;//最后登录时间
    protected int         $uid;//用户ID
    protected string|null $head_img;//用户头像

    protected $table = "admin_user_data";
}

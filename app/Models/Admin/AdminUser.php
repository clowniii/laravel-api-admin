<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Admin\AdminUser
 *
 * @method static Builder|AdminUser newModelQuery()
 * @method static Builder|AdminUser newQuery()
 * @method static Builder|AdminUser query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $username 用户名
 * @property string $nickname 用户昵称
 * @property string $password 用户密码
 * @property int $create_time 注册时间
 * @property int $create_ip 注册IP
 * @property int $update_time 更新时间
 * @property int $status 账号状态 0封号 1正常
 * @property string $openid 三方登录唯一ID
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|AdminUser whereCreateIp($value)
 * @method static Builder|AdminUser whereCreateTime($value)
 * @method static Builder|AdminUser whereCreatedAt($value)
 * @method static Builder|AdminUser whereId($value)
 * @method static Builder|AdminUser whereNickname($value)
 * @method static Builder|AdminUser whereOpenid($value)
 * @method static Builder|AdminUser wherePassword($value)
 * @method static Builder|AdminUser whereStatus($value)
 * @method static Builder|AdminUser whereUpdateTime($value)
 * @method static Builder|AdminUser whereUpdatedAt($value)
 * @method static Builder|AdminUser whereUsername($value)
 * @property AdminUserData|null $access
 * @property AdminUserData|null $menu
 * @property AdminUserData|null $userData
 */
class AdminUser extends Model
{
    use HasFactory;

    protected        $table = "admin_user";
    protected int    $id;
    protected string $username;
    protected string $nickname;
    protected string $password;
    protected int    $status;
    protected string $openid;
    protected string $create_ip;
    protected string $created_at;
    protected string $updated_at;
    protected array  $access;
    protected array  $menu;
    protected string $apiAuth;

    public function userData(): HasOne
    {
        return $this->hasOne(AdminUserData::class, 'uid', 'id');
    }

}

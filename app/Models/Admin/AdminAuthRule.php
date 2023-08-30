<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\AdminAuthRule
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthRule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthRule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthRule query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $url 规则唯一标识
 * @property int $group_id 权限所属组的ID
 * @property int $auth 权限数值
 * @property int $status 状态：为1正常，为0禁用
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthRule whereAuth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthRule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthRule whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthRule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthRule whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthRule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthRule whereUrl($value)
 */
class AdminAuthRule extends Model
{
    use HasFactory;

    protected $table = "admin_auth_rule";

    protected $fillable = [
        'id',
        'url',
        'group_id',
        'auth',
        'status',
    ];
}

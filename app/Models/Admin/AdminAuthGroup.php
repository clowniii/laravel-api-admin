<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\AdminAppAuthGroup
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthGroup query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name 组名称
 * @property string|null $description 组描述
 * @property int $status 组状态：为1正常，为0禁用
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthGroup whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthGroup whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthGroup whereUpdatedAt($value)
 */
class AdminAuthGroup extends Model
{
    use HasFactory;
    protected $table = "admin_auth_group";
}

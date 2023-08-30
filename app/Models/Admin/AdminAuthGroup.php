<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\AdminAppAuthGroup
 *
 * @method static Builder|AdminAuthGroup newModelQuery()
 * @method static Builder|AdminAuthGroup newQuery()
 * @method static Builder|AdminAuthGroup query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name 组名称
 * @property string|null $description 组描述
 * @property int $status 组状态：为1正常，为0禁用
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|AdminAuthGroup whereCreatedAt($value)
 * @method static Builder|AdminAuthGroup whereDescription($value)
 * @method static Builder|AdminAuthGroup whereId($value)
 * @method static Builder|AdminAuthGroup whereName($value)
 * @method static Builder|AdminAuthGroup whereStatus($value)
 * @method static Builder|AdminAuthGroup whereUpdatedAt($value)
 */
class AdminAuthGroup extends Model
{
    use HasFactory;

    protected $table    = "admin_auth_group";
    protected $fillable = [
        'id',
        'name',
        'description',
        'status',
    ];
}

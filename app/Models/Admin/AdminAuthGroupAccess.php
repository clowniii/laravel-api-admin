<?php

namespace App\Models\Admin;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Admin\AdminAuthGroupAccess
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthGroupAccess newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthGroupAccess newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthGroupAccess query()
 * @mixin Eloquent
 * @property int $id
 * @property int $uid
 * @property string $group_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthGroupAccess whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthGroupAccess whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthGroupAccess whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthGroupAccess whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminAuthGroupAccess whereUpdatedAt($value)
 */
class AdminAuthGroupAccess extends Model
{
    use HasFactory;

    protected $table = "admin_auth_group_access";

    protected int    $id;
    protected int    $uid;
    protected string $group_id;

    protected $fillable = [
        'id',
        'uid',
        'group_id',
    ];
}

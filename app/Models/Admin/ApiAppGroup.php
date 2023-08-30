<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\ApiAppGroup
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ApiAppGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApiAppGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApiAppGroup query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name 组名称
 * @property string|null $description 组说明
 * @property int $status 组：0表示禁用，1表示启用
 * @property string $hash 组标识
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ApiAppGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiAppGroup whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiAppGroup whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiAppGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiAppGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiAppGroup whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiAppGroup whereUpdatedAt($value)
 */
class ApiAppGroup extends Model
{
    use HasFactory;

    protected             $table = "api_app_group";
    protected int         $id;
    protected string      $name;//组名称
    protected string|null $description;// 组说明
    protected int         $status;//组：0表示禁用，1表示启用
    protected string      $hash;//组标识

    protected $fillable = [
        'id',
        'name',
        'description',
        'status',
        'hash',
    ];
}

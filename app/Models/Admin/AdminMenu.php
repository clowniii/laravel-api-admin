<?php

namespace App\Models\Admin;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Admin\AdminMenu
 *
 * @method static Builder|AdminMenu newModelQuery()
 * @method static Builder|AdminMenu newQuery()
 * @method static Builder|AdminMenu query()
 * @mixin Eloquent
 * @property int $id
 * @property string $title 菜单标题
 * @property int $fid 父级菜单ID
 * @property string $url 链接
 * @property int $auth 是否需要登录才可以访问，1-需要，0-不需要
 * @property int $sort 排序
 * @property int $show 是否显示，1-显示，0-隐藏
 * @property string $icon 菜单图标
 * @property int $level 菜单层级，1-一级菜单，2-二级菜单，3-按钮
 * @property string $component 前端组件
 * @property string $router 前端路由
 * @property int $log 是否记录日志，1-记录，0-不记录
 * @property int $permission 是否验证权限，1-鉴权，0-放行
 * @property int $method 请求方式，1-GET, 2-POST, 3-PUT, 4-DELETE
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|AdminMenu whereAuth($value)
 * @method static Builder|AdminMenu whereComponent($value)
 * @method static Builder|AdminMenu whereCreatedAt($value)
 * @method static Builder|AdminMenu whereFid($value)
 * @method static Builder|AdminMenu whereIcon($value)
 * @method static Builder|AdminMenu whereId($value)
 * @method static Builder|AdminMenu whereLevel($value)
 * @method static Builder|AdminMenu whereLog($value)
 * @method static Builder|AdminMenu whereMethod($value)
 * @method static Builder|AdminMenu wherePermission($value)
 * @method static Builder|AdminMenu whereRouter($value)
 * @method static Builder|AdminMenu whereShow($value)
 * @method static Builder|AdminMenu whereSort($value)
 * @method static Builder|AdminMenu whereTitle($value)
 * @method static Builder|AdminMenu whereUpdatedAt($value)
 * @method static Builder|AdminMenu whereUrl($value)
 */
class AdminMenu extends Model
{
    use HasFactory;

    protected $table = "admin_menu";

    protected int    $id;
    protected string $title;
    protected int    $fid;
    protected string $url;
    protected int    $auth;
    protected int    $sort;
    protected int    $show;
    protected string $icon;
    protected int    $level;
    protected string $component;
    protected string $router;
    protected int    $log;
    protected int    $permission;
    protected int    $method;
}

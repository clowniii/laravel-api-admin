<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_menu', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50)->default('')->comment('菜单标题');
            $table->integer('fid')->default(0)->comment('父级菜单ID');
            $table->string('url', 50)->default('')->comment('链接');
            $table->tinyInteger('auth')->default(1)->comment('是否需要登录才可以访问，1-需要，0-不需要');
            $table->integer('sort')->default(0)->comment('排序');
            $table->tinyInteger('show')->default(1)->comment('是否显示，1-显示，0-隐藏');
            $table->string('icon', 50)->default('')->comment('菜单图标');
            $table->tinyInteger('level')->default(1)->comment('菜单层级，1-一级菜单，2-二级菜单，3-按钮');
            $table->string('component', 255)->default('')->comment('前端组件');
            $table->string('router', 255)->default('')->comment('前端路由');
            $table->tinyInteger('log')->default(1)->comment('是否记录日志，1-记录，0-不记录');
            $table->tinyInteger('permission')->default(1)->comment('是否验证权限，1-鉴权，0-放行');
            $table->tinyInteger('method')->default(1)->comment('请求方式，1-GET, 2-POST, 3-PUT, 4-DELETE');
            $table->timestamps();

            $table->comment("目录信息");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_menu');
    }
};

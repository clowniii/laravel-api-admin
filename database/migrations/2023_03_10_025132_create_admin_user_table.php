<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_user', function (Blueprint $table) {
            $table->id();
            $table->string('username', 64)->default('')->comment('用户名');
            $table->string('nickname', 64)->default('')->comment('用户昵称');
            $table->char('password', 32)->default('')->comment('用户密码');
            $table->integer('create_time')->default(0)->comment('注册时间');
            $table->bigInteger('create_ip')->default(0)->comment('注册IP');
            $table->integer('update_time')->default(0)->comment('更新时间');
            $table->tinyInteger('status')->default(0)->comment('账号状态 0封号 1正常');
            $table->string('openid', 100)->default('')->comment('三方登录唯一ID');
            $table->timestamps();
            $table->index('create_time');

            $table->comment("管理员认证信息");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_user');
    }
};

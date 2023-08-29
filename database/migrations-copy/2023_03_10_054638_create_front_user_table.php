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
        Schema::create('front_user', function (Blueprint $table) {
            $table->ID()->comment("记录标识");
            $table->bigInteger('org_id')->comment("所属组织");
            $table->string('login_name')->comment("登录账号");
            $table->string('password')->comment("用户密码");
            $table->string('username')->comment("用户姓名");
            $table->string('mobile')->comment("手机号");
            $table->string('email')->comment("邮箱");
            $table->timestamp('login_time')->nullable()->comment("登录时间");
            $table->timestamp('last_login_time')->nullable()->comment("上次登录时间");
            $table->bigInteger('count')->default(0)->comment("登录次数");
            $table->timestamps();
            //索引定义
            $table->unique('login_name');
            $table->unique('mobile');
            $table->unique('email');
            $table->index('org_id');
            $table->comment("前台用户表");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('front_user');
    }
};

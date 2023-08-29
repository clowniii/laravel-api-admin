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
        Schema::create('admin_user_data', function (Blueprint $table) {
            $table->id();
            $table->integer('login_times')->default(0)->comment('账号登录次数');
            $table->bigInteger('last_login_ip')->default(0)->comment('最后登录IP');
            $table->integer('last_login_time')->default(0)->comment('最后登录时间');
            $table->integer('uid')->default(0)->comment('用户ID');
            $table->text('head_img')->nullable()->comment('用户头像');
            $table->timestamps();
            $table->index('uid');

            $table->comment("管理员数据表");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_user_data');
    }
};

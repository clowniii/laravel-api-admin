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
        Schema::create('admin_user_action', function (Blueprint $table) {
            $table->id();
            $table->string('action_name', 50)->default('')->comment('行为名称');
            $table->integer('uid')->default(0)->comment('操作用户ID');
            $table->string('nickname', 50)->default('')->comment('用户昵称');
            $table->integer('add_time')->default(0)->comment('操作时间');
            $table->text('data')->nullable()->comment('用户提交的数据');
            $table->string('url', 200)->default('')->comment('操作URL');
            $table->timestamps();
            $table->index('uid');

            $table->comment("用户操作日志");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_user_action');
    }
};

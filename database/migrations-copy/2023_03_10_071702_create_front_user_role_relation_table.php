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
        Schema::create('front_user_role_relation', function (Blueprint $table) {
            $table->timestamps();

            //字段定义
            $table->ID('id')->comment("记录标识");
            $table->bigInteger('user_id')->unsigned()->nullable(false)->comment("用户");
            $table->bigInteger('role_id')->unsigned()->nullable(false)->comment("角色");



            //索引定义
            $table->index(['user_id', 'role_id']);
            $table->comment("前台用户角色表");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('front_user_role_relation');
    }
};

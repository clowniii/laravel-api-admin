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
        Schema::create('front_log', function (Blueprint $table) {
            //字段定义
            $table->ID('log_id')->comment("记录标识");
            $table->integer('op_type')->nullable(false)->comment("操作类型");
            $table->string('content', 200)->nullable(false)->comment("操作内容");
            $table->bigInteger('user_id')->unsigned()->nullable(false)->comment("操作用户");
            $table->timestamp('created_at')->nullable(false);


            //索引定义
            $table->index('user_id');
            $table->comment("前台日志表");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('front_log');
    }
};

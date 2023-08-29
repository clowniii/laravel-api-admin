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
        Schema::create('front_group_right_relation', function (Blueprint $table) {
            $table->timestamps();

            //字段定义
            $table->ID('id')->comment("记录标识");
            $table->bigInteger('group_id')->unsigned()->nullable(false)->comment("组");
            $table->bigInteger('right_id')->unsigned()->nullable(false)->comment("权限");
            $table->tinyInteger('right_type')->nullable(false)->default(0)->comment("权限类型");



            //索引定义
            $table->index(['group_id', 'right_id', 'right_type']);

            $table->comment("前台用户角色组权限表");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('front_group_right_relation');
    }
};

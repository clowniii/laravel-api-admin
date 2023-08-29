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
        Schema::create('front_roles', function (Blueprint $table) {
            //字段定义
            $table->ID('id')->comment("角色ID");
            $table->bigInteger('parent_id')->default(0)->comment("父级角色ID");
            $table->string('role_name', 64)->nullable(false)->comment("角色名称");
            $table->string('description', 200)->nullable()->comment("角色描述");

            //索引定义
            $table->unique('role_name');
            $table->index('parent_id');
            $table->timestamps();
            $table->comment("角色表");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('front_roles');
    }
};

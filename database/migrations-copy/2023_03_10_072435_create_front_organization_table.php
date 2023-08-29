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
        Schema::create('front_organization', function (Blueprint $table) {
            $table->timestamps();

            //字段定义
            $table->ID('id')->comment("记录标识");
            $table->bigInteger('parent_id')->unsigned()->nullable(false)->comment("父级组织");
            $table->string('org_name', 64)->nullable(false)->comment("组织名称");
            $table->string('description', 200)->nullable()->comment("描述");



            //索引定义
            $table->index('parent_id');
            $table->comment("前台组织表");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('front_organization');
    }
};

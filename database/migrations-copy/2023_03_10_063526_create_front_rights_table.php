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
        Schema::create('front_rights', function (Blueprint $table) {
            $table->timestamps();
            //字段定义
            $table->ID()->comment("权限ID");
            $table->bigInteger('parent_id')->default(0)->comment("父级权限ID");
            $table->string('right_name', 64)->nullable(false)->comment("权限名称");
            $table->string('description', 200)->nullable()->comment("权限描述");

            //索引定义
            $table->unique('right_name');
            $table->index('parent_id');
            $table->comment("权限表");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('front_rights');
    }
};

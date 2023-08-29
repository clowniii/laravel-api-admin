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
        Schema::create('front_group', function (Blueprint $table) {
            $table->timestamps();
            //字段定义
            $table->ID('id')->comment("组ID");
            $table->bigInteger('parent_id')->default(0)->comment("组ID");
            $table->string('group_name', 64)->nullable(false)->comment("组ID");
            $table->string('description', 200)->nullable()->comment("组ID");


            //索引定义
            $table->unique('group_name');
            $table->index('parent_id');

            $table->comment("前台组表");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('front_group');
    }
};

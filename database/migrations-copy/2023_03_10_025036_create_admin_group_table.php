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
        Schema::create('admin_group', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->default('')->comment('组名称');
            $table->text('description')->nullable()->comment('组说明');
            $table->tinyInteger('status')->default(1)->comment('状态：为1正常，为0禁用');
            $table->string('hash', 128)->default('')->comment('组标识');
            $table->integer('create_time')->default(0)->comment('创建时间');
            $table->integer('update_time')->default(0)->comment('修改时间');
            $table->string('image', 256)->nullable()->comment('分组封面图');
            $table->integer('hot')->default(0)->comment('分组热度');
            $table->timestamps();

            $table->comment("接口组管理");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_group');
    }
};

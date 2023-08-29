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
    public function up():void
    {
        Schema::create('api_app_group', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->default('')->comment('组名称');
            $table->text('description')->nullable()->comment('组说明');
            $table->tinyInteger('status')->default(1)->comment('组：0表示禁用，1表示启用');
            $table->string('hash', 128)->default('')->comment('组标识');
            $table->timestamps();

            $table->comment("应用组，目前只做管理使用，没有实际权限控制");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down():void
    {
        Schema::dropIfExists('admin_app_group');
    }
};

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
        Schema::create('admin_auth_group', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->default('')->comment('组名称');
            $table->text('description')->nullable()->comment('组描述');
            $table->tinyInteger('status')->default(1)->comment('组状态：为1正常，为0禁用');
            $table->timestamps();

            $table->comment("权限组");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_auth_group');
    }
};

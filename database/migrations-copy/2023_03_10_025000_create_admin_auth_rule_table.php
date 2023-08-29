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
        Schema::create('admin_auth_rule', function (Blueprint $table) {
            $table->id();
            $table->string('url', 80)->default('')->comment('规则唯一标识');
            $table->unsignedInteger('group_id')->default(0)->comment('权限所属组的ID');
            $table->unsignedInteger('auth')->default(0)->comment('权限数值');
            $table->tinyInteger('status')->default(1)->comment('状态：为1正常，为0禁用');
            $table->timestamps();

            $table->comment("权限细节");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_auth_rule');
    }
};

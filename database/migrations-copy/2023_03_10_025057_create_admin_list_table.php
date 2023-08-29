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
        Schema::create('admin_list', function (Blueprint $table) {
            $table->id();
            $table->string('api_class', 50)->default('')->comment('api索引，保存了类和方法');
            $table->string('hash', 50)->default('')->comment('api唯一标识');
            $table->tinyInteger('access_token')->default(1)->comment('认证方式 1：复杂认证，0：简易认证');
            $table->tinyInteger('status')->default(1)->comment('API状态：0表示禁用，1表示启用');
            $table->tinyInteger('method')->default(2)->comment('请求方式0：不限1：Post，2：');
            $table->string('info', 500)->default('')->comment('api中文说明');
            $table->tinyInteger('is_test')->default(0)->comment('是否是测试模式：0:生产模式，1：测试模式');
            $table->text('return_str')->nullable()->comment('返回数据示例');
            $table->string('group_hash', 64)->default('default')->comment('当前接口所属的接口分组');
            $table->tinyInteger('hash_type')->default(2)->comment('是否采用hash映射， 1：普通模式 2：加密模式');
            $table->timestamps();
            $table->index('hash');

            $table->comment("用于维护接口信息");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_list');
    }
};

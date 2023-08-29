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
        Schema::create('api_app', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('app_id', 50)->unique()->comment('应用id');
            $table->string('app_secret', 50)->comment('应用密码');
            $table->string('app_name', 50)->comment('应用名称');
            $table->tinyInteger('app_status')->default(1)->comment('应用状态：0表示禁用，1表示启用');
            $table->text('app_info')->nullable()->comment('应用说明');
            $table->text('app_api')->nullable()->comment('当前应用允许请求的全部API接口');
            $table->string('app_group', 128)->default('default')->comment('当前应用所属的应用组唯一标识');
            $table->integer('app_add_time')->default(0)->comment('应用创建时间');
            $table->text('app_api_show')->nullable()->comment('前台样式显示所需数据格式');
            $table->timestamps();

            $table->comment("appId和appSecret表");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_app');
    }
};

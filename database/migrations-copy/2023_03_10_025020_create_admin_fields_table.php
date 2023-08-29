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
        Schema::create('admin_fields', function (Blueprint $table) {
            $table->id();
            $table->string('field_name', 50)->default('')->comment('字段名称');
            $table->string('hash', 50)->default('')->comment('权限所属组的ID');
            $table->tinyInteger('data_type')->default(0)->comment('数据类型，来源于DataType类库');
            $table->string('default', 500)->default('')->comment('默认值');
            $table->tinyInteger('is_must')->default(0)->comment('是否必须 0为不必须，1为必须');
            $table->string('range', 500)->default('')->comment('范围，Json字符串，根据数据类型有不一样的含义');
            $table->string('info', 500)->default('')->comment('字段说明');
            $table->tinyInteger('type')->default(0)->comment('字段用处：0为request，1为response');
            $table->string('show_name', 50)->default('')->comment('wiki显示用字段');
            $table->timestamps();
            $table->index('hash');

            $table->comment("用于保存各个API的字段规则");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_fields');
    }
};

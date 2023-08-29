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
        Schema::create('admin_auth_group_access', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('uid')->default(0);
            $table->string('group_id')->default('');
            $table->timestamps();
            $table->index('uid');
            $table->index('group_id');

            $table->comment("用户和组的对应关系");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_auth_group_access');
    }
};

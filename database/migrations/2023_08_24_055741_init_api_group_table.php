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
        $data = [
            'name'        => '默认分组',
            'description' => '默认分组',
            'status'      => 1,
            'hash'        => 'default',
            'create_time' => time(),
            'update_time' => time(),
            'image'       => '',
            'hot'         => 0
        ];

        \Illuminate\Support\Facades\DB::table('api_group')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

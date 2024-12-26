<?php

use App\tools\Strs;
use App\tools\Tools;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $pass    = 123456;
        $authKey = \env("APP_KEY");

        $data = [
            'id'          => 1,
            'username'    => 'root',
            'nickname'    => 'root',
            'password'    => Tools::userMd5($pass, $authKey),
            'create_time' => time(),
            'create_ip'   => ip2long('127.0.0.1'),
            'update_time' => time(),
            'status'      => 1,
            'openid'      => ""
        ];

        \Illuminate\Support\Facades\DB::table('admin_user')->insert($data);

        $lockFile = base_path() . '\install' . DIRECTORY_SEPARATOR;
        if (!File::exists($lockFile)) {
            File::makeDirectory($lockFile, 0755, true, true);
        }
        File::put($lockFile . 'lock.ini', "username:root". PHP_EOL."password:{$pass}" . PHP_EOL);

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

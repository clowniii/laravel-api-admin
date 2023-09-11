<?php

use App\Http\Controllers\MissController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MissController::class, "index"]);
Route::post('/predict', function () {
    return [
        "code" => 200,
        "msg" => "success",
        "data" => [
            "sentiment" => "positive"
        ]
    ];
});

Route::get('/test', function () {
//    $host = "http://127.0.0.1";
    $host = "http://192.168.3.199:8121";
    $NLP_API_HOST = $host  . "/predict";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $NLP_API_HOST);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(["text" => "哈哈哈哈哈"]));
    $returnAPI = curl_exec($ch);
    curl_close($ch);
    if ($returnAPI) {
        $returnAPI = json_decode($returnAPI, true);
        if ($returnAPI["code"] == 200) {
            return $returnAPI['data']['sentiment'];
        }
        return false;
    }
    return false;
});

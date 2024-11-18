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


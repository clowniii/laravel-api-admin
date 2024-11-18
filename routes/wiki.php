<?php

use App\Http\Middleware\AdminResponse;
use App\Http\Middleware\ApiAuth;
use App\Http\Middleware\WikiAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\wiki\Api;

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
Route::middleware([AdminResponse::class])->group(function (){
    Route::post('Api/login',[Api::class,'login']);
});
Route::middleware([AdminResponse::class,WikiAuth::class])->group(function (){
    Route::prefix("Api")->group(function (){
        Route::get('errorCode', [Api::class, 'errorCode']);
        Route::get('groupList', [Api::class, 'groupList']);
        Route::get('detail', [Api::class, 'detail']);
        Route::get('logout', [Api::class, 'logout']);
    });
});



<?php

use App\Http\Controllers\admin\AppController;
use App\Http\Controllers\admin\AppGroupController;
use App\Http\Controllers\admin\AuthGroupController;
use App\Http\Controllers\admin\BaseController;
use App\Http\Controllers\admin\FieldsController;
use App\Http\Controllers\admin\InterfaceGroupController;
use App\Http\Controllers\admin\InterfaceListController;
use App\Http\Controllers\admin\LogController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\admin\UserController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\AdminLog;
use App\Http\Middleware\AdminPermission;
use App\Http\Middleware\AdminResponse;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Admin" middleware group. Now create something great!
|
*/

Route::post('Login/index', [LoginController::class, "index"])->middleware([AdminResponse::class]);



Route::get('Login/logout', [LoginController::class, "logout"])->middleware([AdminAuth::class, AdminLog::class, AdminResponse::class]);

Route::get('Menu/changeStatus', [MenuController::class, "changeStatus"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::post('Menu/add', [MenuController::class, "create"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::post('Menu/edit', [MenuController::class, "edit"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('Menu/del', [MenuController::class, "destroy"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);

Route::get('User/getUsers', [UserController::class, "getUsers"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('User/changeStatus', [UserController::class, "changeStatus"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::post('User/add', [UserController::class, "create"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::post('User/edit', [UserController::class, "edit"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('User/del', [UserController::class, "destroy"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);


Route::get('Auth/changeStatus', [AuthGroupController::class, "changeStatus"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('Auth/delMember', [AuthGroupController::class, "delMember"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::post('Auth/add', [AuthGroupController::class, "create"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::post('Auth/edit', [AuthGroupController::class, "edit"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('Auth/del', [AuthGroupController::class, "destroy"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('Auth/getGroups', [AuthGroupController::class, "getGroups"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('Auth/getRuleList', [AuthGroupController::class, "getRuleList"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);


Route::get('App/changeStatus', [AppController::class, "changeStatus"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('App/getAppInfo', [AppController::class, "getAppInfo"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::post('App/add', [AppController::class, "create"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::post('App/edit', [AppController::class, "edit"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('App/del', [AppController::class, "destroy"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);


Route::get('InterfaceList/changeStatus', [InterfaceListController::class, "changeStatus"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('InterfaceList/getHash', [InterfaceListController::class, "getHash"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::post('InterfaceList/add', [InterfaceListController::class, "create"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::post('InterfaceList/edit', [InterfaceListController::class, "edit"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('InterfaceList/del', [InterfaceListController::class, "destroy"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);


Route::get('Fields/request', [FieldsController::class, "request"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('Fields/response', [FieldsController::class, "response"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::post('Fields/add', [FieldsController::class, "create"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::post('Fields/upload', [FieldsController::class, "upload"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::post('Fields/edit', [FieldsController::class, "edit"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('Fields/del', [FieldsController::class, "destroy"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);


Route::post('InterfaceGroup/add', [InterfaceGroupController::class, "create"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::post('InterfaceGroup/edit', [InterfaceGroupController::class, "edit"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('InterfaceGroup/del', [InterfaceGroupController::class, "destroy"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);

Route::get('InterfaceGroup/getAll', [InterfaceGroupController::class, "getAll"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('InterfaceGroup/changeStatus', [InterfaceGroupController::class, "changeStatus"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);


Route::post('AppGroup/add', [AppGroupController::class, "create"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::post('AppGroup/edit', [AppGroupController::class, "edit"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('AppGroup/del', [AppGroupController::class, "destroy"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('AppGroup/getAll', [AppGroupController::class, "getAll"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('AppGroup/changeStatus', [AppGroupController::class, "changeStatus"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);


Route::get('Menu/index', [MenuController::class, "index"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('User/index', [UserController::class, "index"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('Auth/index', [AuthGroupController::class, "index"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('App/index', [AppController::class, "index"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('AppGroup/index', [AppGroupController::class, "index"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('InterfaceList/index', [InterfaceListController::class, "index"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('InterfaceGroup/index', [InterfaceGroupController::class, "index"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('Log/index', [LogController::class, "index"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('Log/del', [LogController::class, "index"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('InterfaceList/refresh', [InterfaceListController::class, "refresh"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::post('Index/upload', [BaseController::class, "upload"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::post('User/own', [UserController::class, "own"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('App/refreshAppSecret', [AppController::class, "refreshAppSecret"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('Login/getUserInfo', [LoginController::class, "getUserInfo"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::post('Auth/editRule', [AuthGroupController::class, "editRule"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);
Route::get('Login/getAccessMenu', [LoginController::class, "getAccessMenu"])->middleware([AdminAuth::class, AdminPermission::class, AdminLog::class, AdminResponse::class]);


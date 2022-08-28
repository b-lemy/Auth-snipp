<?php

use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\Usercontroller;
use Illuminate\Support\Facades\Route;


Route::post('login', [Authcontroller::class, 'login']);
Route::post('register', [Authcontroller::class, 'register']);

Route::post('password/email', [AuthController::class, 'forgot']);
Route::post('password/reset', [Authcontroller::class, 'reset']);


Route::group(['middleware' => 'auth:api'], function () {


    //user Urls
    Route::get('user', [Usercontroller::class, 'user']);
    Route::put('users/info', [Usercontroller::class, 'updateInfo']);
    Route::put('user/UpPass', [Usercontroller::class, 'updatePassword']);
    Route::Apiresource('users', Usercontroller::class);

    //roles Urls
    Route::Apiresource('roles', RolesController::class);

    //image Url
    Route::post('upload', [ImageController::class, 'upload']);


    //post Urls
    Route::Apiresource('posts', PostController::class);

});


<?php

use App\Http\Controllers\CenterOperationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Rutas protegidas
Route::group(['middleware' => 'auth:sanctum'], function () {
    //Users
    Route::controller(UserController::class)->group(function () {
        Route::get('/users-list', 'list');
        Route::post('/user-store', 'store');
        Route::get('/user-logout', 'logout');
    });
    //Center OP
    Route::controller(CenterOperationController::class)->group(function () {
        Route::get('/center-op-list', 'index');
    });
});
//Login
Route::post('/user-login', [UserController::class, 'login']);
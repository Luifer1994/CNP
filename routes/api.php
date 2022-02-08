<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Rutas protegidas
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/users-list', 'list');
        Route::post('/user-store', 'store');
        Route::get('/user-logout', 'logout');
    });
});

//Login
Route::post('/user-login', [UserController::class, 'login']);
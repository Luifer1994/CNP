<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/* Route::group(['middleware' => 'auth:api'], function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/users-list', 'list');
        Route::post('/user-store', 'store');
    });
}); */

//Login
Route::post('/user-login', [UserController::class, 'login']);
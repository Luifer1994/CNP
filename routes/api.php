<?php

use App\Http\Controllers\CenterOperationController;
use App\Http\Controllers\CnpController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Rutas protegidas
Route::group(['middleware' => 'auth:sanctum'], function () {
    //Users
    Route::controller(UserController::class)->group(function () {
        Route::get('/users-list', 'list');
        Route::post('/user-store', 'store');
        Route::get('/user-logout', 'logout');
        Route::get('/validate-sesion', 'validateSesion');
    });
    //Center OP
    Route::controller(CenterOperationController::class)->group(function () {
        Route::get('/center-op-list', 'index');
    });
    //Barcode
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products-by-barcode{bar_code?}', 'findBarcode');
    });
    //CNP
    Route::controller(CnpController::class)->group(function () {
        Route::post('/cnp-store', 'store');
    });
});
//Login
Route::post('/user-login', [UserController::class, 'login']);
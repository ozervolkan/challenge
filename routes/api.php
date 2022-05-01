<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix'=>'v1', 'namespace'=>'Api'], function (){
    //Koruma olmayan route lar

    Route::post('/register', [DeviceController::class, 'register']);

    // Token korumalı endpointler
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('/purchase', [DeviceController::class, 'purchase']);
        Route::get('/check', [DeviceController::class, 'checkSucscription']);
    });
});






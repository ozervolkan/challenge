<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('worker', function() {

    for ($i=0; $i < 10; $i++) {
        App\Jobs\Worker::dispatch();
    }

    return 'worker başladı.';
});

Route::get('/report',  [DeviceController::class, 'report']);

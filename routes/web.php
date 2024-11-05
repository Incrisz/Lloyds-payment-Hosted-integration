<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payment\LloydsCardnetController;

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

// Route::get('/test', function () {
//     return view('test');
// });


Route::get('/payment', [LloydsCardnetController::class, 'showPaymentForm']);



// Route::post('/payment/process', [LloydsCardnetController::class, 'processPayment']);
// Route::post('/payment/response', [LloydsCardnetController::class, 'handleResponse']);

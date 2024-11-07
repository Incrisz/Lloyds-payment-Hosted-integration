<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payment\LloydsController;

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

Route::get('/test', function () {
    return view('test');
});


// Route::get('/payment', [LloydsCardnetController::class, 'showPaymentForm']);



// Route::post('/payment/process', [LloydsCardnetController::class, 'processPayment']);
// Route::post('/payment/response', [LloydsCardnetController::class, 'handleResponse']);






// Display form for payment selection
Route::get('/payment', [LloydsController::class, 'showForm']);

// Process payment request (POST method to handle the form submission)
Route::post('/payment', [LloydsController::class, 'processPayment'])->name('payment.process');

// Success page route (GET request)
Route::any('/payment/success', function () {
    return "Payment Successful!";
})->name('payment.success');

// Failure page route (GET request)
Route::any('/payment/failure', function () {
    return "Payment Failed!";
})->name('payment.failure');

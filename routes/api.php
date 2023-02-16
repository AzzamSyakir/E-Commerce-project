<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(userController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::get('/listProduct', 'listProduct');
    Route::post('/addProduct', 'addProduct')->middleware(['auth:api']);

});

Route::controller(adminController::class)->group(function () {
    Route::post('/registerAdmin', 'Adminregister');
    Route::post('/loginAdmin', 'Adminlogin');
});

Route::controller(PaymentController::class)->group(function () {
    Route::post('/pay', 'createPayment');
    Route::post('/afterpayment', 'AfterPayment');
});
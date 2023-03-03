<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\userController;

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

Route::get('/', [PaymentController::class, 'home']);
Route::post('/checkout', [PaymentController::class, 'checkout']);
Route::get('/invoice/{id}', [PaymentController::class, 'invoice']);
Route::get('/login', [SessionController::class, 'IndexLogin'])->name('login');
Route::post('/loginsession', [SessionController::class, 'LoginSession']);

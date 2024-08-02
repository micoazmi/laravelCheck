<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/', [ProductController::class, 'index']);
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart']);
Route::get('/cart', [CartController::class, 'index']);
Route::post('/checkout', [PaymentController::class, 'checkout']);
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/payment/finish', [PaymentController::class, 'finish'])->name('payment.finish');

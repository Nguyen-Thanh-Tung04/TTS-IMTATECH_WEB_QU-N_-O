<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product_detail/{id}', [HomeController::class, 'detail'])->name('product_detail');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/shop/category/{iddm}', [HomeController::class, 'shopByCategory'])->name('shop.category');

Route::get('/cart', [CartController::class, 'index'])->name('client.cart');
Route::post('/addToCart', [CartController::class, 'addToCart'])->name('addToCart');
Route::post('/cart', [CartController::class, 'buyNow'])->name('buyNow');
Route::post('/updateQuantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::post('/removeCartItem', [CartController::class, 'removeCartItem'])->name('cart.removeCartItem');
Route::post('/removeCartOver', [CartController::class, 'removeCartOver'])->name('cart.removeCartOver');
Route::get('/order', [CartController::class, 'order'])->name('client.order');
Route::post('/place', [PaymentController::class, 'place'])->name('client.place');

Route::post('/bill', [CartController::class, 'bill'])->name('client.bill');
Route::get('/bills', [CartController::class, 'bills'])->name('clients.bill');
Route::get('/orderhistry', [CartController::class, 'orderhistry'])->name('clients.orderhistry');
Route::get('/histryDetail/{id}', [CartController::class, 'histryDetail'])->name('clients.histryDetail');
// voucher
Route::post('/discount', [CartController::class, 'discount'])->name('discount');
Route::post('/updateOrder', [CartController::class, 'updateOrder'])->name('update.order');

// Thanh toán
Route::post('/vnpay_payment', [PaymentController::class, 'vnpay_payment'])->name('vnpay_payment');


// Login 
Route::get('auth/login' ,[LoginController::class, 'index'])
    ->name('login');
Route::post('auth/login' ,[LoginController::class, 'login'])
    ->name('login');
Route::get('auth/logout' ,[LoginController::class, 'logout'])
    ->name('logout');
    Route::get('auth/vertify/{$token}' ,[LoginController::class, 'vertify'])
    ->name('vertify');

// Register
Route::get('auth/register' ,[RegisterController::class, 'index'])
    ->name('register');
Route::post('auth/register' ,[RegisterController::class, 'register'])
    ->name('register');
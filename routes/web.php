<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


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
Route::post('/bill', [CartController::class, 'bill'])->name('client.bill');


// Route::get('/', function () {
//     // return view('welcome'); / Hiển thị view
//     // return "Hello World!"; // Hiển thị chuỗi
//     // return ['phở bò', 'cơm rang']; // Hiển thị mảng
//     return response()->json([
//         'name' => 'Vũ Thị Thúy',
//         'email' => 'thuyvt66@fpt.edu.vn'
//     ]); // Hiển thị dạng object json
//      return view('welcome'); // Hiển thị view
// //    // return "Hello World!"; // Hiển thị chuỗi
// //    // return ['phở bò', 'cơm rang']; // Hiển thị mảng
// //    return response()->json([
// //        'name' => 'Vũ Thị Thúy',
// //        'email' => 'thuyvt66@fpt.edu.vn'
// //    ]); // Hiển thị dạng object json
// })->name('welcome');
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

Route::get('admin', function () {
    return 'ĐÂy là admin';
})->middleware(\App\Http\Middleware\CheckAdminMiddleware::class);

Route::get('admin', function () {
    return 'Đây là admin';
})->middleware('isAdmin');
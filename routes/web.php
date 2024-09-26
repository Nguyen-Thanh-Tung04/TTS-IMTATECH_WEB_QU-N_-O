<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


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
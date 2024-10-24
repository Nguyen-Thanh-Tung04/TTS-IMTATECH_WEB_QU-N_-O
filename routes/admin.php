<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AccountController;




use Illuminate\Support\Facades\Route;

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
// Assuming authentication is required
Route::middleware('isAdmin')->prefix('admin')->as('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    });
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('vouchers', VoucherController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('accounts', AccountController::class);

    // hóa đơn
    Route::get('/print/{id}/pdf-invoice', [OrderController::class, 'invoice'])->name('print');
    

    Route::get('/login', [LoginController::class, 'index'])
        ->name('login');
    Route::post('auth/login', [LoginController::class, 'login'])
        ->name('login');
    Route::get('auth/logout', [LoginController::class, 'logout'])
        ->name('logout');
});
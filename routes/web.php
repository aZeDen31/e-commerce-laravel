<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/env', function () {
    return dd(env('DB_DATABASE'));
});

Route::get('/products', [ArticleController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ArticleController::class, 'show'])->name('products.show');

Auth::routes();



Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove')->middleware('auth');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/balance', [ProfileController::class, 'addBalance'])->name('profile.balance');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    
    Route::resource('products', \App\Http\Controllers\AdminProductController::class);
    
    Route::get('orders', [\App\Http\Controllers\AdminOrderController::class, 'index'])->name('orders.index');
    Route::post('orders/{order}/status', [\App\Http\Controllers\AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    
    Route::resource('coupons', \App\Http\Controllers\AdminCouponController::class);
});


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
// Routes for user profile and order history
// Route to update the profile
Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
Route::get('/profile', [UserController::class, 'show'])->name('profile.show');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/user/products', [ProductController::class, 'index'])->name('user.products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

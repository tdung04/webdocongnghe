<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\UserController;
// Route cho việc thêm sản phẩm vào giỏ hàng
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');

// Route cho việc hiển thị giỏ hàng
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Route cho việc cập nhật số lượng sản phẩm trong giỏ hàng
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

// Route cho việc xóa sản phẩm khỏi giỏ hàng
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Route cho trang checkout của toàn bộ giỏ hàng
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/checkout', [CartController::class, 'processCheckout'])->name('checkout.process');

// Route cho trang checkout của một sản phẩm đơn lẻ
Route::get('/checkout/single/{product}', [CheckoutController::class, 'singleProduct'])->name('checkout.single');
Route::post('/checkout/single', [CheckoutController::class, 'processSingle'])->name('checkout.processSingle');
Route::get('/orders', [UserController::class, 'orders'])->name('orders.index');

Route::get('/checkout/success', function () {
    return view('checkout_success');
})->name('checkout.success');

Route::get('/checkout/fail', function () {
    return view('checkout_fail');
})->name('checkout.fail');

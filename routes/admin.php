<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;

// Nhóm route cho quản lý admin, được bảo vệ bởi middleware 'auth' và 'admin'
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // ------------------------ Quản lý Sản phẩm ------------------------
    // Trang chính Admin (trang quản lý sản phẩm mặc định)
    Route::get('dashboard', [ProductController::class, 'index'])->name('admin.dashboard');

    // Route GET để hiển thị form tạo sản phẩm mới
    Route::get('products/create', [ProductController::class, 'create'])->name('admin.products.create');

    // Route POST để lưu sản phẩm mới
    Route::post('products', [ProductController::class, 'store'])->name('admin.products.store');

    // Route GET để hiển thị form chỉnh sửa sản phẩm
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');

    // Route PUT/PATCH để cập nhật thông tin sản phẩm
    Route::put('products/{product}', [ProductController::class, 'update'])->name('admin.products.update');

    // Route DELETE để xóa một sản phẩm
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    
    Route::get('products', [ProductController::class, 'index'])->name('admin.products.index');



    

    // ------------------------ Quản lý Người dùng ------------------------
    // Route GET để hiển thị danh sách người dùng
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');

    // Route GET để hiển thị form tạo người dùng mới
    Route::get('users/create', [UserController::class, 'create'])->name('admin.users.create');

    // Route POST để lưu người dùng mới
    Route::post('users', [UserController::class, 'store'])->name('admin.users.store');

    // Route GET để hiển thị chi tiết một người dùng cụ thể
    Route::get('users/{user}', [UserController::class, 'show'])->name('admin.users.show');

    // Route GET để hiển thị form chỉnh sửa người dùng
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');

    // Route PUT/PATCH để cập nhật thông tin người dùng
    Route::put('users/{user}', [UserController::class, 'update'])->name('admin.users.update');

    // Route DELETE để xóa một người dùng
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');


    // ------------------------ Quản lý Đơn hàng ------------------------
    // Route GET để hiển thị danh sách đơn hàng
    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');

    // Route GET để hiển thị chi tiết một đơn hàng cụ thể
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');

    // Route GET để hiển thị form chỉnh sửa đơn hàng
    Route::get('orders/{order}/edit', [OrderController::class, 'edit'])->name('admin.orders.edit');

    // Route PUT/PATCH để cập nhật thông tin đơn hàng
    Route::put('orders/{order}', [OrderController::class, 'update'])->name('admin.orders.update');

    // Route DELETE để xóa một đơn hàng
    Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');

    Route::get('/statistics', [ProductController::class, 'statistics'])->name('admin.statistics');


    
});

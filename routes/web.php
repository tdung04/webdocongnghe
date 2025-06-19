<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

use App\Http\Controllers\OrderController;

use App\Http\Controllers\SupportController;

use App\Http\Controllers\SubscriptionController;

use App\Http\Controllers\ContactController;

use App\Http\Controllers\ServiceController;

use App\Http\Controllers\PromotionController;


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

Route::redirect('/', '/products');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::post('/favorites/{product}', [App\Http\Controllers\FavoritesController::class, 'add'])->name('favorites.add');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/checkout', [CartController::class, 'processCheckout'])->name('cart.processCheckout');

Route::get('/user/orders', [OrderController::class, 'index'])->name('user.orders');

Route::get('/products', function () {
    // Replace with the logic for your products page
    return view('products.index');
});
Route::get('/support', function () {return view('support');})->name('support.index');
Route::post('/support', [SupportController::class, 'send'])->name('support.send');

Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

Route::get('/promotion', [PromotionController::class, 'index'])->name('promotion.index');


require base_path('routes/cart.php');

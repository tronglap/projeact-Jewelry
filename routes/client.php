<?php

use App\Http\Controllers\Client\BlogController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\DetailProductController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ListProductController;
use App\Http\Controllers\Client\RegisterUserController;
use App\Http\Controllers\Client\GoogleController;
use Illuminate\Support\Facades\Route;


Route::prefix('home/shop')->group(function () {
    Route::get('/', [ListProductController::class, 'index'])->name('home.shop');
    Route::get('detail/{product}', [DetailProductController::class, 'index'])->name('home.shop.detail');
});

Route::prefix('home/blog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('home.blog.index');
    Route::get('detail/{blog}', [BlogController::class, 'detail'])->name('home.blog.detail');
});

Route::prefix('home/cart')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('home.cart');
        Route::post('addProduct', [CartController::class, 'add'])->name('home.cart.addProduct'); // Add Product to cart
        Route::post('add-product-to-cart/{productId}/{qty?}', [CartController::class, 'addProductItem'])->name('home.cart.add.product.item');
        Route::get('destroy', [CartController::class, 'destroy'])->name('home.cart.destroy');
        Route::get('delete-item-cart/{productId}', [CartController::class, 'deleteItem'])->name('home.cart.delete.item');
        Route::get('checkout', [CartController::class, 'checkout'])->name('home.cart.checkout');
        Route::post('place-order', [CartController::class, 'placeOrder'])->name('home.cart.placeOrder');
        Route::get('success', [CartController::class, 'success'])->name('home.cart.success');
    });
Route::get('/get-cart-total', [CartController::class, 'getCartTotal'])->name('get.cart.total');

Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('register', [RegisterUserController::class, 'index'])->name('home.register');
});
Route::get('/api/search', [HomeController::class, 'search']);

Route::get('vnpayCallBack', [CartController::class, 'vnpayCallBack'])->name('vnpayCallBack');

Route::get('/google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/google/login', [GoogleController::class, 'callback'])->name('google.callback');
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login.form');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/register', 'showRegisterForm')->name('register.form');
    Route::post('/register', 'register')->name('register');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/product', 'index')->name('products');

    Route::get('/products/{id}/show', 'show')->name('products.show');
    Route::get('/products/category/{category_id}', 'searchByCategory')->name('products.category');
    Route::get('/product/name', 'searchByName')->name('products.name');

    Route::middleware('auth')->group(function () {
        Route::match(['get', 'post'], '/products/create', 'create')->name('products.create');
        Route::match(['get', 'post'], '/products/{id}/edit', 'edit')->name('products.edit');
        Route::post('/products/{id}/delete', 'delete')->name('products.delete');
    });
});

Route::controller(CartController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/cart', 'index')->name('cart.index');
        Route::post('/cart/add/{productId}', 'add')->name('cart.add');
        Route::put('/cart/update/{itemId}', 'update')->name('cart.update');
        Route::delete('/cart/remove/{itemId}', 'remove')->name('cart.remove');
    });
});

Route::controller(CheckoutController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/checkout', 'index')->name('checkout.index');
        Route::post('/checkout', 'process')->name('checkout.process');
    });
});

Route::controller(OrderController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/orders', 'index')->name('orders.index');
        Route::get('/orders/{id}', 'show')->name('orders.show');
    });
});

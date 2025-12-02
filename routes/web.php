<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::controller(ProductController::class)->group(function() {
    Route::get('/product', 'index')->name('products');
    Route::match(['get', 'post'], '/products/create', 'create')->name('products.create');
    Route::match(['get', 'post'], '/products/{id}/edit', 'edit')->name('products.edit');
    Route::post('/products/{id}/delete', 'delete')->name('products.delete');
    Route::get('/products/{id}/show', 'show')->name('products.show');
    Route::get('/products/category/{category_id}', 'searchByCategory')->name('products.category');
    Route::get('/product/name', 'searchByName')->name('products.name');
});

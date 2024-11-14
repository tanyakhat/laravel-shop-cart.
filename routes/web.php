<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::put('/cart/update/{cartItemId}', [CartController::class, 'update'])->name('cart.update');
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

// Удаление товара из корзины
Route::delete('/cart/remove/{cartItemId}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/categories', [ProductController::class, 'showCategories'])->name('categories.index');

Route::get('/category/{categoryId}', [HomeController::class, 'showCategoryProducts'])->name('category.products');


Route::get('/admin/products', [AdminController::class, 'showProducts'])->name('admin.products');
Route::get('/admin/product/create', [AdminController::class, 'createProduct'])->name('admin.product.create');
Route::post('/admin/product/store', [AdminController::class, 'storeProduct'])->name('admin.product.store');
Route::get('/admin/product/edit/{id}', [AdminController::class, 'editProduct'])->name('admin.product.edit');
Route::put('/admin/product/update/{id}', [AdminController::class, 'updateProduct'])->name('admin.product.update');



//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

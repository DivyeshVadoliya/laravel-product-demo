<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'check'])->name('admin.check');

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [ProductController::class, 'show'])->name('product.show');

        Route::get('/create', [ProductController::class, 'create'])->name('product.create');

        Route::post('/store', [ProductController::class, 'store'])->name('product.store');

        Route::get('/{product}', [ProductController::class, 'edit'])->name('product.edit');

        Route::put('/{product}', [ProductController::class, 'update'])->name('product.update');

        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'show'])->name('category.show');

        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');

        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');

        Route::get('/category/{category}', [CategoryController::class, 'edit'])->name('category.edit');

        Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');

        Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'show'])->name('user.show');

        Route::get('/create', [UserController::class, 'create'])->name('user.create');

        Route::post('/store', [UserController::class, 'store'])->name('user.store');

        Route::get('/user/{user}', [UserController::class, 'edit'])->name('user.edit');

        Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');

        Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    });

    Route::get('/password/change', [PasswordChangeController::class, 'edit'])->name('password.change.edit');

    Route::put('/password/change', [PasswordChangeController::class, 'update'])->name('password.change.update');
});
Route::get('/', [DashboardController::class, 'index'])->name('index');
require 'auth.php';

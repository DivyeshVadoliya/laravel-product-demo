<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChangePassword;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'checkLogin'])->name('admin.checkLogin');

Route::group(['middleware' => ['roll']], function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/user/create', function () {
        return view('admin.user.create');
    })->name('admin.user.create');
});

//Route::get('/', [DashboardController::class, 'index'])->name('index');
Route::group(['middleware' => ['auth']], function () {

    Route::get('/admin/register', [AdminController::class, 'createUserForm'])->name('admin.createUserForm');
    Route::post('/admin/register', [AdminController::class, 'createUser'])->name('admin.createUser');
    Route::get('/admin/user', [AdminController::class, 'showUser'])->name('admin.showUser');


    Route::get('/admin/product', [ProductController::class, 'show'])->name('product.show');
});

//Route::get('/', [DashboardController::class, 'index'])->name('index');
Route::group(['middleware' => ['auth']], function () {

    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::get('/password/change', [ChangePassword::class, 'edit'])->name('change.password.edit');
    Route::put('/password/change', [ChangePassword::class, 'update'])->name('change.password.update');
});
require 'category.php';
require 'auth.php';

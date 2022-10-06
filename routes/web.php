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

    Route::resource('product', ProductController::class)->except('show');

    Route::resource('category', CategoryController::class)->except('show');

    Route::resource('user', UserController::class)->except('show');

    Route::get('/password/change', [PasswordChangeController::class, 'edit'])->name('password.change.edit');

    Route::put('/password/change', [PasswordChangeController::class, 'update'])->name('password.change.update');
});
Route::get('/', [DashboardController::class, 'index'])->name('index');
require 'auth.php';

<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'checkLogin'])->name('admin.checkLogin');

Route::group(['middleware' => ['is.admin']], function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/user', [UserController::class, 'show'])->name('user.show');
    Route::get('/admin/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/admin/user/store', [UserController::class, 'store'])->name('user.store');
});
//Route::get('/', [DashboardController::class, 'index'])->name('index');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/password/change', [ChangePassword::class, 'edit'])->name('change.password.edit');

    Route::put('/password/change', [ChangePassword::class, 'update'])->name('change.password.update');
});
require 'auth.php';
require 'category.php';
require 'product.php';

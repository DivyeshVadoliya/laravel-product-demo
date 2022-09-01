<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/category', 'middleware' => ['auth'] ], function () {
    Route::get('/', [CategoryController::class, 'show'])->name('category.show');

    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');

    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');

    Route::get('/category/{category}', [CategoryController::class, 'edit'])->name('category.edit');

    Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');

    Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
});


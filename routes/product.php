<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/product', 'middleware' => ['is.admin'] ], function () {
    Route::get('/', [ProductController::class, 'show'])->name('product.show');

    Route::get('/create', [ProductController::class, 'create'])->name('product.create');

    Route::post('/store', [ProductController::class, 'store'])->name('product.store');

    Route::get('/{product}', [ProductController::class, 'edit'])->name('product.edit');

    Route::put('/{product}', [ProductController::class, 'update'])->name('product.update');

    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
});

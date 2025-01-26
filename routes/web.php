<?php

use App\Http\Controllers\Admin\CabinCategoryController;
use App\Http\Controllers\Admin\Main\IndexController;
use App\Http\Controllers\Admin\ShipController;
use App\Http\Controllers\Admin\ShipGalleryController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->middleware('auth:sanctum')->group(function() {
    Route::get('/', [IndexController::class, '__invoke'])->name('main');

    Route::prefix('/ships')->group(function() {
        Route::get('/', [ShipController::class, 'index'])->name('ships.index');
        Route::get('/{ship}/edit', [ShipController::class, 'edit'])->name('ships.edit');
        Route::put('/{ship}', [ShipController::class, 'update'])->name('ships.update');
    });

    Route::prefix('/cabins')->group(function() {
        Route::get('/', [CabinCategoryController::class, 'index'])->name('cabins.index');
        Route::get('/{cabin}/edit', [CabinCategoryController::class, 'edit'])->name('cabins.edit');
        Route::put('/{cabin}', [CabinCategoryController::class, 'update'])->name('cabins.update');
    });

    Route::prefix('/gallery')->group(function() {
        Route::get('/', [ShipGalleryController::class, 'index'])->name('gallery.index');
        Route::get('/create', [ShipGalleryController::class, 'create'])->name('gallery.create');
        Route::post('/', [ShipGalleryController::class, 'store'])->name('gallery.store');
        Route::get('/{image}', [ShipGalleryController::class, 'show'])->name('gallery.show');
        Route::delete('/{image}', [ShipGalleryController::class, 'destroy'])->name('gallery.destroy');
    });
});

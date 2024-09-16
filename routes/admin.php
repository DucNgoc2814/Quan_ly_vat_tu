<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SupplierController;


Route::prefix('quan-ly-tai-khoan')
    ->group(function () {
        Route::get('/danh-sach-nha-cung-cap', [SupplierController::class, 'index'])->name('danh-sach-nha-cung-cap');
        Route::get('/danh-sach-da-an-nha-cup-cap', [SupplierController::class, 'listTrashSupplier'])->name('danh-sach-da-an-nha-cup-cap');
        Route::get('{id}/khoi-phuc', [SupplierController::class, 'restoreSupplier'])->name('khoi-phuc');
        Route::get('/them-moi-nha-cung-cap', [SupplierController::class, 'create'])->name('them-moi-nha-cung-cap');
        Route::post('/them-moi', [SupplierController::class, 'store'])->name('them-moi');
        Route::get('{id}/sua-nha-cung-cap', [SupplierController::class, 'edit'])->name('sua-nha-cung-cap');
        Route::put('{id}/cap-nhat', [SupplierController::class, 'update'])->name('cap-nhat');
        Route::delete('{id}/an-nha-cung-cap', [SupplierController::class, 'destroy'])->name('an-nha-cung-cap');
    });
Route::prefix('sliders')
    ->as('sliders.')
    ->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('index');
        Route::get('/create', [SliderController::class, 'create'])->name('create');
        Route::post('/store', [SliderController::class, 'store'])->name('store');
        Route::get('/show/{id}', [SliderController::class, 'show'])->name('show');
        Route::get('{id}/edit', [SliderController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [SliderController::class, 'update'])->name('update');
        Route::delete('{id}/destroy', [SliderController::class, 'destroy'])->name('destroy');
    });

Route::prefix('thuong-hieu')
    ->as('thuong-hieu.')
    ->group(function () {
        Route::get('/danh-sach', [BrandController::class, 'index'])->name('index');
        Route::get('/them-moi', [BrandController::class, 'create'])->name('create');
        Route::post('/store', [BrandController::class, 'store'])->name('store');
        Route::get('{id}/sua', [BrandController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [BrandController::class, 'update'])->name('update');
        Route::delete('{id}/destroy', [BrandController::class, 'destroy'])->name('destroy');
    });

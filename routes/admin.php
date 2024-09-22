<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CargoCarController;
use App\Http\Controllers\ContractTypeController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
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


Route::prefix('quan-ly-don-hang')
    ->as('quan-ly-don-hang.')
    ->group(function () {
        Route::get('/danh-sach-ban', [OrderController::class, 'index'])->name('danh-sach-ban');
        Route::get('/them-don-hang', [OrderController::class, 'create'])->name('them-don-hang');
        Route::post('/nhap-them-don-hang', [OrderController::class, 'store'])->name('nhap-them-don-hang');
        Route::get('{slug}/sua-don-hang', [OrderController::class, 'edit'])->name('sua-don-hang');
        Route::put('{slug}/cap-nhat-don-hang', [OrderController::class, 'update'])->name('cap-nhat-don-hang');
        Route::post('/cap-nhat-trang-thai/{slug}', [OrderController::class, 'updateStatus'])->name('cap-nhat-trang-thai');
        Route::get('/chi-tiet-don-hang/{slug}', [OrderDetailController::class, 'index'])->name('chi-tiet-don-hang');
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
        Route::get('/sua/{sku}', [BrandController::class, 'edit'])->name('edit');
        Route::put('/update/{brand}', [BrandController::class, 'update'])->name('update');
        Route::delete('{id}/destroy', [BrandController::class, 'destroy'])->name('destroy');
    });
Route::prefix('hop-dong')
    ->as('hop-dong.')
    ->group(function () {
        Route::get('/danh-sach', [ContractController::class, 'index'])->name('index');
        Route::get('/them-moi', [ContractController::class, 'create'])->name('create');
        Route::post('/store', [ContractController::class, 'store'])->name('store');
        Route::get('/sua/{contract}', [ContractController::class, 'edit'])->name('edit');
        Route::put('/update/{brand}', [ContractController::class, 'update'])->name('update');
        Route::delete('{id}/destroy', [ContractController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('quan-ly-van-chuyen')
    ->group(function () {
        Route::get('/', [CargoCarController::class, 'index'])->name('index');
        Route::get('/create', [CargoCarController::class, 'create'])->name('create');
        Route::post('/store', [CargoCarController::class, 'store'])->name('store');
        Route::get('/show/{id}', [CargoCarController::class, 'show'])->name('show');
        Route::get('{id}/edit', [CargoCarController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [CargoCarController::class, 'update'])->name('update');
        Route::delete('{id}/destroy', [CargoCarController::class, 'destroy'])->name('destroy');
    });

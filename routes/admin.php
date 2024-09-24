<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CargoCarController;
use App\Http\Controllers\ContractTypeController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;


Route::prefix('quan-ly-tai-khoan')
->as('suppliers.')
    ->group(function () {
        Route::get('/danh-sach-nha-cung-cap', [SupplierController::class, 'index'])->name('index');
        Route::get('/them-moi-nha-cung-cap', [SupplierController::class, 'create'])->name('create');
        Route::post('/them-moi', [SupplierController::class, 'store'])->name('store');
        Route::get('{id}/sua-nha-cung-cap', [SupplierController::class, 'edit'])->name('edit');
        Route::put('{id}/cap-nhat', [SupplierController::class, 'update'])->name('update');
    });

Route::prefix('quan-ly-nhan-vien')
->as('employees.')
    ->group(function () {
        Route::get('/danh-sach-nhan-vien', [EmployeeController::class, 'index'])->name('index');
        Route::get('/them-moi-nhan-vien', [EmployeeController::class, 'create'])->name('create');
        Route::post('/them-moi', [EmployeeController::class, 'store'])->name('store');
        Route::get('{id}/sua-thong-tin-nhan-vien', [EmployeeController::class, 'edit'])->name('edit');
        Route::put('{id}/cap-nhat', [EmployeeController::class, 'update'])->name('update');
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
Route::prefix('contract-types')
    ->group(function () {
        Route::get('/', [ContractTypeController::class, 'index'])->name('index');
        Route::get('/create', [ContractTypeController::class, 'create'])->name('create');
        Route::post('/store', [ContractTypeController::class, 'store'])->name('store');
        Route::get('/show/{id}', [ContractTypeController::class, 'show'])->name('show');
        Route::get('{id}/edit', [ContractTypeController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [ContractTypeController::class, 'update'])->name('update');
        Route::delete('{id}/destroy', [ContractTypeController::class, 'destroy'])->name('destroy');
    });

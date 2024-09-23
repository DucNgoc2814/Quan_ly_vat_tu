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
->as('quan-ly-tai-khoan.')
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

Route::prefix('quan-ly-nhan-vien')
->as('quan-ly-nhan-vien.')
    ->group(function () {
        Route::get('/danh-sach-nhan-vien', [EmployeeController::class, 'index'])->name('danh-sach-nhan-vien');
        // Route::get('/danh-sach-da-an-nha-cup-cap', [EmployeeController::class, 'listTrashSupplier'])->name('danh-sach-da-an-nha-cup-cap');
        // Route::get('{id}/khoi-phuc', [EmployeeController::class, 'restoreSupplier'])->name('khoi-phuc');
        Route::get('/them-moi-nhan-vien', [EmployeeController::class, 'create'])->name('them-moi-nhan-vien');
        Route::post('/them-moi', [EmployeeController::class, 'store'])->name('them-moi');
        Route::get('{id}/sua-thong-tin-nhan-vien', [EmployeeController::class, 'edit'])->name('sua-thong-tin-nhan-vien');
        Route::put('{id}/cap-nhat', [EmployeeController::class, 'update'])->name('cap-nhat');
        Route::post('/update-employee-status', [EmployeeController::class, 'updateStatus']);
                // Route::delete('{id}/an-nha-cung-cap', [EmployeeController::class, 'destroy'])->name('an-nha-cung-cap');
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
Route::prefix('quan-ly-slider')
    ->as('quan-ly-slider.')
    ->group(function () {
        Route::get('/danh-sach', [SliderController::class, 'index'])->name('index');
        Route::get('/them-moi', [SliderController::class, 'create'])->name('create');
        Route::post('/nhap-them-moi', [SliderController::class, 'store'])->name('store');
        Route::get('/chi-tiet/{id}', [SliderController::class, 'show'])->name('show');
        Route::get('/sua/{id}', [SliderController::class, 'edit'])->name('edit');
        Route::put('/nhap-sua/{id}', [SliderController::class, 'update'])->name('update');
        Route::delete('/xoa/{id}', [SliderController::class, 'destroy'])->name('destroy');
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
    ->as('quan-ly-van-chuyen.')
    ->group(function () {
        Route::get('/danh-sach-xe-van-chuyen', [CargoCarController::class, 'index'])->name('index');
        Route::get('/them-moi-xe-van-chuyen', [CargoCarController::class, 'create'])->name('create');
        Route::post('/them-moi-xe-van-chuyen', [CargoCarController::class, 'store'])->name('store');
        Route::get('/sua-xe-van-chuyen/{id}', [CargoCarController::class, 'edit'])->name('edit');
        Route::put('/cap-nhat-xe-van-chuyen/{id}', [CargoCarController::class, 'update'])->name('update');
        Route::delete('/xoa-xe-van-chuyen/{id}', [CargoCarController::class, 'destroy'])->name('destroy');
    });
Route::prefix('quan-ly-loai-hop-dong')
    ->as('quan-ly-loai-hop-dong.')
    ->group(function () {
        Route::get('/danh-sach', [ContractTypeController::class, 'index'])->name('index');
        Route::get('/them-loai-hop-dong', [ContractTypeController::class, 'create'])->name('create');
        Route::post('/them-loai-hop-dong', [ContractTypeController::class, 'store'])->name('store');
        Route::get('/chi-tiet-loai-hop-dong/{id}', [ContractTypeController::class, 'show'])->name('show');
        Route::get('/sua-loai-hop-dong/{id}', [ContractTypeController::class, 'edit'])->name('edit');
        Route::put('/cap-nhat-loai-hop-dong/{id}', [ContractTypeController::class, 'update'])->name('update');
        Route::delete('/xoa/{id}', [ContractTypeController::class, 'destroy'])->name('destroy');
    });

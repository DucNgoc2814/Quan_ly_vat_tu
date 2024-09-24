<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CargoCarController;
use App\Http\Controllers\ContractTypeController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;


Route::prefix('mau')
    ->as('mau.')
    ->group(function () {
        Route::get('/danh-sach', [BrandController::class, 'index'])->name('index');
        Route::get('/them-moi', [BrandController::class, 'create'])->name('create');
        Route::post('/them-moi', [BrandController::class, 'store'])->name('store');
        Route::get('/sua/{}', [BrandController::class, 'edit'])->name('edit');
        Route::put('/cap-nhat/{}', [BrandController::class, 'update'])->name('update');
    });

Route::prefix('quan-ly-nha-phan-phoi')
    ->as('supplier.')
    ->group(function () {
        Route::get('/danh-sach', [SupplierController::class, 'index'])->name('index');
        Route::get('/danh-sach-da-an', [SupplierController::class, 'listTrashSupplier'])->name('listTrashSupplier');
        Route::get('/khoi-phuc/{id}', [SupplierController::class, 'restoreSupplier'])->name('restoreSupplier');
        Route::get('/them-moi', [SupplierController::class, 'create'])->name('create');
        Route::post('/them-moi', [SupplierController::class, 'store'])->name('store');
        Route::get('/sua/{id}', [SupplierController::class, 'edit'])->name('edit');
        Route::put('/cap-nhat/{id}', [SupplierController::class, 'update'])->name('update');
        Route::delete('/an/{id}', [SupplierController::class, 'destroy'])->name('destroy');
    });


Route::prefix('quan-ly-don-hang')
    ->as('quan-ly-don-hang.')
    ->group(function () {
        Route::get('/danh-sach-ban', [OrderController::class, 'index'])->name('danh-sach-ban');
        Route::get('/them-don-hang', [OrderController::class, 'create'])->name('them-don-hang');
        Route::post('/nhap-them-don-hang', [OrderController::class, 'store'])->name('nhap-them-don-hang');
        Route::get('/sua-don-hang/{slug}', [OrderController::class, 'edit'])->name('sua-don-hang');
        Route::put('/cap-nhat-don-hang/{slug}', [OrderController::class, 'update'])->name('cap-nhat-don-hang');
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
    ->as('brand.')
    ->group(function () {
        Route::get('/danh-sach', [BrandController::class, 'index'])->name('index');
        Route::get('/them-moi', [BrandController::class, 'create'])->name('create');
        Route::post('/them-moi', [BrandController::class, 'store'])->name('store');
        Route::get('/sua/{sku}', [BrandController::class, 'edit'])->name('edit');
        Route::put('/sua/{brand}', [BrandController::class, 'update'])->name('update');
    });
Route::prefix('hop-dong')
    ->as('hop-dong.')
    ->group(function () {
        Route::get('/danh-sach', [ContractController::class, 'index'])->name('index');
        Route::get('/them-moi', [ContractController::class, 'create'])->name('create');
        Route::post('/them-moi', [ContractController::class, 'store'])->name('store');
        Route::get('/sua/{contract}', [ContractController::class, 'edit'])->name('edit');
        Route::put('/sua/{contract}', [ContractController::class, 'update'])->name('update');
    });
Route::prefix('quan-ly-van-chuyen')
    ->as('quan-ly-van-chuyen.')
    ->group(function () {
        Route::get('/danh-sach-xe-van-chuyen', [CargoCarController::class, 'index'])->name('index');
        Route::get('/them-moi-xe-van-chuyen', [CargoCarController::class, 'create'])->name('create');
        Route::post('/them-moi-xe-van-chuyen', [CargoCarController::class, 'store'])->name('store');
        Route::get('/chi-tiet-xe-van-chuyen/{id}', [CargoCarController::class, 'show'])->name('show');
        Route::get('/sua-xe-van-chuyen/{id}', [CargoCarController::class, 'edit'])->name('edit');
        Route::put('/cap-nhat-xe-van-chuyen/{id}', [CargoCarController::class, 'update'])->name('update');
        Route::delete('/xoa-xe-van-chuyen/{id}', [CargoCarController::class, 'destroy'])->name('destroy');
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
Route::prefix('san-pham')
    ->as('san-pham.')
    ->group(function () {
        Route::get('/danh-sach', [ProductController::class, 'index'])->name('index');
        Route::get('/them-moi', [ProductController::class, 'create'])->name('create');
        Route::post('/them-moi', [ProductController::class, 'store'])->name('store');
        Route::get('/sua/{sku}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/sua/{sku}', [ProductController::class, 'update'])->name('update');
        Route::delete('/xoa/{id}', [ProductController::class, 'destroy'])->name('destroy');
    });

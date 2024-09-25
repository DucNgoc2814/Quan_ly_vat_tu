<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CargoCarController;
use App\Http\Controllers\ContractTypeController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;

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

Route::prefix('quan-ly-nhan-vien')
    ->as('quan-ly-nhan-vien.')
    ->group(function () {
        Route::get('/danh-sach-nhan-vien', [EmployeeController::class, 'index'])->name('danh-sach-nhan-vien');
        Route::get('/them-moi-nhan-vien', [EmployeeController::class, 'create'])->name('them-moi-nhan-vien');
        Route::post('/them-moi', [EmployeeController::class, 'store'])->name('them-moi');
        Route::get('{id}/sua-thong-tin-nhan-vien', [EmployeeController::class, 'edit'])->name('sua-thong-tin-nhan-vien');
        Route::put('{id}/cap-nhat', [EmployeeController::class, 'update'])->name('cap-nhat');
        Route::post('/update-employee-status', [EmployeeController::class, 'updateStatus']);
    });


Route::prefix('quan-ly-ban-hang')
    ->as('order.')
    ->group(function () {
        Route::get('/danh-sach-ban', [OrderController::class, 'index'])->name('index');
        Route::get('/them-don-hang', [OrderController::class, 'create'])->name('create');
        Route::post('/nhap-them-don-hang', [OrderController::class, 'store'])->name('store');
        Route::get('/sua-don-hang/{slug}', [OrderController::class, 'edit'])->name('edit');
        Route::put('/cap-nhat-don-hang/{slug}', [OrderController::class, 'update'])->name('update');
        Route::post('/cap-nhat-trang-thai/{slug}', [OrderController::class, 'updateStatus'])->name('updateStatus');
        Route::get('/chi-tiet-don-hang/{slug}', [OrderDetailController::class, 'index'])->name('indexDetail');
    });
        Route::prefix('quan-ly-thanh-truot')
    ->as('sliders.')
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

Route::prefix('quan-ly-xe')
    ->as('CargoCars.')
    ->group(function () {
        Route::get('/danh-sach', [CargoCarController::class, 'index'])->name('index');
        Route::get('/them-moi', [CargoCarController::class, 'create'])->name('create');
        Route::post('/them-moi', [CargoCarController::class, 'store'])->name('store');
        Route::get('/sua/{id}', [CargoCarController::class, 'edit'])->name('edit');
        Route::put('/cap-nhat/{id}', [CargoCarController::class, 'update'])->name('update');
        Route::delete('/xoa/{id}', [CargoCarController::class, 'destroy'])->name('destroy');
    });

Route::prefix('quan-ly-loai-hop-dong')
    ->as('ContractTypes.')
    ->group(function () {
        Route::get('/danh-sach', [ContractTypeController::class, 'index'])->name('index');
        Route::get('/them', [ContractTypeController::class, 'create'])->name('create');
        Route::post('/them', [ContractTypeController::class, 'store'])->name('store');
        Route::get('/sua/{id}', [ContractTypeController::class, 'edit'])->name('edit');
        Route::put('/cap-nhat/{id}', [ContractTypeController::class, 'update'])->name('update');
        Route::delete('/xoa/{id}', [ContractTypeController::class, 'destroy'])->name('destroy');
    });

Route::prefix('khach-hang')
    ->as('customer.')
    ->group(function () {
        Route::get('/danh-sach', [CustomerController::class, 'index'])->name('index');
    });

Route::prefix('quan-ly-san-pham')
    ->as('product.')
    ->group(function () {
        Route::get('/danh-sach', [ProductController::class, 'index'])->name('index');
        Route::get('/them-moi', [ProductController::class, 'create'])->name('create');
        Route::post('/them-moi', [ProductController::class, 'store'])->name('store');
        Route::get('/sua/{sku}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/sua/{sku}', [ProductController::class, 'update'])->name('update');
        Route::delete('/xoa/{id}', [ProductController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('quan-ly-don-vi')
    ->as('units.')
    ->group(function () {
        Route::get('/danh-sach', [UnitController::class, 'index'])->name('index');
        Route::get('/them-moi', [UnitController::class, 'create'])->name('create');
        Route::post('/them-moi', [UnitController::class, 'store'])->name('store');
        Route::get('/sua/{id}', [UnitController::class, 'edit'])->name('edit');
        Route::put('/sua/{id}', [UnitController::class, 'update'])->name('update');
        Route::delete('/xoa/{id}', [UnitController::class, 'destroy'])->name('destroy');
    });
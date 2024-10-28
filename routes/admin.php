<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CargoCarController;
use App\Http\Controllers\CargoCarTypeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContractTypeController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerRankController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ImportOrderController;
use App\Http\Controllers\ImportOrderDetailController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TripDetailController;
use App\Http\Controllers\UnitController;
// <+====================ROUTER MẪU====================+>
// Route::prefix('duong-dan-mau')
//     ->as('sampleRoute.')
//     ->group(function () {
//         Route::get('/danh-sach', [BrandController::class, 'index'])->name('index');
//         Route::get('/them-moi', [BrandController::class, 'create'])->name('create');
//         Route::post('/them-moi', [BrandController::class, 'store'])->name('store');
//         Route::get('/sua/{}', [BrandController::class, 'edit'])->name('edit');
//         Route::put('/cap-nhat/{}', [BrandController::class, 'update'])->name('update');
//     });
// <+====================ROUTE MẪU====================+>

Route::get('/', function () {
    return view('admin/dashboard');
})->name('admin.dashboard');


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
Route::prefix('quan-ly-tai-khoan')
    ->as('suppliers.')
    ->group(function () {
        Route::get('/danh-sach-nha-cung-cap', [SupplierController::class, 'index'])->name('index');
        Route::get('/them-moi-nha-cung-cap', [SupplierController::class, 'create'])->name('create');
        Route::post('/them-moi', [SupplierController::class, 'store'])->name('store');
        Route::get('{id}/sua-nha-cung-cap', [SupplierController::class, 'edit'])->name('edit');
        Route::put('{id}/cap-nhat', [SupplierController::class, 'update'])->name('update');
    });

Route::get('/locations/{customer_id}', [LocationController::class, 'getLocationsByCustomerId']);
Route::post('/set-default-address', [LocationController::class, 'setDefaultAddress'])->name('setDefaultAddress');
Route::get('/orders/customer-location/{customerId}', [OrderController::class, 'getCustomerLocation']);



Route::prefix('quan-ly-nhan-vien')
    ->as('employees.')
    ->group(function () {
        Route::get('/danh-sach-nhan-vien', [EmployeeController::class, 'index'])->name('index');
        Route::get('/them-moi-nhan-vien', [EmployeeController::class, 'create'])->name('create');
        Route::post('/them-moi', [EmployeeController::class, 'store'])->name('store');
        Route::get('{id}/sua-thong-tin-nhan-vien', [EmployeeController::class, 'edit'])->name('edit');
        Route::put('{id}/cap-nhat', [EmployeeController::class, 'update'])->name('update');
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
    ->as('contract.')
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
    });

Route::prefix('quan-ly-loai-hop-dong')
    ->as('contractType.')
    ->group(function () {
        Route::get('/danh-sach', [ContractTypeController::class, 'index'])->name('index');
        Route::get('/them', [ContractTypeController::class, 'create'])->name('create');
        Route::post('/them', [ContractTypeController::class, 'store'])->name('store');
        Route::get('/sua/{id}', [ContractTypeController::class, 'edit'])->name('edit');
        Route::put('/cap-nhat/{id}', [ContractTypeController::class, 'update'])->name('update');
    });

Route::prefix('khach-hang')
    ->as('customer.')
    ->group(function () {
        Route::get('/danh-sach', [CustomerController::class, 'index'])->name('index');
    });

Route::prefix('san-pham')
    ->as('product.')
    ->group(function () {
        Route::get('/danh-sach', [ProductController::class, 'index'])->name('index');
        Route::get('/them-moi', [ProductController::class, 'create'])->name('create');
        Route::post('/them-moi', [ProductController::class, 'store'])->name('store');
        Route::get('/sua/{sku}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/sua/{sku}', [ProductController::class, 'update'])->name('update');
    });


Route::prefix('don-hang-nhap')
    ->as('importOrder.')
    ->group(function () {
        Route::get('/danh-sach', [ImportOrderController::class, 'index'])->name('index');
        Route::get('/them-moi', [ImportOrderController::class, 'create'])->name('create');
        Route::post('/them-moi-don-nhap', [ImportOrderController::class, 'store'])->name('store');
        Route::get('/sua-don-hang/{slug}', [ImportOrderController::class, 'edit'])->name('edit');
        Route::put('/cap-nhat-don-hang/{slug}', [ImportOrderController::class, 'update'])->name('update');
        Route::get('/chi-tiet-don-hang/{slug}', [ImportOrderDetailController::class, 'index'])->name('indexImportDetail');

        Route::post('/yeu-cau-huy/{slug}', [ImportOrderController::class, 'requestCancel'])->name('requestCancel');
        Route::get('/pending-cancel-requests', [ImportOrderController::class, 'getPendingCancelRequests'])->name('pendingCancelRequests');
        Route::get('/cancel/{slug}', [ImportOrderController::class, 'cancelImportOrder'])->name('cancel');

        Route::post('/xac-nhan/{slug}', [ImportOrderController::class, 'confirmOrder'])->name(name: 'confirmOrder');
        Route::get('/tu-dong-cap-nhat/{slug}', [ImportOrderController::class, 'autoUpdateStatus'])->name('autoUpdateStatus');
        Route::get('/pending-new-requests', [ImportOrderController::class, 'getPendingNewRequests'])->name('pendingNewRequests');

        Route::get('/kiem-tra-trang-thai/{slug}', [ImportOrderController::class, 'checkOrderStatus'])->name('checkOrderStatus');
        Route::post('/cap-nhat-trang-thai/{slug}', [ImportOrderController::class, 'updateOrderStatus'])->name('updateOrderStatus');
    });
Route::get('/', [ImportOrderController::class, 'dashboard'])->name('admin.dashboard');

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

Route::prefix('loai-xe')
    ->as('cargo_car_types.')
    ->group(function () {
        Route::get('/danh-sach', [CargoCarTypeController::class, 'index'])->name('index');
        Route::get('/them-moi', [CargoCarTypeController::class, 'create'])->name('create');
        Route::post('/store', [CargoCarTypeController::class, 'store'])->name('store');
        Route::get('/sua/{id}', [CargoCarTypeController::class, 'edit'])->name('edit');
        Route::put('/sua/{id}', [CargoCarTypeController::class, 'update'])->name('update');
        Route::delete('/xoa/{id}', [CargoCarTypeController::class, 'destroy'])->name('destroy');
    });
Route::prefix('danh-muc')
    ->as('category.')
    ->group(function () {
        Route::get('/danh-sach', [CategoryController::class, 'index'])->name('index');
        Route::get('/them-moi', [CategoryController::class, 'create'])->name('create');
        Route::post('/them-moi', [CategoryController::class, 'store'])->name('store');
        Route::get('/sua/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/sua/{id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/xoa/{id}', [CategoryController::class, 'destroy'])->name('destroy');
    });
Route::prefix('xep-hang-khach-hang')
    ->as('customer_ranks.')
    ->group(function () {
        Route::get('/danh-sach', [CustomerRankController::class, 'index'])->name('index');
        Route::get('/them-moi', [CustomerRankController::class, 'create'])->name('create');
        Route::post('/them-moi', [CustomerRankController::class, 'store'])->name('store');
        Route::get('/sua/{id}', [CustomerRankController::class, 'edit'])->name('edit');
        Route::put('/sua/{id}', [CustomerRankController::class, 'update'])->name('update');
        Route::delete('/xoa/{id}', [CustomerRankController::class, 'destroy'])->name('destroy');
    });
Route::prefix('quan-ly-chuyen-xe')
    ->as('trips.')
    ->group(function () {
        Route::get('/danh-sach-chuyen-xe', [TripController::class, 'index'])->name('index');
        Route::get('/them-moi', [TripController::class, 'create'])->name('create');
        Route::post('/them-moi', [TripController::class, 'store'])->name('store');
        Route::get('/sua/{id}', [TripController::class, 'edit'])->name('edit');
        Route::put('/sua/{id}', [TripController::class, 'update'])->name('update');
        Route::delete('/xoa/{id}', [TripController::class, 'destroy'])->name('destroy');
    });

Route::prefix('quan-ly-chuyen-xe')
    ->as('trips_details.')
    ->group(function () {
        Route::get('/chi-tiet-chuyen-xe/{id}', [TripDetailController::class, 'index'])->name('index');
    });

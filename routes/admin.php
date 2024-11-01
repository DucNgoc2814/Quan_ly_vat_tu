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


// employees
// try {
//     $token = Session('token');
//     $dataToken = JWTAuth::setToken($token)->getPayload();
//     dd($dataToken);
// } catch (\Exception $e) {
//     return redirect()->route('employees.login')->with('error', 'Phiên đăng nhập đã hết hạn, vui lòng đăng nhập lại');
// }

Route::prefix('employees')
    ->as('employees.')
    ->group(function () {
        Route::get('/404-not-found', [EmployeeController::class, 'notFound'])->name('notfound');
        Route::get('/dang-nhap', [EmployeeController::class, 'login'])->name('login');
        Route::post('/dang-nhap', [EmployeeController::class, 'loginPost'])->name('loginPost');
    });
Route::middleware('CheckEmployees')->group(
    function () {
        Route::get('/dashboard', [ImportOrderController::class, 'dashboard'])->name('admin.dashboard')->middleware('permission:1');
        Route::prefix('quan-ly-nha-phan-phoi')
            ->as('suppliers.')
            ->group(function () {
                Route::get('/danh-sach', [SupplierController::class, 'index'])->name('index')->middleware('permission:1');
                Route::get('/danh-sach-da-an', [SupplierController::class, 'listTrashSupplier'])->name('listTrashSupplier')->middleware('permission:2');
                Route::get('/khoi-phuc/{id}', [SupplierController::class, 'restoreSupplier'])->name('restoreSupplier')->middleware('permission:3');
                Route::get('/them-moi', [SupplierController::class, 'create'])->name('create')->middleware('permission:4');
                Route::post('/them-moi', [SupplierController::class, 'store'])->name('store')->middleware('permission:4');
                Route::get('/sua/{id}', [SupplierController::class, 'edit'])->name('edit')->middleware('permission:5');
                Route::put('/cap-nhat/{id}', [SupplierController::class, 'update'])->name('update')->middleware('permission:5');
                Route::delete('/an/{id}', [SupplierController::class, 'destroy'])->name('destroy')->middleware('permission:6');
            });
        Route::prefix('quan-ly-nhan-vien')
            ->as('employees.')
            ->group(function () {
                Route::get('/danh-sach-nhan-vien', [EmployeeController::class, 'index'])->name('index')->middleware('permission:7');
                Route::get('/them-moi-nhan-vien', [EmployeeController::class, 'create'])->name('create')->middleware('permission:8');
                Route::post('/them-moi', [EmployeeController::class, 'store'])->name('store')->middleware('permission:8');
                Route::get('{id}/sua-thong-tin-nhan-vien', [EmployeeController::class, 'edit'])->name('edit')->middleware('permission:9');
                Route::put('{id}/cap-nhat', [EmployeeController::class, 'update'])->name('update')->middleware('permission:9');
            });
        Route::prefix('quan-ly-ban-hang')
            ->as('order.')
            ->group(function () {
                Route::get('/danh-sach-ban', [OrderController::class, 'index'])->name('index')->middleware('permission:10');
                Route::get('/them-don-hang', [OrderController::class, 'create'])->name('create')->middleware('permission:11');
                Route::post('/nhap-them-don-hang', [OrderController::class, 'store'])->name('store')->middleware('permission:11');
                Route::get('/sua-don-hang/{slug}', [OrderController::class, 'edit'])->name('edit')->middleware('permission:12');
                Route::put('/cap-nhat-don-hang/{slug}', [OrderController::class, 'update'])->name('update')->middleware('permission:12');
                Route::post('/cap-nhat-trang-thai/{slug}', [OrderController::class, 'updateStatus'])->name('updateStatus')->middleware('permission:13');
                Route::get('/chi-tiet-don-hang/{slug}', [OrderDetailController::class, 'index'])->name('indexDetail')->middleware('permission:14');
            });

        Route::prefix('quan-ly-thanh-truot')
            ->as('sliders.')
            ->group(function () {
                Route::get('/danh-sach', [SliderController::class, 'index'])->name('index')->middleware('permission:15');
                Route::get('/them-moi', [SliderController::class, 'create'])->name('create')->middleware('permission:16');
                Route::post('/nhap-them-moi', [SliderController::class, 'store'])->name('store')->middleware('permission:16');
                Route::get('/chi-tiet/{id}', [SliderController::class, 'show'])->name('show')->middleware('permission:17');
                Route::get('/sua/{id}', [SliderController::class, 'edit'])->name('edit')->middleware('permission:18');
                Route::put('/nhap-sua/{id}', [SliderController::class, 'update'])->name('update')->middleware('permission:18');
                Route::delete('/xoa/{id}', [SliderController::class, 'destroy'])->name('destroy')->middleware('permission:19');
            });
        Route::prefix('thuong-hieu')
            ->as('brand.')
            ->group(function () {
                Route::get('/danh-sach', [BrandController::class, 'index'])->name('index')->middleware('permission:20');
                Route::get('/them-moi', [BrandController::class, 'create'])->name('create')->middleware('permission:21');
                Route::post('/them-moi', [BrandController::class, 'store'])->name('store')->middleware('permission:21');
                Route::get('/sua/{sku}', [BrandController::class, 'edit'])->name('edit')->middleware('permission:22');
                Route::put('/sua/{brand}', [BrandController::class, 'update'])->name('update')->middleware('permission:22');
            });
        Route::prefix('hop-dong')
            ->as('contract.')
            ->group(function () {
                Route::get('/danh-sach', [ContractController::class, 'index'])->name('index')->middleware('permission:23');
                Route::get('/them-moi', [ContractController::class, 'create'])->name('create')->middleware('permission:24');
                Route::post('/them-moi', [ContractController::class, 'store'])->name('store')->middleware('permission:24');
                Route::get('/sua/{contract}', [ContractController::class, 'edit'])->name('edit')->middleware('permission:25');
                Route::put('/sua/{contract}', [ContractController::class, 'update'])->name('update')->middleware('permission:25');
            });

        Route::prefix('quan-ly-xe')
            ->as('CargoCars.')
            ->group(function () {
                Route::get('/danh-sach', [CargoCarController::class, 'index'])->name('index')->middleware('permission:26');
                Route::get('/them-moi', [CargoCarController::class, 'create'])->name('create')->middleware('permission:27');
                Route::post('/them-moi', [CargoCarController::class, 'store'])->name('store')->middleware('permission:27');
                Route::get('/sua/{id}', [CargoCarController::class, 'edit'])->name('edit')->middleware('permission:28');
                Route::put('/cap-nhat/{id}', [CargoCarController::class, 'update'])->name('update')->middleware('permission:28');
            });

        Route::prefix('quan-ly-loai-hop-dong')
            ->as('contractType.')
            ->group(function () {
                Route::get('/danh-sach', [ContractTypeController::class, 'index'])->name('index')->middleware('permission:29');
                Route::get('/them', [ContractTypeController::class, 'create'])->name('create')->middleware('permission:30');
                Route::post('/them', [ContractTypeController::class, 'store'])->name('store')->middleware('permission:30');
                Route::get('/sua/{id}', [ContractTypeController::class, 'edit'])->name('edit')->middleware('permission:31');
                Route::put('/cap-nhat/{id}', [ContractTypeController::class, 'update'])->name('update')->middleware('permission:31');
            });

        Route::prefix('khach-hang')
            ->as('customer.')
            ->group(function () {
                Route::get('/danh-sach', [CustomerController::class, 'index'])->name('index')->middleware('permission:32');
            });

        Route::prefix('san-pham')
            ->as('product.')
            ->group(function () {
                Route::get('/danh-sach', [ProductController::class, 'index'])->name('index')->middleware('permission:33');
                Route::get('/them-moi', [ProductController::class, 'create'])->name('create')->middleware('permission:34');
                Route::post('/them-moi', [ProductController::class, 'store'])->name('store')->middleware('permission:34');
                Route::get('/sua/{id}', [ProductController::class, 'edit'])->name('edit')->middleware('permission:35');
                Route::put('/sua/{slug}', [ProductController::class, 'update'])->name('update')->middleware('permission:35');
            });


        Route::prefix('don-hang-nhap')
            ->as('importOrder.')
            ->group(function () {
                Route::get('/danh-sach', [ImportOrderController::class, 'index'])->name('index')->middleware('permission:36');
                Route::get('/them-moi', [ImportOrderController::class, 'create'])->name('create')->middleware('permission:37');
                Route::post('/them-moi-don-nhap', [ImportOrderController::class, 'store'])->name('store')->middleware('permission:37');
                Route::get('/sua-don-hang/{slug}', [ImportOrderController::class, 'edit'])->name('edit')->middleware('permission:38');
                Route::put('/cap-nhat-don-hang/{slug}', [ImportOrderController::class, 'update'])->name('update')->middleware('permission:38');
                Route::get('/chi-tiet-don-hang/{slug}', [ImportOrderDetailController::class, 'index'])->name('indexImportDetail')->middleware('permission:39');
                Route::post('/yeu-cau-huy/{slug}', [ImportOrderController::class, 'requestCancel'])->name('requestCancel')->middleware('permission:40');
                Route::get('/pending-cancel-requests', [ImportOrderController::class, 'getPendingCancelRequests'])->name('pendingCancelRequests')->middleware('permission:41');
                Route::get('/cancel/{slug}', [ImportOrderController::class, 'cancelImportOrder'])->name('cancel')->middleware('permission:42');
                Route::post('/xac-nhan/{slug}', [ImportOrderController::class, 'confirmOrder'])->name(name: 'confirmOrder')->middleware('permission:43');
                Route::get('/tu-dong-cap-nhat/{slug}', [ImportOrderController::class, 'autoUpdateStatus'])->name('autoUpdateStatus')->middleware('permission:44');
                Route::get('/pending-new-requests', [ImportOrderController::class, 'getPendingNewRequests'])->name('pendingNewRequests')->middleware('permission:45');
                Route::get('/kiem-tra-trang-thai/{slug}', [ImportOrderController::class, 'checkOrderStatus'])->name('checkOrderStatus')->middleware('permission:46');
                Route::post('/cap-nhat-trang-thai/{slug}', [ImportOrderController::class, 'updateOrderStatus'])->name('updateOrderStatus')->middleware('permission:47');
            });

        Route::prefix('quan-ly-don-vi')
            ->as('units.')
            ->group(function () {
                Route::get('/danh-sach', [UnitController::class, 'index'])->name('index')->middleware('permission:48');
                Route::get('/them-moi', [UnitController::class, 'create'])->name('create')->middleware('permission:49');
                Route::post('/them-moi', [UnitController::class, 'store'])->name('store')->middleware('permission:49');
                Route::get('/sua/{id}', [UnitController::class, 'edit'])->name('edit')->middleware('permission:50');
                Route::put('/sua/{id}', [UnitController::class, 'update'])->name('update')->middleware('permission:50');
                Route::delete('/xoa/{id}', [UnitController::class, 'destroy'])->name('destroy')->middleware('permission:51');
            });

        Route::prefix('loai-xe')
            ->as('cargo_car_types.')
            ->group(function () {
                Route::get('/danh-sach', [CargoCarTypeController::class, 'index'])->name('index')->middleware('permission:52');
                Route::get('/them-moi', [CargoCarTypeController::class, 'create'])->name('create')->middleware('permission:53');
                Route::post('/store', [CargoCarTypeController::class, 'store'])->name('store')->middleware('permission:53');
                Route::get('/sua/{id}', [CargoCarTypeController::class, 'edit'])->name('edit')->middleware('permission:54');
                Route::put('/sua/{id}', [CargoCarTypeController::class, 'update'])->name('update')->middleware('permission:54');
                Route::delete('/xoa/{id}', [CargoCarTypeController::class, 'destroy'])->name('destroy')->middleware('permission:55');
            });
        Route::prefix('danh-muc')
            ->as('category.')
            ->group(function () {
                Route::get('/danh-sach', [CategoryController::class, 'index'])->name('index')->middleware('permission:56');
                Route::get('/them-moi', [CategoryController::class, 'create'])->name('create')->middleware('permission:57');
                Route::post('/them-moi', [CategoryController::class, 'store'])->name('store')->middleware('permission:57');
                Route::get('/sua/{id}', [CategoryController::class, 'edit'])->name('edit')->middleware('permission:58');
                Route::put('/sua/{id}', [CategoryController::class, 'update'])->name('update')->middleware('permission:58');
                Route::delete('/xoa/{id}', [CategoryController::class, 'destroy'])->name('destroy')->middleware('permission:59');
            });
        Route::prefix('xep-hang-khach-hang')
            ->as('customer_ranks.')
            ->group(function () {
                Route::get('/danh-sach', [CustomerRankController::class, 'index'])->name('index')->middleware('permission:60');
                Route::get('/them-moi', [CustomerRankController::class, 'create'])->name('create')->middleware('permission:61');
                Route::post('/them-moi', [CustomerRankController::class, 'store'])->name('store')->middleware('permission:61');
                Route::get('/sua/{id}', [CustomerRankController::class, 'edit'])->name('edit')->middleware('permission:62');
                Route::put('/sua/{id}', [CustomerRankController::class, 'update'])->name('update')->middleware('permission:62');
                Route::delete('/xoa/{id}', [CustomerRankController::class, 'destroy'])->name('destroy')->middleware('permission:63');
            });
        Route::prefix('quan-ly-chuyen-xe')
            ->as('trips.')
            ->group(function () {
                Route::get('/danh-sach-chuyen-xe', [TripController::class, 'index'])->name('index')->middleware('permission:64');
                Route::get('/them-moi', [TripController::class, 'create'])->name('create')->middleware('permission:65');
                Route::post('/them-moi', [TripController::class, 'store'])->name('store')->middleware('permission:65');
                Route::get('/sua/{id}', [TripController::class, 'edit'])->name('edit')->middleware('permission:66');
                Route::put('/sua/{id}', [TripController::class, 'update'])->name('update')->middleware('permission:66');
                Route::delete('/xoa/{id}', [TripController::class, 'destroy'])->name('destroy')->middleware('permission:67');
            });

        Route::prefix('quan-ly-chuyen-xe')
            ->as('trips_details.')
            ->group(function () {
                Route::get('/chi-tiet-chuyen-xe/{id}', [TripDetailController::class, 'index'])->name('index')->middleware('permission:68');
            });
    }
);

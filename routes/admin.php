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
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PermissionRoleEmployeesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleEmployeeController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TripDetailController;
use App\Http\Controllers\TripManagementController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\LogController;
use App\Exports\VariationsExport;
use App\Http\Controllers\AttributeController;
use Maatwebsite\Excel\Facades\Excel;
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
Route::get('/dashboard', [ImportOrderController::class, 'dashboard'])->name('admin.dashboard');


// employees
// try {
//     $token = Session('token');
//     $dataToken = JWTAuth::setToken($token)->getPayload();
//     dd($dataToken);
// } catch (\Exception $e) {
//     return redirect()->route('employees.login')->with('error', 'Phiên đăng nhập đã hết hạn, vui lòng đăng nhập lại');
// }


// Route::get('/dashboard', [ImportOrderController::class, 'dashboard'])->name('admin.dashboard');


Route::prefix('employees')
    ->as('employees.')
    ->group(function () {
        Route::get('/404-not-found', [EmployeeController::class, 'notFound'])->name('notfound');
        Route::get('/dang-nhap', [EmployeeController::class, 'login'])->name('login');
        Route::post('/dang-nhap', [EmployeeController::class, 'loginPost'])->name('loginPost');
    });
Route::prefix('orderconfirm')
    ->as('orderconfirm.')
    ->group(function () {
        Route::get('/404-not-found', [TripManagementController::class, 'notFound'])->name('notfound');
        Route::get('/dang-nhap', [TripManagementController::class, 'login'])->name('login');
        Route::post('/dang-nhap', [TripManagementController::class, 'loginPost'])->name('loginPost');
        Route::get('/xan-nhan-don-hang', [TripManagementController::class, 'index'])->name('index');
        Route::get('/chi-tiet/{id}', [TripManagementController::class, 'show'])->name('show');
        Route::put('/chi-tiet/{id}', [TripManagementController::class, 'update'])->name('update');


        Route::get('/dang-xuat', [EmployeeController::class, 'logOut'])->name('logOut');
    });
Route::middleware('CheckEmployees')->group(
    function () {
        Route::get('/dashboard', [ImportOrderController::class, 'dashboard'])->name('admin.dashboard')->middleware('permission:1');
        // Quản lý chức vụ
        Route::post('/them-chuc-vu', [RoleEmployeeController::class, 'create'])->name('addRole')->middleware('permission:2');
        // PHÂN QUYỀN
        Route::post('/permissions/toggle', [PermissionRoleEmployeesController::class, 'permissionsToggle'])->name('permissionsToggle')->middleware('permission:3');
        Route::prefix('quan-ly-nhan-vien')
            ->as('employees.')
            ->group(function () {
                Route::get('/danh-sach-quyen-truy-cap', [PermissionRoleEmployeesController::class, 'index'])->name('listPermissions')->middleware('permission:4');
                Route::get('/danh-sach-nhan-vien', [EmployeeController::class, 'index'])->name('index')->middleware('permission:5');
                Route::get('/them-moi-nhan-vien', [EmployeeController::class, 'create'])->name('create')->middleware('permission:6');
                Route::post('/them-moi', [EmployeeController::class, 'store'])->name('store')->middleware('permission:6');
                Route::get('{id}/sua-thong-tin-nhan-vien', [EmployeeController::class, 'edit'])->name('edit')->middleware('permission:7');
                Route::put('{id}/cap-nhat', [EmployeeController::class, 'update'])->name('update')->middleware('permission:8');
            });
        Route::prefix('quan-ly-nha-phan-phoi')
            ->as('suppliers.')
            ->group(function () {
                Route::get('/danh-sach', [SupplierController::class, 'index'])->name('index')->middleware('permission:9');
                Route::get('/danh-sach-da-an', [SupplierController::class, 'listTrashSupplier'])->name('listTrashSupplier')->middleware('permission:10');
                Route::get('/khoi-phuc/{id}', [SupplierController::class, 'restoreSupplier'])->name('restoreSupplier')->middleware('permission:11');
                Route::get('/them-moi', [SupplierController::class, 'create'])->name('create')->middleware('permission:12');
                Route::post('/them-moi', [SupplierController::class, 'store'])->name('store')->middleware('permission:12');
                Route::get('/sua/{id}', [SupplierController::class, 'edit'])->name('edit')->middleware('permission:13');
                Route::put('/cap-nhat/{id}', [SupplierController::class, 'update'])->name('update')->middleware('permission:13');
                Route::delete('/an/{id}', [SupplierController::class, 'destroy'])->name('destroy')->middleware('permission:14');
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
        Route::delete('/locations/{id}', [LocationController::class, 'destroy']);
        Route::get('/locations/getLocation/{id}', [LocationController::class, 'getLocation']);


        Route::prefix('quan-ly-nhan-vien')
            ->as('employees.')
            ->group(function () {
                Route::get('/danh-sach-nhan-vien', [EmployeeController::class, 'index'])->name('index');
                Route::get('/them-moi-nhan-vien', [EmployeeController::class, 'create'])->name('create');
                Route::post('/them-moi', [EmployeeController::class, 'store'])->name('store');
                Route::get('{id}/sua-thong-tin-nhan-vien', [EmployeeController::class, 'edit'])->name('edit');
                Route::put('{id}/cap-nhat', [EmployeeController::class, 'update'])->name('update');
            });

        Route::prefix('quan-ly-thanh-truot')
            ->as('sliders.')
            ->group(function () {
                Route::get('/danh-sach', [SliderController::class, 'index'])->name('index')->middleware('permission:20');
                Route::get('/them-moi', [SliderController::class, 'create'])->name('create')->middleware('permission:21');
                Route::post('/nhap-them-moi', [SliderController::class, 'store'])->name('store')->middleware('permission:21');
                Route::get('/chi-tiet/{id}', [SliderController::class, 'show'])->name('show')->middleware('permission:22');
                Route::get('/sua/{id}', [SliderController::class, 'edit'])->name('edit')->middleware('permission:23');
                Route::put('/nhap-sua/{id}', [SliderController::class, 'update'])->name('update')->middleware('permission:23');
                Route::delete('/xoa/{id}', [SliderController::class, 'destroy'])->name('destroy')->middleware('permission:24');
            });
        Route::prefix('thuong-hieu')
            ->as('brand.')
            ->group(function () {
                Route::get('/danh-sach', [BrandController::class, 'index'])->name('index')->middleware('permission:25');
                Route::get('/them-moi', [BrandController::class, 'create'])->name('create')->middleware('permission:26');
                Route::post('/them-moi', [BrandController::class, 'store'])->name('store')->middleware('permission:26');
                Route::get('/sua/{sku}', [BrandController::class, 'edit'])->name('edit')->middleware('permission:27');
                Route::put('/sua/{brand}', [BrandController::class, 'update'])->name('update')->middleware('permission:27');
            });
        Route::prefix('hop-dong')
            ->as('contract.')
            ->group(function () {
                Route::get('/danh-sach', [ContractController::class, 'index'])->name('index')->middleware('permission:28');
                Route::get('/them-moi', [ContractController::class, 'create'])->name('create')->middleware('permission:29');
                Route::post('/them-moi', [ContractController::class, 'store'])->name('store')->middleware('permission:29');
                Route::get('/sua/{contract}', [ContractController::class, 'edit'])->name('edit')->middleware('permission:30');
                Route::put('/sua/{contract}', [ContractController::class, 'update'])->name('update')->middleware('permission:30');
                Route::post('/gui-xac-nhan/{id}', [ContractController::class, 'sendToManager'])->name('sendToManager');
                Route::post('/gui-xac-nhan-khach-hang/{id}', [ContractController::class, 'sendToCustomer'])->name('sendToCustomer');
                Route::post('/confirm/{id}', [ContractController::class, 'confirmContract'])->name('confirm');
                Route::post('/reject/{id}', [ContractController::class, 'rejectContract'])->name('reject');

                // Route::get('/hop-dong/xac-nhan/{id}/{token}', [ContractController::class, 'customerApproveFromEmail'])->name('customerApprove');

                Route::get('/hop-dong/xac-nhan/{id}', [ContractController::class, 'customerApprove'])->name('customerApprove');
                Route::get('/hop-dong/tu-choi/{id}/{token}', [ContractController::class, 'customerRejectFromEmail'])->name('customerReject');


                Route::get('/sua/{contract_number}', [ContractController::class, 'edit'])->name('edit')->middleware('permission:30');
                Route::put('/sua/{contract_number}', [ContractController::class, 'update'])->name('update')->middleware('permission:30');
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
                Route::post('/yeu-cau-huy/{slug}', [OrderController::class, 'requestCancel'])->name('requestCancel');
            });

        Route::prefix('quan-ly-xe')
            ->as('CargoCars.')
            ->group(function () {
                Route::get('/danh-sach', [CargoCarController::class, 'index'])->name('index')->middleware('permission:31');
                Route::get('/them-moi', [CargoCarController::class, 'create'])->name('create')->middleware('permission:32');
                Route::post('/them-moi', [CargoCarController::class, 'store'])->name('store')->middleware('permission:32');
                Route::get('/sua/{id}', [CargoCarController::class, 'edit'])->name('edit')->middleware('permission:33');
                Route::put('/cap-nhat/{id}', [CargoCarController::class, 'update'])->name('update')->middleware('permission:33');
            });

        Route::prefix('quan-ly-loai-hop-dong')
            ->as('contractType.')
            ->group(function () {
                Route::get('/danh-sach', [ContractTypeController::class, 'index'])->name('index')->middleware('permission:34');
                Route::get('/them', [ContractTypeController::class, 'create'])->name('create')->middleware('permission:35');
                Route::post('/them', [ContractTypeController::class, 'store'])->name('store')->middleware('permission:35');
                Route::get('/sua/{id}', [ContractTypeController::class, 'edit'])->name('edit')->middleware('permission:36');
                Route::put('/cap-nhat/{id}', [ContractTypeController::class, 'update'])->name('update')->middleware('permission:36');
            });

        Route::prefix('khach-hang')
            ->as('customer.')
            ->group(function () {
                Route::get('/danh-sach', [CustomerController::class, 'index'])->name('index')->middleware('permission:37');
            });

        Route::prefix('san-pham')
            ->as('product.')
            ->group(function () {
                Route::get('/danh-sach', [ProductController::class, 'index'])->name('index')->middleware('permission:38');
                Route::get('/them-moi', [ProductController::class, 'create'])->name('create')->middleware('permission:39');
                Route::post('/them-moi', [ProductController::class, 'store'])->name('store')->middleware('permission:39');
                Route::get('/sua/{slug}', [ProductController::class, 'edit'])->name('edit')->middleware('permission:40');
                Route::put('/sua/{slug}', [ProductController::class, 'update'])->name('update')->middleware('permission:40');
            });

        Route::prefix('don-hang-nhap')
            ->as('importOrder.')
            ->group(function () {
                Route::get('/danh-sach', [ImportOrderController::class, 'index'])->name('index')->middleware('permission:41');
                Route::get('/them-moi', [ImportOrderController::class, 'create'])->name('create')->middleware('permission:42');
                Route::post('/them-moi-don-nhap', [ImportOrderController::class, 'store'])->name('store')->middleware('permission:42');
                Route::get('/sua-don-hang/{slug}', [ImportOrderController::class, 'edit'])->name('edit')->middleware('permission:43');
                Route::put('/cap-nhat-don-hang/{slug}', [ImportOrderController::class, 'update'])->name('update')->middleware('permission:43');
                Route::get('/chi-tiet-don-hang/{slug}', [ImportOrderDetailController::class, 'index'])->name('indexImportDetail')->middleware('permission:44');
                Route::post('/yeu-cau-huy/{slug}', [ImportOrderController::class, 'requestCancel'])->name('requestCancel')->middleware('permission:45');
                Route::get('/pending-cancel-requests', [ImportOrderController::class, 'getPendingCancelRequests'])->name('pendingCancelRequests')->middleware('permission:46');
                Route::get('/cancel/{slug}', [ImportOrderController::class, 'cancelImportOrder'])->name('cancel')->middleware('permission:47');
                Route::post('/xac-nhan/{slug}', [ImportOrderController::class, 'confirmOrder'])->name(name: 'confirmOrder')->middleware('permission:48');
                Route::get('/tu-dong-cap-nhat/{slug}', [ImportOrderController::class, 'autoUpdateStatus'])->name('autoUpdateStatus')->middleware('permission:49');
                Route::get('/pending-new-requests', [ImportOrderController::class, 'getPendingNewRequests'])->name('pendingNewRequests')->middleware('permission:50');
                Route::get('/kiem-tra-trang-thai/{slug}', [ImportOrderController::class, 'checkOrderStatus'])->name('checkOrderStatus')->middleware('permission:51');
                Route::post('/cap-nhat-trang-thai/{slug}', [ImportOrderController::class, 'updateOrderStatus'])->name('updateOrderStatus')->middleware('permission:52');
                Route::post('/reject/{slug}', [ImportOrderController::class, 'rejectOrder'])->name('rejectOrder');
            });

        Route::prefix('quan-ly-don-vi')
            ->as('units.')
            ->group(function () {
                Route::get('/danh-sach', [UnitController::class, 'index'])->name('index')->middleware('permission:53');
                Route::get('/them-moi', [UnitController::class, 'create'])->name('create')->middleware('permission:54');
                Route::post('/them-moi', [UnitController::class, 'store'])->name('store')->middleware('permission:54');
                Route::get('/sua/{id}', [UnitController::class, 'edit'])->name('edit')->middleware('permission:55');
                Route::put('/sua/{id}', [UnitController::class, 'update'])->name('update')->middleware('permission:55');
                Route::delete('/xoa/{id}', [UnitController::class, 'destroy'])->name('destroy')->middleware('permission:56');
            });


        Route::prefix('loai-xe')
            ->as('cargo_car_types.')
            ->group(function () {
                Route::get('/danh-sach', [CargoCarTypeController::class, 'index'])->name('index')->middleware('permission:57');
                Route::get('/them-moi', [CargoCarTypeController::class, 'create'])->name('create')->middleware('permission:58');
                Route::post('/store', [CargoCarTypeController::class, 'store'])->name('store')->middleware('permission:58');
                Route::get('/sua/{id}', [CargoCarTypeController::class, 'edit'])->name('edit')->middleware('permission:59');
                Route::put('/sua/{id}', [CargoCarTypeController::class, 'update'])->name('update')->middleware('permission:59');
                Route::delete('/xoa/{id}', [CargoCarTypeController::class, 'destroy'])->name('destroy')->middleware('permission:60');
            });
        Route::prefix('danh-muc')
            ->as('category.')
            ->group(function () {
                Route::get('/danh-sach', [CategoryController::class, 'index'])->name('index')->middleware('permission:61');
                Route::get('/them-moi', [CategoryController::class, 'create'])->name('create')->middleware('permission:62');
                Route::post('/them-moi', [CategoryController::class, 'store'])->name('store')->middleware('permission:62');
                Route::get('/sua/{id}', [CategoryController::class, 'edit'])->name('edit')->middleware('permission:63');
                Route::put('/sua/{id}', [CategoryController::class, 'update'])->name('update')->middleware('permission:63');
                Route::delete('/xoa/{id}', [CategoryController::class, 'destroy'])->name('destroy')->middleware('permission:64');
            });
        Route::prefix('xep-hang-khach-hang')
            ->as('customer_ranks.')
            ->group(function () {
                Route::get('/danh-sach', [CustomerRankController::class, 'index'])->name('index')->middleware('permission:65');
                Route::get('/them-moi', [CustomerRankController::class, 'create'])->name('create')->middleware('permission:66');
                Route::post('/them-moi', [CustomerRankController::class, 'store'])->name('store')->middleware('permission:66');
                Route::get('/sua/{id}', [CustomerRankController::class, 'edit'])->name('edit')->middleware('permission:67');
                Route::put('/sua/{id}', [CustomerRankController::class, 'update'])->name('update')->middleware('permission:67');
                Route::delete('/xoa/{id}', [CustomerRankController::class, 'destroy'])->name('destroy')->middleware('permission:68');
            });
        Route::prefix('quan-ly-chuyen-xe')
            ->as('trips.')
            ->group(function () {
                Route::get('/danh-sach-chuyen-xe', [TripController::class, 'index'])->name('index')->middleware('permission:69');
                Route::get('/them-moi', [TripController::class, 'create'])->name('create')->middleware('permission:70');
                Route::post('/them-moi', [TripController::class, 'store'])->name('store')->middleware('permission:70');
                Route::get('/sua/{id}', [TripController::class, 'edit'])->name('edit')->middleware('permission:71');
                Route::put('/sua/{id}', [TripController::class, 'update'])->name('update')->middleware('permission:71');
                Route::delete('/xoa/{id}', [TripController::class, 'destroy'])->name('destroy')->middleware('permission:72');
            });

        Route::prefix('quan-ly-chuyen-xe')
            ->as('trips_details.')
            ->group(function () {
                Route::get('/chi-tiet-chuyen-xe/{id}', [TripDetailController::class, 'index'])->name('index')->middleware('permission:73');
            });
        Route::prefix('quan-ly-chuyen-xe')
            ->as('trips_details.')
            ->group(function () {
                Route::get('/chi-tiet-chuyen-xe/{id}', [TripDetailController::class, 'index'])->name('index')->middleware('permission:73');
            });

        Route::get('/logs', [LogController::class, 'index'])->name('logs.index');

        Route::prefix('quan-ly-ton-kho')
            ->as('inventories.')
            ->group(function () {
                Route::get('/danh-sach', [InventoryController::class, 'index'])->name('index')->middleware('permission:73');
                Route::get('export-variations', function () {
                    return Excel::download(new VariationsExport, 'variations.xlsx');
                })->name('export');
                Route::post('import-variations', [InventoryController::class, 'import'])->name('import');
                Route::post('save', [InventoryController::class, 'save'])->name('save');
                Route::get('get-detail/{id}', [InventoryController::class, 'getDetail'])->name('inventories.getDetail');
            });
        Route::prefix('loai-bien-the')
            ->as('valueVariations.')
            ->group(function () {
                Route::get('/danh-sach', [AttributeController::class, 'index'])->name('index');
                Route::get('/them-moi', [AttributeController::class, 'create'])->name('create');
                Route::post('/them-moi-gia-tri', [AttributeController::class, 'storeValue'])->name('storeValue');
                Route::get('/sua/{id}', [AttributeController::class, 'edit'])->name('edit') ;
                Route::put('/sua/{id}', [AttributeController::class, 'update'])->name('update') ;
                Route::delete('/xoa/{id}', [AttributeController::class, 'destroy'])->name('destroy') ;
            });
    }
);

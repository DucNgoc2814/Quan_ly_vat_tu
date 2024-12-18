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
use App\Http\Controllers\ThongkeController;
use App\Http\Controllers\ImportOrderController;
use App\Http\Controllers\ImportOrderDetailController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MessageController;
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
use App\Http\Controllers\PaymentHistoryController;
use App\Http\Controllers\PublicController;
use Maatwebsite\Excel\Facades\Excel;

Route::prefix('trang-quan-tri')
    ->as('employees.')
    ->group(function () {
        Route::get('/404-not-found', [EmployeeController::class, 'notFound'])->name('notfound');
        Route::get('/dang-nhap', [EmployeeController::class, 'login'])->name('login');
        Route::post('/dang-nhap', [EmployeeController::class, 'loginPost'])->name('loginPost');
        Route::get('/dang-xuat', [EmployeeController::class, 'logOut'])->name('logOut');
    });
Route::prefix('nhan-vien-lai-xe')
    ->as('orderconfirm.')
    ->group(function () {
        Route::get('/404-not-found', [TripManagementController::class, 'notFound'])->name('notfound');
        Route::get('/dang-nhap', [TripManagementController::class, 'login'])->name('login');
        Route::post('/dang-nhap', [TripManagementController::class, 'loginPost'])->name('loginPost');
        Route::get('/dashboard-nv', [TripManagementController::class, 'dashboard'])->name('dashboard');
        Route::get('/danh-sach-chuyen-di', [TripManagementController::class, 'index'])->name('index');
        Route::get('/chi-tiet/{id}', [TripManagementController::class, 'show'])
            ->middleware('checkOwnership')
            ->name('show');
        Route::put('/chi-tiet/{id}', [TripManagementController::class, 'update'])->name('update');
        Route::get('/dang-xuat', [TripManagementController::class, 'logOut'])->name('logOut');
    });
Route::middleware('CheckEmployees')->group(
    function () {
        Route::get('/', [ImportOrderController::class, 'dashboard'])->name('admin.dashboard')->middleware('permission:1');
        Route::get('/dashboard', [ImportOrderController::class, 'dashboard'])->name('admin.dashboard')->middleware('permission:1');
        Route::post('/them-chuc-vu', [RoleEmployeeController::class, 'create'])->name('addRole')->middleware('permission:2');
        Route::post('/permissions/toggle', [PermissionRoleEmployeesController::class, 'permissionsToggle'])->name('permissionsToggle')->middleware('permission:3');
        Route::prefix('quan-ly-nhan-vien')
            ->as('employees.')
            ->group(function () {
                Route::get('/danh-sach-quyen-truy-cap', [PermissionRoleEmployeesController::class, 'index'])->name('listPermissions')->middleware('permission:4');
                Route::get('/danh-sach-nhan-vien', [EmployeeController::class, 'index'])->name('index')->middleware('permission:5');
                Route::get('/them-moi-nhan-vien', [EmployeeController::class, 'create'])->name('create')->middleware('permission:6');
                Route::post('/them-moi', [EmployeeController::class, 'store'])->name('store')->middleware('permission:7');
                Route::get('sua-thong-tin-nhan-vien/{id}', [EmployeeController::class, 'edit'])->name('edit')->middleware('permission:8');
                Route::put('cap-nhat/{id}', [EmployeeController::class, 'update'])->name('update')->middleware('permission:9');
            });
        Route::prefix('quan-ly-nha-phan-phoi')
            ->as('suppliers.')
            ->group(function () {
                Route::get('/danh-sach', [SupplierController::class, 'index'])->name('index')->middleware('permission:10');
                Route::get('/danh-sach-da-an', [SupplierController::class, 'listTrashSupplier'])->name('listTrashSupplier')->middleware('permission:11');
                Route::get('/khoi-phuc/{id}', [SupplierController::class, 'restoreSupplier'])->name('restoreSupplier')->middleware('permission:12');
                Route::get('/them-moi', [SupplierController::class, 'create'])->name('create')->middleware('permission:13');
                Route::post('/them-moi', [SupplierController::class, 'store'])->name('store')->middleware('permission:14');
                Route::get('/sua/{id}', [SupplierController::class, 'edit'])->name('edit')->middleware('permission:114');
                Route::put('/cap-nhat/{id}', [SupplierController::class, 'update'])->name('update')->middleware('permission:16');
                Route::delete('/an/{id}', [SupplierController::class, 'destroy'])->name('destroy')->middleware('permission:17');
            });
        Route::prefix('quan-ly-tai-khoan')
            ->as('suppliers.')
            ->group(function () {
                Route::get('/danh-sach-nha-cung-cap', [SupplierController::class, 'index'])->name('index')->middleware('permission:18');
                Route::get('/them-moi-nha-cung-cap', [SupplierController::class, 'create'])->name('create')->middleware('permission:19');
                Route::post('/them-moi', [SupplierController::class, 'store'])->name('store')->middleware('permission:20');
                Route::get('{id}/sua-nha-cung-cap', [SupplierController::class, 'edit'])->name('edit')->middleware('permission:21');
                Route::put('{id}/cap-nhat', [SupplierController::class, 'update'])->name('update')->middleware('permission:22');
            });
        Route::get('/locations/{customer_id}', [LocationController::class, 'getLocationsByCustomerId'])->middleware('permission:23');
        Route::post('/set-default-address', [LocationController::class, 'setDefaultAddress'])->name('setDefaultAddress')->middleware('permission:24');
        Route::get('/orders/customer-location/{customerId}', [OrderController::class, 'getCustomerLocation'])->middleware('permission:25');
        Route::delete('/locations/{id}', [LocationController::class, 'destroy'])->middleware('permission:26');
        Route::get('/locations/getLocation/{id}', [LocationController::class, 'getLocation'])->middleware('permission:27');
        Route::prefix('quan-ly-nhan-vien')
            ->as('employees.')
            ->group(function () {
                Route::get('/danh-sach-nhan-vien', [EmployeeController::class, 'index'])->name('index')->middleware('permission:28');
                Route::get('/them-moi-nhan-vien', [EmployeeController::class, 'create'])->name('create')->middleware('permission:29');
                Route::post('/them-moi', [EmployeeController::class, 'store'])->name('store')->middleware('permission:30');
                Route::get('{id}/sua-thong-tin-nhan-vien', [EmployeeController::class, 'edit'])->name('edit')->middleware('permission:31');
                Route::put('{id}/cap-nhat', [EmployeeController::class, 'update'])->name('update')->middleware('permission:32');
            });
        Route::prefix('quan-ly-thanh-truot')
            ->as('sliders.')
            ->group(function () {
                Route::get('/danh-sach', [SliderController::class, 'index'])->name('index')->middleware('permission:33');
                Route::get('/them-moi', [SliderController::class, 'create'])->name('create')->middleware('permission:34');
                Route::post('/nhap-them-moi', [SliderController::class, 'store'])->name('store')->middleware('permission:35');
                Route::get('/chi-tiet/{id}', [SliderController::class, 'show'])->name('show')->middleware('permission:36');
                Route::get('/sua/{id}', [SliderController::class, 'edit'])->name('edit')->middleware('permission:37');
                Route::put('/nhap-sua/{id}', [SliderController::class, 'update'])->name('update')->middleware('permission:38');
                Route::delete('/xoa/{id}', [SliderController::class, 'destroy'])->name('destroy')->middleware('permission:39');
            });
        Route::prefix('thuong-hieu')
            ->as('brand.')
            ->group(function () {
                Route::get('/danh-sach', [BrandController::class, 'index'])->name('index')->middleware('permission:40');
                Route::get('/them-moi', [BrandController::class, 'create'])->name('create')->middleware('permission:41');
                Route::post('/them-moi', [BrandController::class, 'store'])->name('store')->middleware('permission:42');
                Route::get('/sua/{sku}', [BrandController::class, 'edit'])->name('edit')->middleware('permission:43');
                Route::put('/sua/{brand}', [BrandController::class, 'update'])->name('update')->middleware('permission:44');
            });
        Route::prefix('hop-dong')
            ->as('contract.')
            ->middleware(['check.ownership'])
            ->group(function () {
                Route::get('/danh-sach', [ContractController::class, 'index'])->name('index')->middleware('permission:45');
                Route::get('/them-moi', [ContractController::class, 'create'])->name('create')->middleware('permission:46');
                Route::post('/them-moi', [ContractController::class, 'store'])->name('store')->middleware('permission:47');
                Route::get('/sua/{contract}', [ContractController::class, 'edit'])->name('edit')->middleware('permission:48');
                Route::put('/sua/{contract}', [ContractController::class, 'update'])->name('update')->middleware('permission:49');
                Route::post('/gui-xac-nhan/{id}', [ContractController::class, 'sendToManager'])->name('sendToManager')->middleware('permission:50');
                Route::post('/gui-xac-nhan-khach-hang/{id}', [ContractController::class, 'sendToCustomer'])->name('sendToCustomer')->middleware('permission:51');
                Route::post('/confirm/{id}', [ContractController::class, 'confirmContract'])->name('confirm')->middleware('permission:52');
                Route::post('/reject/{id}', [ContractController::class, 'rejectContract'])->name('reject')->middleware('permission:53');
                Route::get('/xac-nhan/{id}', [ContractController::class, 'customerApprove'])->name('customerApprove')->middleware('permission:54');
                Route::get('/tu-choi/{id}', [ContractController::class, 'customerReject'])->name('customerReject')->middleware('permission:55');
                // Route::get('/xac-nhan/{id}/{token}', [ContractController::class, 'customerApprove'])->name('customerApprove')->middleware('permission:56');
                // Route::get('/tu-choi/{id}/{token}', [ContractController::class, 'customerReject'])->name('customerReject')->middleware('permission:57');
                Route::get('/sua/{contract_number}', [ContractController::class, 'edit'])->name('edit')->middleware('permission:58');
                Route::put('/sua/{contract_number}', [ContractController::class, 'update'])->name('update')->middleware('permission:59');
                Route::get('/xem-hop-dong/{id}/pdf', [ContractController::class, 'showPdf'])->name('showPdf')->middleware('permission:60');
                Route::post('/gui-giam-doc-pdf/{id}', [ContractController::class, 'sendToManagerPdf'])->name('sendToManagerPdf')->middleware('permission:61');
                Route::post('/reject/{id}', [ContractController::class, 'rejectContract'])->name('reject')->middleware('permission:62');
                Route::get('/status-history/{id}', [ContractController::class, 'getStatusHistory'])->name('status-history')->middleware('permission:63');
                Route::get('/chi-tiet-hop-dong/{id}', [ContractController::class, 'show'])->name('show')->middleware('permission:64');
            });
        Route::prefix('quan-ly-ban-hang')
            ->as('order.')
            ->middleware(['check.ownership'])
            ->group(function () {
                Route::get('/danh-sach-ban-le', [OrderController::class, 'index'])->name('index')->middleware('permission:60');
                Route::get('/danh-sach-ban-le-co-hop-dong', [OrderController::class, 'orderContract'])->name('orderContract')->middleware('permission:60');
                Route::get('/them-don-hang', [OrderController::class, 'create'])->name('create')->middleware('permission:61');
                Route::post('/nhap-them-don-hang', [OrderController::class, 'store'])->name('store')->middleware('permission:62');

                Route::get('/sua-don-hang/{slug}', [OrderController::class, 'edit'])->name('edit')->middleware('permission:63');
                Route::put('/cap-nhat-don-hang/{slug}', [OrderController::class, 'update'])->name('update')->middleware('permission:64');
                Route::post('/cap-nhat-trang-thai/{slug}', [OrderController::class, 'updateStatus'])->name('updateStatus')->middleware('permission:65');
                Route::get('/chi-tiet-don-hang/{slug}', [OrderDetailController::class, 'index'])->name('indexDetail')->middleware('permission:66');
                Route::post('/yeu-cau-huy/{slug}', [OrderController::class, 'requestCancel'])->name('requestCancel')->middleware('permission:67');
                Route::get('/them-don-hang-co-hop-dong/{contract_id}', [OrderController::class, 'createordercontract'])->name('createordercontract');
            });
        Route::prefix('quan-ly-xe')
            ->as('CargoCars.')
            ->group(function () {
                Route::get('/danh-sach', [CargoCarController::class, 'index'])->name('index')->middleware('permission:75');
                Route::get('/them-moi', [CargoCarController::class, 'create'])->name('create')->middleware('permission:76');
                Route::post('/them-moi', [CargoCarController::class, 'store'])->name('store')->middleware('permission:77');
                Route::get('/sua/{id}', [CargoCarController::class, 'edit'])->name('edit')->middleware('permission:78');
                Route::put('/cap-nhat/{id}', [CargoCarController::class, 'update'])->name('update')->middleware('permission:79');
            });
        Route::prefix('quan-ly-loai-hop-dong')
            ->as('contractType.')
            ->group(function () {
                Route::get('/danh-sach', [ContractTypeController::class, 'index'])->name('index')->middleware('permission:80');
                Route::get('/them', [ContractTypeController::class, 'create'])->name('create')->middleware('permission:81');
                Route::post('/them', [ContractTypeController::class, 'store'])->name('store')->middleware('permission:82');
                Route::get('/sua/{id}', [ContractTypeController::class, 'edit'])->name('edit')->middleware('permission:83');
                Route::put('/cap-nhat/{id}', [ContractTypeController::class, 'update'])->name('update')->middleware('permission:84');
            });
        Route::prefix('khach-hang')
            ->as('customer.')
            ->group(function () {
                Route::get('/danh-sach', [CustomerController::class, 'index'])->name('index')->middleware('permission:85');
                Route::get('/them-moi', [CustomerController::class, 'create'])->name('create')->middleware('permission:86');
                Route::post('/them-moi', [CustomerController::class, 'store'])->name('store')->middleware('permission:87');
            });
        Route::prefix('san-pham')
            ->as('product.')
            ->group(function () {
                Route::get('/danh-sach', [ProductController::class, 'index'])->name('index')->middleware('permission:88');
                Route::get('/them-moi', [ProductController::class, 'create'])->name('create')->middleware('permission:89');
                Route::post('/them-moi', [ProductController::class, 'store'])->name('store')->middleware('permission:90');
                Route::get('/sua/{slug}', [ProductController::class, 'edit'])->name('edit')->middleware('permission:91');
                Route::put('/sua/{slug}', [ProductController::class, 'update'])->name('update')->middleware('permission:92');
            });
        Route::prefix('don-hang-nhap')
            ->as('importOrder.')
            ->middleware(['check.ownership'])
            ->group(function () {
                Route::get('/danh-sach', [ImportOrderController::class, 'index'])->name('index')->middleware('permission:93');
                Route::get('/them-moi', [ImportOrderController::class, 'create'])->name('create')->middleware('permission:94');
                Route::post('/them-moi-don-nhap', [ImportOrderController::class, 'store'])->name('store')->middleware('permission:95');
                Route::get('/sua-don-hang/{slug}', [ImportOrderController::class, 'edit'])->name('edit')->middleware('permission:96');
                Route::put('/cap-nhat-don-hang/{slug}', [ImportOrderController::class, 'update'])->name('update')->middleware('permission:97');
                Route::get('/chi-tiet-don-hang/{slug}', [ImportOrderDetailController::class, 'index'])->name('indexImportDetail')->middleware('permission:98');
                Route::post('/yeu-cau-huy/{slug}', [ImportOrderController::class, 'requestCancel'])->name('requestCancel')->middleware('permission:99');
                Route::get('/pending-cancel-requests', [ImportOrderController::class, 'getPendingCancelRequests'])->name('pendingCancelRequests')->middleware('permission:100');
                Route::post('/xac-nhan-huy/{slug}', [ImportOrderController::class, 'cancelImportOrder'])->name('cancel')->middleware('permission:101');
                Route::post('/xac-nhan/{slug}', [ImportOrderController::class, 'confirmOrder'])->name('confirmOrder')->middleware('permission:102');
                Route::get('/tu-dong-cap-nhat/{slug}', [ImportOrderController::class, 'autoUpdateStatus'])->name('autoUpdateStatus')->middleware('permission:103');
                Route::get('/pending-new-requests', [ImportOrderController::class, 'getPendingNewRequests'])->name('pendingNewRequests')->middleware('permission:104');
                Route::get('/kiem-tra-trang-thai/{slug}', [ImportOrderController::class, 'checkOrderStatus'])->name('checkOrderStatus')->middleware('permission:105');
                Route::post('/cap-nhat-trang-thai/{slug}', [ImportOrderController::class, 'updateOrderStatus'])->name('updateOrderStatus')->middleware('permission:106');
                Route::post('/tu-choi-huy/{slug}', [ImportOrderController::class, 'rejectOrder'])->name('rejectOrder')->middleware('permission:107');
            });
        Route::prefix('quan-ly-don-vi')
            ->as('units.')
            ->group(function () {
                Route::get('/danh-sach', [UnitController::class, 'index'])->name('index')->middleware('permission:108');
                Route::get('/them-moi', [UnitController::class, 'create'])->name('create')->middleware('permission:109');
                Route::post('/them-moi', [UnitController::class, 'store'])->name('store')->middleware('permission:110');
                Route::get('/sua/{id}', [UnitController::class, 'edit'])->name('edit')->middleware('permission:111');
                Route::put('/sua/{id}', [UnitController::class, 'update'])->name('update')->middleware('permission:112');
                Route::delete('/xoa/{id}', [UnitController::class, 'destroy'])->name('destroy')->middleware('permission:113');
            });
        Route::prefix('loai-xe')
            ->as('cargo_car_types.')
            ->group(function () {
                Route::get('/danh-sach', [CargoCarTypeController::class, 'index'])->name('index')->middleware('permission:114');
                Route::get('/them-moi', [CargoCarTypeController::class, 'create'])->name('create')->middleware('permission:115');
                Route::post('/store', [CargoCarTypeController::class, 'store'])->name('store')->middleware('permission:116');
                Route::get('/sua/{id}', [CargoCarTypeController::class, 'edit'])->name('edit')->middleware('permission:117');
                Route::put('/sua/{id}', [CargoCarTypeController::class, 'update'])->name('update')->middleware('permission:118');
                Route::delete('/xoa/{id}', [CargoCarTypeController::class, 'destroy'])->name('destroy')->middleware('permission:119');
            });
        Route::prefix('danh-muc')
            ->as('category.')
            ->group(function () {
                Route::get('/danh-sach', [CategoryController::class, 'index'])->name('index')->middleware('permission:120');
                Route::get('/them-moi', [CategoryController::class, 'create'])->name('create')->middleware('permission:121');
                Route::post('/them-moi', [CategoryController::class, 'store'])->name('store')->middleware('permission:122');
                Route::get('/sua/{id}', [CategoryController::class, 'edit'])->name('edit')->middleware('permission:123');
                Route::put('/sua/{id}', [CategoryController::class, 'update'])->name('update')->middleware('permission:124');
                Route::delete('/xoa/{id}', [CategoryController::class, 'destroy'])->name('destroy')->middleware('permission:125');
            });
        Route::prefix('xep-hang-khach-hang')
            ->as('customer_ranks.')
            ->group(function () {
                Route::get('/danh-sach', [CustomerRankController::class, 'index'])->name('index')->middleware('permission:126');
                Route::get('/them-moi', [CustomerRankController::class, 'create'])->name('create')->middleware('permission:127');
                Route::post('/them-moi', [CustomerRankController::class, 'store'])->name('store')->middleware('permission:128');
                Route::get('/sua/{id}', [CustomerRankController::class, 'edit'])->name('edit')->middleware('permission:129');
                Route::put('/sua/{id}', [CustomerRankController::class, 'update'])->name('update')->middleware('permission:130');
                Route::delete('/xoa/{id}', [CustomerRankController::class, 'destroy'])->name('destroy')->middleware('permission:131');
            });
        Route::prefix('quan-ly-chuyen-xe')
            ->as('trips.')
            ->group(function () {
                Route::get('/danh-sach-chuyen-xe', [TripController::class, 'index'])->name('index')->middleware('permission:132');
                Route::get('/them-moi', [TripController::class, 'create'])->name('create')->middleware('permission:133');
                Route::post('/them-moi', [TripController::class, 'store'])->name('store')->middleware('permission:134');
                Route::get('/sua/{id}', [TripController::class, 'edit'])->name('edit')->middleware('permission:135');
                Route::put('/sua/{id}', [TripController::class, 'update'])->name('update')->middleware('permission:136');
                Route::delete('/xoa/{id}', [TripController::class, 'destroy'])->name('destroy')->middleware('permission:137');
            });
        Route::prefix('quan-ly-chuyen-xe')
            ->as('trips_details.')
            ->group(function () {
                Route::get('/chi-tiet-chuyen-xe/{id}', [TripDetailController::class, 'index'])->name('index')->middleware('permission:138');
            });
        Route::get('/logs', [LogController::class, 'index'])->name('logs.index')->middleware('permission:139');
        Route::prefix('quan-ly-ton-kho')
            ->as('inventories.')
            ->group(function () {
                Route::get('/danh-sach', [InventoryController::class, 'index'])->name('index')->middleware('permission:140');
                Route::get('export-variations', function () {
                    return Excel::download(new VariationsExport, 'variations.xlsx');
                })->name('export')->middleware('permission:141');
                Route::post('import-variations', [InventoryController::class, 'import'])->name('import')->middleware('permission:142');
                Route::post('save', [InventoryController::class, 'save'])->name('save')->middleware('permission:143');
                Route::get('get-detail/{id}', [InventoryController::class, 'getDetail'])->name('getDetail')->middleware('permission:144');
                Route::get('lich-su-nhap-hang/{id}', [InventoryController::class, 'historyImport'])->name('historyImport')->middleware('permission:145');
                Route::post('sua-nhieu-san-pham', [InventoryController::class, 'bulkUpdate'])->name('bulkUpdate')->middleware('permission:146');
            });
        Route::get('contracts/confirm/{id}', [ContractController::class, 'customerConfirm'])->name('contracts.customerConfirm');
        Route::get('contracts/reject/{id}', [ContractController::class, 'customerReject'])->name('contracts.customerReject');
        Route::prefix('loai-bien-the')
            ->as('valueVariations.')
            ->group(function () {
                Route::get('/danh-sach', [AttributeController::class, 'index'])->name('index')->middleware('permission:147');
                Route::get('/them-moi', [AttributeController::class, 'create'])->name('create')->middleware('permission:148');
                Route::post('/them-moi', [AttributeController::class, 'store'])->name('store')->middleware('permission:149');
                Route::post('/them-moi-gia-tri', [AttributeController::class, 'storeValue'])->name('storeValue')->middleware('permission:150');
                Route::get('/sua/{id}', [AttributeController::class, 'edit'])->name('edit')->middleware('permission:151');
                Route::put('/sua/{id}', [AttributeController::class, 'update'])->name('update')->middleware('permission:152');
            });
        Route::prefix('lich-su-chuyen-tien')
            ->as('payment.')
            ->group(function () {
                Route::get('/danh-sach', [PaymentHistoryController::class, 'index'])->name('index')->middleware('permission:153');
                Route::post('/them-moi', [PaymentHistoryController::class, 'store'])->name('store')->middleware('permission:154');
                Route::post('/xac-nhan/{id}', [PaymentHistoryController::class, 'confirm'])->name('confirm')->middleware('permission:155');
            });
        Route::get('contracts/confirm/{id}', [ContractController::class, 'customerConfirm'])->name('contracts.customerConfirm')->middleware('permission:156');
        Route::get('contracts/reject/{id}', [ContractController::class, 'customerReject'])->name('contracts.customerReject')->middleware('permission:157');
        Route::prefix('chat')
            ->middleware('CheckEmployees')
            ->group(function () {
                Route::get('/messages', [MessageController::class, 'getMessages'])->name('messages')->middleware('permission:158');
                Route::post('/messages', [MessageController::class, 'sendMessage'])->name('send')->middleware('permission:159');
            });

        Route::post('/gui-giam-doc-pdf/{id}', [ContractController::class, 'sendToManagerPdf'])->name('contract.sendToManagerPdf')->middleware('permission:160');
        Route::get('hop-dong/xem-hop-dong/{id}/pdf', [ContractController::class, 'showPdf'])->name('showPdf')->middleware('permission:161');
        Route::get('/add-quyen-permission/{idquyen}/{idStaff}', [EmployeeController::class, 'changeQuyen'])->name('changeQuyen')->middleware('permission:162');
        Route::delete('/deleteQuyen/{permission_id}/{employee_id}', [EmployeeController::class, 'deletePermission'])->middleware('permission:163');

        Route::post('/gui-giam-doc-pdf/{id}', [ContractController::class, 'sendToManagerPdf'])->name('contract.sendToManagerPdf')->middleware('permission:164');;
        Route::get('hop-dong/xem-hop-dong/{id}/pdf', [ContractController::class, 'showPdf'])->name('showPdf')->middleware('permission:165');
        Route::prefix('hop-dong')
            ->as('contract.')
            ->group(function () {
                Route::get('/xac-nhan/{id}/{token}', [ContractController::class, 'customerApprove'])->name('customerApprove')->middleware('permission:166');;
                Route::get('/tu-choi/{id}/{token}', [ContractController::class, 'customerReject'])->name('customerReject')->middleware('permission:167');;
            });
        Route::get('/quan-ly-ton-kho/lich-su-ban-hang/{id}', [InventoryController::class, 'getExportHistory'])->name('getExportHistory')->middleware('permission:170');;
        Route::get('/quan-ly-ban-hang/danh-sach-don-hop-dong', [OrderController::class, 'orderContract'])->name('orderContract')->middleware('permission:171');
        Route::post('/suppliers/add-variations/{supplier}', [SupplierController::class, 'addVariations'])->name('suppliers.addVariations')->middleware('permission:172');
        Route::delete('/suppliers/{supplier}/variations/{variation}', [SupplierController::class, 'removeVariation'])->name('suppliers.removeVariation')->middleware('permission:173');
        Route::get('/products-by-supplier/{supplierId}', [ImportOrderController::class, 'getVariationsBySupplier'])->middleware('permission:174');
        Route::get('/thong-ke-doanh-thu', [ThongkeController::class, 'thongKeDoanhThu'])->name('thongKeDoanhThu')->middleware('permission:175');
        Route::get('/thong-ke-doanh-thu/date-range', [ThongkeController::class, 'getDateRangeStats'])->name('admin.thongke.dateRange')->middleware('permission:176');
        Route::get('/thong-ke-don-hang', [ThongkeController::class, 'thongKeDonHang'])->name('thongKeDonHang')->middleware('permission:177');
        Route::get('/thong-ke-doanh-thu/revenue', [ThongkeController::class, 'getRevenueStats'])->name('admin.thongke.revenue')->middleware('permission:178');
        Route::post('/thong-ke-don-hang/api', [ThongkeController::class, 'thongKeDonHangApi'])->name('thongKeDonHangapi')->middleware('permission:179');
        Route::get('/thong-ke-san-pham', [ThongkeController::class, 'thongKeSanPham'])->name('thongKeSanPham')->middleware('permission:180');
        Route::get('/thong-ke-doi-tac', [ThongkeController::class, 'thongKeDoiTac'])->name('thongKeDoiTac')->middleware('permission:181');
        Route::get('/thong-ke-doi-tac/filter', [ThongkeController::class, 'filterPartnerStats'])->name('thongKeDoiTac.filter')->middleware('permission:182');
        Route::prefix('quan-ly-ban-hang')
            ->as('order.')
            ->group(function () {
                Route::get('/export-invoice/{orderId}', [OrderController::class, 'exportInvoice'])->name('invoice')->middleware('permission:183');
                Route::post('/them-don-hang', [OrderController::class, 'storeContract'])->name('storeContract')->middleware('permission:184');
                Route::post('/yeu-cau-hoan-tien/{slug}', [OrderController::class, 'requestCancelAndRefund'])->name('order.cancel.refund')->middleware('permission:185');
            });
        // routes/admin.php
        Route::prefix('assignment')->group(function () {
            Route::put('/{type}/{id}', [PublicController::class, 'update'])
                ->name('assignment.update')->middleware('permission:186');
        });
    }
);

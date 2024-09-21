<?php

use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin/dashboard');
});
Route::get('/products', action: function () {
    return view('admin/components/product/create');
});

route::prefix('khach-hang')
    ->as('khach-hang.')
    ->group(function () {
        Route::get('/dang-ky', [CustomerController::class, 'register'])->name('dang-ky');
        Route::post('/handleRegister', [CustomerController::class, 'handleRegister'])->name('handleRegister');
        Route::get('/dang-nhap', [CustomerController::class, 'login'])->name('dang-nhap');
        Route::post('/handleLogin', [CustomerController::class, 'handleLogin'])->name('handleLogin');
        Route::get('/quen-mat-khau', [CustomerController::class, 'forgotPassword'])->name('quen-mat-khau');
        Route::post('/sendMaill', [CustomerController::class, 'sendMaill'])->name('sendMaill');
        Route::get('/nhap-otp', [CustomerController::class, 'showVerifyOtp'])->name('nhap-otp');
        Route::post('/verifyOtp', [CustomerController::class, 'verifyOtp'])->name('verifyOtp');

        Route::get('/doi-mat-khau', [CustomerController::class, 'changepassword'])->name('doi-mat-khau');
        Route::post('/passwordchange', [CustomerController::class, 'passwordchange'])->name('passwordchange');

    });
Route::get('dang-ky', [CustomerController::class, 'register'])->name('dang-ky');
Route::post('handleRegister', [CustomerController::class, 'handleRegister'])->name('handleRegister');

Route::get('dang-nhap', [CustomerController::class, 'login'])->name('login');
Route::post('handleLogin', [CustomerController::class, 'handleLogin'])->name('handleLogin');



// Route::prefix('sliders')
//     ->as('sliders.')
//     ->group(function () {
//         Route::get('/', [SliderController::class, 'index'])->name('index');
//         Route::get('/create', [SliderController::class, 'create'])->name('create');
//         Route::post('/store', [SliderController::class, 'store'])->name('store');
//         Route::get('/show/{id}', [SliderController::class, 'show'])->name('show');
//         Route::get('{id}/edit', [SliderController::class, 'edit'])->name('edit');
//         Route::put('{id}/update', [SliderController::class, 'update'])->name('update');
//         Route::delete('{id}/destroy', [SliderController::class, 'destroy'])->name('destroy');


//     });


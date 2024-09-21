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

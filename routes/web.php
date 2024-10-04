<?php

use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ChangeStatusController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
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


Route::get('/products', action: function () {
    return view('admin/components/product/create');
});



Route::get('/dang-ky', [LoginController::class, 'register'])->name('register');
Route::post('/handleRegister', [LoginController::class, 'handleRegister'])->name('handleRegister');
Route::get('/dang-nhap', [LoginController::class, 'login'])->name('login');
Route::post('/handleLogin', [LoginController::class, 'handleLogin'])->name('handleLogin');
Route::get('/quen-mat-khau', [LoginController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('/sendMaill', [LoginController::class, 'sendMaill'])->name('sendMaill');
Route::get('/nhap-otp', [LoginController::class, 'showVerifyOtp'])->name('showVerifyOtp');
Route::post('/verifyOtp', [LoginController::class, 'verifyOtp'])->name('verifyOtp');
Route::get('/doi-mat-khau', [LoginController::class, 'changepassword'])->name('changepassword');
Route::post('/passwordchange', [LoginController::class, 'passwordchange'])->name('passwordchange');
// <+====================TINHNGUYEN====================+>
Route::post('/change-isActive', [ChangeStatusController::class, 'updateStatus'])->name('updateStatus');

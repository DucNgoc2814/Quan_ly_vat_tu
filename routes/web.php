<?php


use App\Http\Controllers\ChangeStatusController;
use App\Http\Controllers\EmployeeController;
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

Route::post('/change-isActive', [ChangeStatusController::class, 'updateStatus'])->name('updateStatus');
Route::get('/', [LoginController::class, 'home'])->name('home');
Route::get('/dang-ky', [LoginController::class, 'register'])->name('register');
Route::post('/handleRegister', [LoginController::class, 'handleRegister'])->name('handleRegister');
Route::get('/dang-nhap', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/handleLogin', [LoginController::class, 'handleLogin'])->name('handleLogin');
Route::get('/quen-mat-khau', [LoginController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('/sendMaill', [LoginController::class, 'sendMaill'])->name('sendMaill');
Route::get('/nhap-otp', [LoginController::class, 'showVerifyOtp'])->name('showVerifyOtp');
Route::post('/verifyOtp', [LoginController::class, 'verifyOtp'])->name('verifyOtp');
Route::get('/doi-mat-khau', [LoginController::class, 'changepassword'])->name('changepassword');
Route::post('/passwordchange', [LoginController::class, 'passwordchange'])->name('passwordchange');
Route::get('/doi-mat-khau-moi', [LoginController::class, 'password'])->name('password');
Route::post('/passwordUser', [LoginController::class, 'passwordUser'])->name('passwordUser');
Route::get('/thong-tin-tai-khoan', [LoginController::class, 'profile'])->name('profile');
Route::get('/cap-nhat-tai-khoan', [LoginController::class, 'profileUser'])->name('profileUser');
Route::post('/updateProfile', [LoginController::class, 'updateProfile'])->name('updateProfile');
Route::get('/test', function () {
    echo "ok";
})
    ->middleware('checkCustomer');
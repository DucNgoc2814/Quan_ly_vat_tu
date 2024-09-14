<?php

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
Route::get('/products', function () {
    return view('admin/components/product/create');
});

Route::get('dang-ky', [CustomerController::class, 'register'])->name('dang-ky');
//nếu thay đổi đăng nhập thành công thì xóa ->name('dang-ky') và thay đổi lại route ở đang nhập
Route::post('handleRegister', [CustomerController::class, 'handleRegister'])->name('handleRegister');

Route::get('dang-nhap', [CustomerController::class, 'login'])->name('login');
Route::post('handleLogin', [CustomerController::class, 'handleLogin'])->name('handleLogin');

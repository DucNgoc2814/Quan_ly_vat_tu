<?php

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
Route::get('/products', function () {
    return view('admin/components/product/create');
});

Route::get('dang-ky', [CustomerController::class, 'register'])->name('dang-ky');
//nếu thay đổi đăng nhập thành công thì xóa ->name('dang-ky') và thay đổi lại route ở đang nhập
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
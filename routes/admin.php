<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use Illuminate\Support\Facades\Route;



Route::prefix('quan-ly-don-hang')
    ->as('quan-ly-don-hang.')
    ->group(function () {
        Route::get('/danh-sach-ban', [OrderController::class, 'index'])->name('danh-sach-ban');
        Route::get('/chi-tiet-don-hang', [OrderDetailController::class, 'index'])->name('chi-tiet-don-hang');
    });

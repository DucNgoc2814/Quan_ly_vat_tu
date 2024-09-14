<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SupplierController;


Route::prefix('admin')
    ->as('admin.')
    ->group(function (): void {
        Route::prefix('compoents')
            ->as('compoents.')
            ->group(function (): void {
                Route::prefix('orders')
                    ->as('orders.')
                    ->group(function () {
                        Route::get('/', [OrderController::class, 'index'])->name('index');
                    });
            });
    });

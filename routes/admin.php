<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')
    ->as('admin.')
    ->group(function () {
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

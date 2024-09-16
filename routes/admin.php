<?php

use App\Http\Controllers\ContractTypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;


// Route::prefix('admin')
//     ->as('admin.')
//     ->group(function () {
//         Route::prefix('compoents')
//             ->as('compoents.')
//             ->group(function (): void {
//                 Route::prefix('orders')
//                     ->as('orders.')
//                     ->group(function () {
//                         Route::get('/', [OrderController::class, 'index'])->name('index');
//                     });

//                     Route::prefix('sliders')
//                     ->as('sliders.')
//                     ->group(function () {
//                         Route::get('/', [SliderController::class, 'index'])->name('index');
//                         Route::get('/create', [SliderController::class, 'create'])->name('create');
//                         Route::post('/store', [SliderController::class, 'store'])->name('store');
//                         Route::get('/show/{id}', [SliderController::class, 'show'])->name('show');
//                         Route::get('{id}/edit', [SliderController::class, 'edit'])->name('edit');
//                         Route::put('{id}/update', [SliderController::class, 'update'])->name('update');
//                         Route::delete('{id}/destroy', [SliderController::class, 'destroy'])->name('destroy');


//                     });
//             });
//     });

Route::prefix('sliders')
    ->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('index');
        Route::get('/create', [SliderController::class, 'create'])->name('create');
        Route::post('/store', [SliderController::class, 'store'])->name('store');
        Route::get('/show/{id}', [SliderController::class, 'show'])->name('show');
        Route::get('{id}/edit', [SliderController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [SliderController::class, 'update'])->name('update');
        Route::delete('{id}/destroy', [SliderController::class, 'destroy'])->name('destroy');
    });

Route::prefix('contract-types')
    ->group(function () {
        Route::get('/', [ContractTypeController::class, 'index'])->name('index');
        Route::get('/create', [ContractTypeController::class, 'create'])->name('create');
        Route::post('/store', [ContractTypeController::class, 'store'])->name('store');
        Route::get('/show/{id}', [ContractTypeController::class, 'show'])->name('show');
        Route::get('{id}/edit', [ContractTypeController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [ContractTypeController::class, 'update'])->name('update');
        Route::delete('{id}/destroy', [ContractTypeController::class, 'destroy'])->name('destroy');
    });
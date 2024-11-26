<?php

namespace App\Providers;

use App\Models\Variation;
use Illuminate\Support\Facades\View;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        view()->composer('*', function($view){
            $category = DB::table('categories')->get();
            $view->with(compact('category'));
        });

        View::composer('admin.layouts.partials.header', function ($view) {
            $lowStockProducts = Variation::with('product')
                ->where('stock', '<=', 30)
                ->get();
            $view->with('lowStockProducts', $lowStockProducts);
        });
    }
}

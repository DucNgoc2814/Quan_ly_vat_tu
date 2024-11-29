<?php

namespace App\Providers;

use App\Models\Payment_history;
use App\Models\Transaction;
use App\Models\Variation;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        view()->composer('*', function ($view) {
            $category = DB::table('categories')->get();
            $view->with(compact('category'));
        });

        View::composer('admin.layouts.partials.header', function ($view) {
            
            $lowStockProducts = Variation::with('product')
                ->where('stock', '<=', 30)
                ->get();

            $transactions = DB::table('payment_histories as t')
                ->leftJoin('contracts as c', function($join) {
                    $join->on('t.related_id', '=', 'c.id')
                         ->where('t.transaction_type', '=', 'contract');
                })
                ->leftJoin('orders as s', function($join) {
                    $join->on('t.related_id', '=', 's.id')
                         ->where('t.transaction_type', '=', 'sale');
                })
                ->leftJoin('import_orders as p', function($join) {
                    $join->on('t.related_id', '=', 'p.id')
                         ->where('t.transaction_type', '=', 'purchase');
                })
                ->select(
                    't.*',
                    'c.contract_number',
                    's.slug',
                    'p.slug'
                )
                ->where('t.status', 0)
                ->orderBy('t.created_at', 'desc')
                ->limit(10)
                ->get();
            $countHistory = Payment_history::where('status', 0)->count();
            $noti = count($lowStockProducts) + $countHistory;
            $view->with([
                'lowStockProducts' => $lowStockProducts,
                'transactions' => $transactions,
                'noti' => $noti
            ]);
        });
    }

    public function register(): void
    {
        //
    }
}

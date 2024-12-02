<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Contract;
use App\Models\ContractDetail;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Order_canceled;
use App\Models\Order_detail;
use App\Models\Order_status;
use App\Models\OrderStatusTime;
use App\Models\Payment;
use App\Models\Variation;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use PhpOffice\PhpWord\PhpWord;
/**
 * Handles the CRUD operations for orders in the application.
 *
 * This controller provides methods to list, create, show, edit, update, and delete orders.
 * It interacts with various models such as Order, Customer, Order_detail, Order_status, Payment, Product, and Variation.
 * The controller also handles the creation of new orders, including generating a unique order slug and storing the order details.
 */
class ThongkeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function thongKeDoanhThu()
    {
        $tongDoanhThuTheoNgay = DB::table('orders')->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total_amount'))->groupBy(DB::raw('DATE(created_at)'))->orderBy(DB::raw('DATE(created_at)'), 'asc')->get();
        $tongDoanhThuTheoThang = DB::table('orders')->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_amount) as total_amount'))->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))->orderBy(DB::raw('YEAR(created_at)'), 'asc')->orderBy(DB::raw('MONTH(created_at)'), 'asc')->get();
        $tongDoanhThuTheoNam = DB::table('orders')->select(DB::raw('YEAR(created_at) as year'), DB::raw('SUM(total_amount) as total_amount'))->groupBy(DB::raw('YEAR(created_at)'))->orderBy(DB::raw('YEAR(created_at)'), 'asc')->get();
        $tongDoanhThuTheoTuan = DB::table('orders')->select(DB::raw('YEAR(created_at) as year'), DB::raw('WEEK(created_at) as week'), DB::raw('SUM(total_amount) as total_amount'))->groupBy(DB::raw('YEAR(created_at)'), DB::raw('WEEK(created_at)'))->orderBy(DB::raw('YEAR(created_at)'), 'asc')->orderBy(DB::raw('WEEK(created_at)'), 'asc')->get();
        $tongDoanhThuThucTheoNgay = DB::table('orders')->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(paid_amount) as paid_amount'))->groupBy(DB::raw('DATE(created_at)'))->orderBy(DB::raw('DATE(created_at)'), 'asc')->get();
        $tongDoanhThuThucTheoThang = DB::table('orders')->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('SUM(paid_amount) as paid_amount'))->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))->orderBy(DB::raw('YEAR(created_at)'), 'asc')->orderBy(DB::raw('MONTH(created_at)'), 'asc')->get();
        $tongDoanhThuThucTheoNam = DB::table('orders')->select(DB::raw('YEAR(created_at) as year'), DB::raw('SUM(paid_amount) as paid_amount'))->groupBy(DB::raw('YEAR(created_at)'))->orderBy(DB::raw('YEAR(created_at)'), 'asc')->get();
        $tongDoanhThuThucTheoTuan = DB::table('orders')->select(DB::raw('YEAR(created_at) as year'), DB::raw('WEEK(created_at) as week'), DB::raw('SUM(paid_amount) as paid_amount'))->groupBy(DB::raw('YEAR(created_at)'), DB::raw('WEEK(created_at)'))->orderBy(DB::raw('YEAR(created_at)'), 'asc')->orderBy(DB::raw('WEEK(created_at)'), 'asc')->get();
        $tongDoanhThu = DB::table('orders')->sum('total_amount');
        $tongDoanhThuThuc = DB::table('orders')->sum('paid_amount');
        $listDoanhThu = DB::table('orders')->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total_amount'), DB::raw('SUM(paid_amount) as paid_amount'))->groupBy(DB::raw('DATE(created_at)'))->orderByDesc('date')->get();
        // <+====================POSEIDON====================+>
        $tongKhoanChiTheoNgay = DB::table('import_orders')->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total_amount'))->groupBy(DB::raw('DATE(created_at)'))->orderBy(DB::raw('DATE(created_at)'), 'asc')->get();
        $tongKhoanChiTheoThang = DB::table('import_orders')->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_amount) as total_amount'))->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))->orderBy(DB::raw('YEAR(created_at)'), 'asc')->orderBy(DB::raw('MONTH(created_at)'), 'asc')->get();
        $tongKhoanChiTheoNam = DB::table('import_orders')->select(DB::raw('YEAR(created_at) as year'), DB::raw('SUM(total_amount) as total_amount'))->groupBy(DB::raw('YEAR(created_at)'))->orderBy(DB::raw('YEAR(created_at)'), 'asc')->get();
        $tongKhoanChiTheoTuan = DB::table('import_orders')->select(DB::raw('YEAR(created_at) as year'), DB::raw('WEEK(created_at) as week'), DB::raw('SUM(total_amount) as total_amount'))->groupBy(DB::raw('YEAR(created_at)'), DB::raw('WEEK(created_at)'))->orderBy(DB::raw('YEAR(created_at)'), 'asc')->orderBy(DB::raw('WEEK(created_at)'), 'asc')->get();
        $tongKhoanChiThucTheoNgay = DB::table('import_orders')->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(paid_amount) as paid_amount'))->groupBy(DB::raw('DATE(created_at)'))->orderBy(DB::raw('DATE(created_at)'), 'asc')->get();
        $tongKhoanChiThucTheoThang = DB::table('import_orders')->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('SUM(paid_amount) as paid_amount'))->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))->orderBy(DB::raw('YEAR(created_at)'), 'asc')->orderBy(DB::raw('MONTH(created_at)'), 'asc')->get();
        $tongKhoanChiThucTheoNam = DB::table('import_orders')->select(DB::raw('YEAR(created_at) as year'), DB::raw('SUM(paid_amount) as paid_amount'))->groupBy(DB::raw('YEAR(created_at)'))->orderBy(DB::raw('YEAR(created_at)'), 'asc')->get();
        $tongKhoanChiThucTheoTuan = DB::table('import_orders')->select(DB::raw('YEAR(created_at) as year'), DB::raw('WEEK(created_at) as week'), DB::raw('SUM(paid_amount) as paid_amount'))->groupBy(DB::raw('YEAR(created_at)'), DB::raw('WEEK(created_at)'))->orderBy(DB::raw('YEAR(created_at)'), 'asc')->orderBy(DB::raw('WEEK(created_at)'), 'asc')->get();
        $tongKhoanChi = DB::table('import_orders')->sum('total_amount');
        $tongKhoanChiThuc = DB::table('import_orders')->sum('paid_amount');
        $listKhoanChi = DB::table('import_orders')->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total_amount'), DB::raw('SUM(paid_amount) as paid_amount'))->groupBy(DB::raw('DATE(created_at)'))->orderByDesc('date')->get();

        $listDoanhThu = DB::table('orders')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total_amount'), DB::raw('SUM(paid_amount) as paid_amount'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderByDesc('date')
            ->get()
            ->keyBy('date');

        $listKhoanChi = DB::table('import_orders')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total_amount'), DB::raw('SUM(paid_amount) as paid_amount'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderByDesc('date')
            ->get()
            ->keyBy('date');
        $allDates = $listDoanhThu->keys()->merge($listKhoanChi->keys())->map(function ($date) {
            return Carbon::parse($date);
        });

        $startDate = Carbon::now();
        $endDate = $allDates->min();

        $dates = [];
        for ($date = Carbon::parse($startDate); $date->gte($endDate); $date->subDay()) {
            $dates[] = $date->format('Y-m-d');
        }

        $mergedData = collect();

        foreach ($dates as $date) {
            $doanhThu = $listDoanhThu->get($date);
            $khoanChi = $listKhoanChi->get($date);

            $mergedData[$date] = [
                'date' => $date,
                'total_doanhthu' => $doanhThu ? (float)$doanhThu->total_amount : 0,
                'paid_doanhthu' => $doanhThu ? (float)$doanhThu->paid_amount : 0,
                'total_khoanchi' => $khoanChi ? (float)$khoanChi->total_amount : 0,
                'paid_khoanchi' => $khoanChi ? (float)$khoanChi->paid_amount : 0,
            ];
        }

        return view('admin.components.thongke.doanhthu', compact(
            'tongDoanhThuTheoNgay',
            'tongDoanhThuTheoThang',
            'tongDoanhThuTheoNam',
            'tongDoanhThuTheoTuan',
            'tongDoanhThuThucTheoNgay',
            'tongDoanhThuThucTheoThang',
            'tongDoanhThuThucTheoNam',
            'tongDoanhThuThucTheoTuan',
            'tongDoanhThu',
            'tongDoanhThuThuc',
            'listDoanhThu',
            'tongKhoanChiTheoNgay',
            'tongKhoanChiTheoThang',
            'tongKhoanChiTheoNam',
            'tongKhoanChiTheoTuan',
            'tongKhoanChiThucTheoNgay',
            'tongKhoanChiThucTheoThang',
            'tongKhoanChiThucTheoNam',
            'tongKhoanChiThucTheoTuan',
            'tongKhoanChi',
            'tongKhoanChiThuc',
            'listKhoanChi',
            'mergedData'
        ));
    }
}

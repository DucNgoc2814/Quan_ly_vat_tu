<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
    public function thongKeDonHang()
    {
        $totalOrders = DB::table('orders')->count();
        $processingOrders = DB::table('orders')
            ->whereIn('status_id', [1, 2, 3])
            ->count();
        $successfulOrders = DB::table('orders')->where('status_id', 4)->count();
        $failedOrders = DB::table('orders')->where('status_id', 5)->count();
        $totalImportOrders = DB::table('import_orders')->count();
        $processingImportOrders = DB::table('import_orders')
            ->whereIn('status', [1, 2])
            ->count();
        $successfulImportOrders = DB::table('import_orders')->where('status', 3)->count();
        $failedImportOrders = DB::table('import_orders')->where('status', 4)->count();
        $orderStatusTheoNgay = DB::table('orders')
        ->select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(CASE WHEN status_id IN (1, 2, 3) THEN 1 ELSE 0 END) as tienHanh'),
            DB::raw('SUM(CASE WHEN status_id = 4 THEN 1 ELSE 0 END) as thanhCong'),
            DB::raw('SUM(CASE WHEN status_id = 5 THEN 1 ELSE 0 END) as thatBai'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy(DB::raw('DATE(created_at)'), 'asc')
        ->get();
        $orderStatusTheoTuan = DB::table('orders')->select(DB::raw('YEARWEEK(created_at, 1) as date'), DB::raw('SUM(CASE WHEN status_id IN (1, 2, 3) THEN 1 ELSE 0 END) as tienHanh'), DB::raw('SUM(CASE WHEN status_id = 4 THEN 1 ELSE 0 END) as thanhCong'), DB::raw('SUM(CASE WHEN status_id = 5 THEN 1 ELSE 0 END) as thatBai'), DB::raw('COUNT(*) as total'))->groupBy(DB::raw('YEARWEEK(created_at, 1)'))->orderBy(DB::raw('YEARWEEK(created_at, 1)'), 'asc')->get()->map(function ($item) {
            $year = substr($item->date, 0, 4);
            $week = substr($item->date, 4, 2);
            $item->date = "Tuần $week,Năm $year";
            return $item;
        });
        $orderStatusTheoThang = DB::table('orders')
        ->select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as date'),
            DB::raw('SUM(CASE WHEN status_id IN (1, 2, 3) THEN 1 ELSE 0 END) as tienHanh'),
            DB::raw('SUM(CASE WHEN status_id = 4 THEN 1 ELSE 0 END) as thanhCong'),
            DB::raw('SUM(CASE WHEN status_id = 5 THEN 1 ELSE 0 END) as thatBai'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
        ->orderBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'), 'asc')
        ->get();
        $orderStatusTheoNam = DB::table('orders')->select(DB::raw('YEAR(created_at) as date'), DB::raw('SUM(CASE WHEN status_id IN (1, 2, 3) THEN 1 ELSE 0 END) as tienHanh'), DB::raw('SUM(CASE WHEN status_id = 4 THEN 1 ELSE 0 END) as thanhCong'), DB::raw('SUM(CASE WHEN status_id = 5 THEN 1 ELSE 0 END) as thatBai'), DB::raw('COUNT(*) as total'))->groupBy(DB::raw('YEAR(created_at)'))->orderBy(DB::raw('YEAR(created_at)'), 'asc')->get()->map(function ($item) {
            $item->date = (int) $item->date;
            return $item;
        });
        $importOrdersStatusTheoNgay = DB::table('import_orders')
        ->select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(CASE WHEN status IN (1, 2) THEN 1 ELSE 0 END) as tienHanh'),
            DB::raw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as thanhCong'),
            DB::raw('SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) as thatBai'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy(DB::raw('DATE(created_at)'), 'asc')
        ->get();
        $importOrdersStatusTheoTuan = DB::table('import_orders')
        ->select(
            DB::raw('YEARWEEK(created_at, 1) as date'),
            DB::raw('SUM(CASE WHEN status IN (1, 2) THEN 1 ELSE 0 END) as tienHanh'),
            DB::raw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as thanhCong'),
            DB::raw('SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) as thatBai'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy(DB::raw('YEARWEEK(created_at, 1)'))
        ->orderBy(DB::raw('YEARWEEK(created_at, 1)'), 'asc')
        ->get()
        ->map(function ($item) {
            $year = substr($item->date, 0, 4);
            $week = substr($item->date, 4, 2);
            $item->date = "Tuần $week, Năm $year";
            return $item;
        });
        $importOrdersStatusTheoThang = DB::table('import_orders')
        ->select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as date'),
            DB::raw('SUM(CASE WHEN status IN (1, 2) THEN 1 ELSE 0 END) as tienHanh'),
            DB::raw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as thanhCong'),
            DB::raw('SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) as thatBai'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
        ->orderBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'), 'asc')
        ->get();
        $importOrdersStatusTheoNam = DB::table('import_orders')
        ->select(
            DB::raw('YEAR(created_at) as date'),
            DB::raw('SUM(CASE WHEN status IN (1, 2) THEN 1 ELSE 0 END) as tienHanh'),
            DB::raw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as thanhCong'),
            DB::raw('SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) as thatBai'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy(DB::raw('YEAR(created_at)'))
        ->orderBy(DB::raw('YEAR(created_at)'), 'asc')
        ->get();

    $listOrders = DB::table('orders')
        ->select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(CASE WHEN status_id = 1 THEN 1 ELSE 0 END) as dangCho1'),
            DB::raw('SUM(CASE WHEN status_id = 2 THEN 1 ELSE 0 END) as dangCho2'),
            DB::raw('SUM(CASE WHEN status_id = 3 THEN 1 ELSE 0 END) as dangCho3'),
            DB::raw('SUM(CASE WHEN status_id = 4 THEN 1 ELSE 0 END) as thanhCong'),
            DB::raw('SUM(CASE WHEN status_id = 5 THEN 1 ELSE 0 END) as thatBai'),
            DB::raw('SUM(CASE WHEN status_id IN (1, 2, 3) THEN total_amount ELSE 0 END) as total_amount_dangCho'),
            DB::raw('SUM(CASE WHEN status_id = 4 THEN total_amount ELSE 0 END) as total_amount_thanhCong'),
            DB::raw('SUM(CASE WHEN status_id = 5 THEN total_amount ELSE 0 END) as total_amount_thatBai')
        )
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderByDesc('date')
        ->get()
        ->keyBy('date');

    $listImportOrders = DB::table('import_orders')
        ->select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as dangCho1'),
            DB::raw('SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as dangCho2'),
            DB::raw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as thanhCong'),
            DB::raw('SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) as thatBai'),
            DB::raw('SUM(CASE WHEN status IN (1, 2) THEN total_amount ELSE 0 END) as total_amount_dangCho'),
            DB::raw('SUM(CASE WHEN status = 3 THEN total_amount ELSE 0 END) as total_amount_thanhCong'),
            DB::raw('SUM(CASE WHEN status = 4 THEN total_amount ELSE 0 END) as total_amount_thatBai')
        )
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderByDesc('date')
        ->get()
        ->keyBy('date');

    $allDates = $listOrders->keys()->merge($listImportOrders->keys())->map(function ($date) {
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
        $orders = $listOrders->get($date);
        $importOrders = $listImportOrders->get($date);

        $mergedData[$date] = [
            'date' => $date,
            'orders_dangCho' => ($orders ? (int)$orders->dangCho1 : 0) + ($orders ? (int)$orders->dangCho2 : 0) + ($orders ? (int)$orders->dangCho3 : 0),
            'orders_thanhCong' => $orders ? (int)$orders->thanhCong : 0,
            'orders_thatBai' => $orders ? (int)$orders->thatBai : 0,
            'orders_total_amount_dangCho' => $orders ? (float)$orders->total_amount_dangCho : 0,
            'orders_total_amount_thanhCong' => $orders ? (float)$orders->total_amount_thanhCong : 0,
            'orders_total_amount_thatBai' => $orders ? (float)$orders->total_amount_thatBai : 0,
            'importOrders_dangCho' => ($importOrders ? (int)$importOrders->dangCho1 : 0) + ($importOrders ? (int)$importOrders->dangCho2 : 0),
            'importOrders_thanhCong' => $importOrders ? (int)$importOrders->thanhCong : 0,
            'importOrders_thatBai' => $importOrders ? (int)$importOrders->thatBai : 0,
            'importOrders_total_amount_dangCho' => $importOrders ? (float)$importOrders->total_amount_dangCho : 0,
            'importOrders_total_amount_thanhCong' => $importOrders ? (float)$importOrders->total_amount_thanhCong : 0,
            'importOrders_total_amount_thatBai' => $importOrders ? (float)$importOrders->total_amount_thatBai : 0,
        ];
    }


        return view('admin.components.thongke.donhang', compact('totalOrders', 'processingOrders', 'successfulOrders', 'failedOrders', 'totalImportOrders', 'processingImportOrders', 'successfulImportOrders', 'failedImportOrders', 'orderStatusTheoNgay', 'orderStatusTheoTuan', 'orderStatusTheoThang', 'orderStatusTheoNam', 'importOrdersStatusTheoNgay', 'importOrdersStatusTheoTuan', 'importOrdersStatusTheoThang', 'importOrdersStatusTheoNam', 'mergedData'));
    }
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

        $listDoanhThu = DB::table('orders')->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total_amount'), DB::raw('SUM(paid_amount) as paid_amount'))->groupBy(DB::raw('DATE(created_at)'))->orderByDesc('date')->get()->keyBy('date');
        $listKhoanChi = DB::table('import_orders')->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total_amount'), DB::raw('SUM(paid_amount) as paid_amount'))->groupBy(DB::raw('DATE(created_at)'))->orderByDesc('date')->get()->keyBy('date');
        $allDates = $listDoanhThu
            ->keys()
            ->merge($listKhoanChi->keys())
            ->map(function ($date) {
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
                'total_doanhthu' => $doanhThu ? (float) $doanhThu->total_amount : 0,
                'paid_doanhthu' => $doanhThu ? (float) $doanhThu->paid_amount : 0,
                'total_khoanchi' => $khoanChi ? (float) $khoanChi->total_amount : 0,
                'paid_khoanchi' => $khoanChi ? (float) $khoanChi->paid_amount : 0,
            ];
        }

        return view('admin.components.thongke.doanhthu', compact('tongDoanhThuTheoNgay', 'tongDoanhThuTheoThang', 'tongDoanhThuTheoNam', 'tongDoanhThuTheoTuan', 'tongDoanhThuThucTheoNgay', 'tongDoanhThuThucTheoThang', 'tongDoanhThuThucTheoNam', 'tongDoanhThuThucTheoTuan', 'tongDoanhThu', 'tongDoanhThuThuc', 'listDoanhThu', 'tongKhoanChiTheoNgay', 'tongKhoanChiTheoThang', 'tongKhoanChiTheoNam', 'tongKhoanChiTheoTuan', 'tongKhoanChiThucTheoNgay', 'tongKhoanChiThucTheoThang', 'tongKhoanChiThucTheoNam', 'tongKhoanChiThucTheoTuan', 'tongKhoanChi', 'tongKhoanChiThuc', 'listKhoanChi', 'mergedData'));
    }
}

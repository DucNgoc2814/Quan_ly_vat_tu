<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Variation;
use Illuminate\Support\Facades\Cache;

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
    public function thongKeSanPham()
    {
        // Top 5 sản phẩm bán chạy
        $topProductsData = [
            'day' => DB::table('order_details')
                ->join('variations', 'order_details.variation_id', '=', 'variations.id')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->where('orders.status_id', 4)
                ->whereDate('orders.created_at', Carbon::today())
                ->select(
                    'variations.sku',
                    'variations.name as variation_name',
                    DB::raw('SUM(order_details.quantity) as total_sold'),
                    DB::raw('SUM(order_details.quantity * order_details.price) as total_revenue')
                )
                ->groupBy('variations.sku', 'variations.name')
                ->orderByDesc('total_revenue') // Changed from total_sold to total_revenue
                ->limit(5)
                ->get(),

            'week' => DB::table('order_details')
                ->join('variations', 'order_details.variation_id', '=', 'variations.id')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->where('orders.status_id', 4)
                ->whereBetween('orders.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->select(
                    'variations.sku',
                    'variations.name as variation_name',
                    DB::raw('SUM(order_details.quantity) as total_sold'),
                    DB::raw('SUM(order_details.quantity * order_details.price) as total_revenue')
                )
                ->groupBy('variations.sku', 'variations.name')
                ->orderByDesc('total_revenue')
                ->limit(5)
                ->get(),

            'month' => DB::table('order_details')
                ->join('variations', 'order_details.variation_id', '=', 'variations.id')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->where('orders.status_id', 4)
                ->whereMonth('orders.created_at', Carbon::now()->month)
                ->whereYear('orders.created_at', Carbon::now()->year)
                ->select(
                    'variations.sku',
                    'variations.name as variation_name',
                    DB::raw('SUM(order_details.quantity) as total_sold'),
                    DB::raw('SUM(order_details.quantity * order_details.price) as total_revenue')
                )
                ->groupBy('variations.sku', 'variations.name')
                ->orderByDesc('total_revenue')
                ->limit(5)
                ->get()
                ->toArray(),  // Convert to array for JavaScript use
            'year' => DB::table('order_details')
                ->join('variations', 'order_details.variation_id', '=', 'variations.id')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->where('orders.status_id', 4)
                ->whereYear('orders.created_at', Carbon::now()->year)
                ->select(
                    'variations.sku',
                    'variations.name as variation_name',
                    DB::raw('SUM(order_details.quantity) as total_sold'),
                    DB::raw('SUM(order_details.quantity * order_details.price) as total_revenue')
                )->groupBy('variations.sku', 'variations.name')
                ->orderByDesc('total_revenue')
                ->limit(5)
                ->get()
                ->toArray()
        ];

        // Chi tiết tất cả sản phẩm
        $productStats = DB::table('order_details')
            ->join('variations', 'order_details.variation_id', '=', 'variations.id')
            ->join('products', 'variations.product_id', '=', 'products.id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->leftJoin('units', 'products.unit_id', '=', 'units.id')
            ->leftJoin('import_order_details', 'variations.id', '=', 'import_order_details.variation_id')
            ->leftJoin('import_orders', function ($join) {
                $join->on('import_order_details.import_order_id', '=', 'import_orders.id')
                    ->where('import_orders.status', '=', 3); // Chỉ lấy đơn nhập thành công
            })
            ->where('orders.status_id', 4)
            ->select(
                'variations.sku',
                'variations.name as variation_name',
                'units.name as unit_name',
                DB::raw('SUM(order_details.quantity) as total_sold'),
                DB::raw('COUNT(DISTINCT orders.id) as total_orders'),
                DB::raw('SUM(order_details.quantity * order_details.price) as total_revenue'),
                DB::raw('MAX(import_orders.created_at) as last_import_date')
            )
            ->groupBy('variations.sku', 'variations.name', 'units.name')
            ->orderBy('total_sold', 'desc')
            ->get();

        // Thống kê tồn kho
        $inventory = DB::table('variations')
            ->join('products', 'variations.product_id', '=', 'products.id')
            ->leftJoin('units', 'products.unit_id', '=', 'units.id')
            ->leftJoin('import_order_details', 'variations.id', '=', 'import_order_details.variation_id')
            ->leftJoin('import_orders', function ($join) {
                $join->on('import_order_details.import_order_id', '=', 'import_orders.id')
                    ->where('import_orders.status', '=', 3); // Chỉ lấy đơn nhập thành công
            })
            ->select(
                'variations.sku',
                'variations.name as variation_name',
                'variations.stock as current_stock',
                DB::raw('MAX(import_orders.created_at) as last_import_date')
            )
            ->groupBy('variations.sku', 'variations.name', 'variations.stock')
            ->orderBy('variations.stock', 'desc')
            ->limit(5)
            ->get();

        // Add new time-based statistics
        $timeBasedStats = [
            'daily' => DB::table('order_details')
                ->join('variations', 'order_details.variation_id', '=', 'variations.id')
                ->join('products', 'variations.product_id', '=', 'products.id')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->where('orders.status_id', 4)
                ->select(
                    'products.id as product_id',
                    'products.name as product_name',
                    DB::raw('DATE(orders.created_at) as date'),
                    DB::raw('SUM(order_details.quantity) as total_quantity'),
                    DB::raw('SUM(order_details.quantity * order_details.price) as total_revenue')
                )
                ->groupBy('products.id', 'products.name', 'date')
                ->orderBy('date')
                ->get(),

            'weekly' => DB::table('order_details')
                ->join('variations', 'order_details.variation_id', '=', 'variations.id')
                ->join('products', 'variations.product_id', '=', 'products.id')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->where('orders.status_id', 4)
                ->select(
                    'products.id as product_id',
                    'products.name as product_name',
                    DB::raw('YEAR(orders.created_at) as year'),
                    DB::raw('WEEK(orders.created_at) as week'),
                    DB::raw('SUM(order_details.quantity) as total_quantity'),
                    DB::raw('SUM(order_details.quantity * order_details.price) as total_revenue')
                )
                ->groupBy('products.id', 'products.name', 'year', 'week')
                ->orderBy('year')
                ->orderBy('week')
                ->get(),

            'monthly' => DB::table('order_details')
                ->join('variations', 'order_details.variation_id', '=', 'variations.id')
                ->join('products', 'variations.product_id', '=', 'products.id')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->where('orders.status_id', 4)
                ->select(
                    'products.id as product_id',
                    'products.name as product_name',
                    DB::raw('YEAR(orders.created_at) as year'),
                    DB::raw('MONTH(orders.created_at) as month'),
                    DB::raw('SUM(order_details.quantity) as total_quantity'),
                    DB::raw('SUM(order_details.quantity * order_details.price) as total_revenue')
                )
                ->groupBy('products.id', 'products.name', 'year', 'month')
                ->orderBy('year')
                ->orderBy('month')
                ->get(),

            'yearly' => DB::table('order_details')
                ->join('variations', 'order_details.variation_id', '=', 'variations.id')
                ->join('products', 'variations.product_id', '=', 'products.id')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->where('orders.status_id', 4)
                ->select(
                    'products.id as product_id',
                    'products.name as product_name',
                    DB::raw('YEAR(orders.created_at) as year'),
                    DB::raw('SUM(order_details.quantity) as total_quantity'),
                    DB::raw('SUM(order_details.quantity * order_details.price) as total_revenue')
                )
                ->groupBy('products.id', 'products.name', 'year')
                ->orderBy('year')
                ->get()
        ];

        // Get list of all products for dropdown
        $products = DB::table('Variations')
            ->select('id', 'name')
            ->get();

        return view('admin.components.thongke.sanpham', compact(
            'productStats',
            'topProductsData',
            'inventory',
            'timeBasedStats', // Add new stats
            'products' // Add products for dropdown
        ));
    }
    public function thongKeDoiTac()
    {
        // Card thống kê tổng quan
        $overviewStats = [
            'suppliers' => [
                'total' => DB::table('suppliers')->count(),
                'active' => DB::table('suppliers')
                    ->join('import_orders', 'suppliers.id', '=', 'import_orders.supplier_id')
                    ->where('import_orders.created_at', '>=', now()->subMonths(3))
                    ->distinct()
                    ->count('suppliers.id'),
                'total_debt' => DB::table('import_orders')
                    ->where('status', 3)
                    ->sum(DB::raw('total_amount - paid_amount')),
                'overdue_debt' => DB::table('import_orders')
                    ->where('status', 3)
                    ->where('created_at', '<=', now()->subDays(30))
                    ->sum(DB::raw('total_amount - paid_amount')),
            ],
            'customers' => [
                'total' => DB::table('customers')->count(),
                'active' => DB::table('customers')
                    ->join('orders', 'customers.id', '=', 'orders.customer_id')
                    ->where('orders.created_at', '>=', now()->subMonths(3))
                    ->distinct()
                    ->count('customers.id'),
                'total_debt' => DB::table('orders')
                    ->where('status_id', 4)
                    ->sum(DB::raw('total_amount - paid_amount')),
                'overdue_debt' => DB::table('orders')
                    ->where('status_id', 4)
                    ->where('created_at', '<=', now()->subDays(30))
                    ->sum(DB::raw('total_amount - paid_amount')),
            ]
        ];

        // Top đối tác trong tháng
        $topPartners = [
            'supplier' => DB::table('import_orders')
                ->join('suppliers', 'import_orders.supplier_id', '=', 'suppliers.id')
                ->select(
                    'suppliers.name',
                    DB::raw('SUM(import_orders.total_amount) as total_value')
                )
                ->where('import_orders.created_at', '>=', now()->startOfMonth())
                ->groupBy('suppliers.id', 'suppliers.name')
                ->orderByDesc('total_value')
                ->first(),
            'customer' => DB::table('orders')
                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                ->select(
                    'customers.name',
                    DB::raw('SUM(orders.total_amount) as total_value')
                )
                ->where('orders.created_at', '>=', now()->startOfMonth())
                ->groupBy('customers.id', 'customers.name')
                ->orderByDesc('total_value')
                ->first()
        ];

        // Thống kê tài chính
        $financeStats = [
            'suppliers' => DB::table('import_orders')
                ->join('suppliers', 'import_orders.supplier_id', '=', 'suppliers.id')
                ->select(
                    'suppliers.name',
                    DB::raw('SUM(import_orders.total_amount) as total_payable'),
                    DB::raw('SUM(import_orders.paid_amount) as total_paid'),
                    DB::raw('SUM(import_orders.total_amount - import_orders.paid_amount) as remaining_debt'),
                    DB::raw('AVG(import_orders.total_amount) as average_order_value')
                )
                ->where('status', 3)
                ->groupBy('suppliers.id', 'suppliers.name')
                ->get(),
            'customers' => DB::table('orders')
                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                ->select(
                    'customers.name',
                    DB::raw('SUM(orders.total_amount) as total_payable'),
                    DB::raw('SUM(orders.paid_amount) as total_paid'),
                    DB::raw('SUM(orders.total_amount - orders.paid_amount) as remaining_debt'),
                    DB::raw('AVG(orders.total_amount) as average_order_value')
                )
                ->where('status_id', 4)
                ->groupBy('customers.id', 'customers.name')
                ->get()
        ];

        // Thống kê sản phẩm theo đối tác
        $productStats = [
            'suppliers' => DB::table('import_order_details')
                ->join('import_orders', 'import_order_details.import_order_id', '=', 'import_orders.id')
                ->join('suppliers', 'import_orders.supplier_id', '=', 'suppliers.id')
                ->join('variations', 'import_order_details.variation_id', '=', 'variations.id')
                ->select(
                    'suppliers.name as partner_name',
                    'variations.name as product_name',
                    DB::raw('COUNT(DISTINCT import_orders.id) as order_count'),
                    DB::raw('SUM(import_order_details.quantity) as total_quantity'),
                    DB::raw('SUM(import_order_details.quantity * import_order_details.price) as total_value')
                )
                ->where('import_orders.status', 3)
                ->groupBy('suppliers.id', 'variations.id')
                ->get(),
            'customers' => DB::table('order_details')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                ->join('variations', 'order_details.variation_id', '=', 'variations.id')
                ->select(
                    'customers.name as partner_name',
                    'variations.name as product_name',
                    DB::raw('COUNT(DISTINCT orders.id) as order_count'),
                    DB::raw('SUM(order_details.quantity) as total_quantity'),
                    DB::raw('SUM(order_details.quantity * order_details.price) as total_value')
                )
                ->where('orders.status_id', 4)
                ->groupBy('customers.id', 'variations.id')
                ->get()
        ];

        // Thống kê theo ngày
        $dailyStats = DB::table('import_orders')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(total_amount) as total_value'),
                DB::raw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as successful_orders'),
                DB::raw('SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) as cancelled_orders')
            )
            ->whereRaw('created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)')
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc')
            ->get();

        // Thống kê theo tuần
        $weeklyStats = DB::table('import_orders')
            ->select(
                DB::raw('YEARWEEK(created_at, 1) as yearweek'),
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(total_amount) as total_value'),
                DB::raw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as successful_orders'),
                DB::raw('SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) as cancelled_orders')
            )
            ->whereRaw('created_at >= DATE_SUB(NOW(), INTERVAL 12 WEEK)')
            ->groupBy('yearweek')
            ->orderBy('yearweek', 'asc')
            ->get()
            ->map(function ($item) {
                $year = substr($item->yearweek, 0, 4);
                $week = substr($item->yearweek, 4);
                $item->date_label = "Tuần $week, $year";
                return $item;
            });

        // Thống kê theo tháng
        $monthlyStats = DB::table('import_orders')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as yearmonth'),
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(total_amount) as total_value'),
                DB::raw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as successful_orders'),
                DB::raw('SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) as cancelled_orders')
            )
            ->whereRaw('created_at >= DATE_SUB(NOW(), INTERVAL 12 MONTH)')
            ->groupBy('yearmonth')
            ->orderBy('yearmonth', 'asc')
            ->get();

        // Thống kê theo năm
        $yearlyStats = DB::table('import_orders')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(total_amount) as total_value'),
                DB::raw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as successful_orders'),
                DB::raw('SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) as cancelled_orders')
            )
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->orderBy('year', 'asc')
            ->get();

        // Thống kê nhà cung cấp
        $supplierStats = DB::table('import_orders')
            ->join('suppliers', 'import_orders.supplier_id', '=', 'suppliers.id')
            ->select(
                'suppliers.id as partner_id',
                'suppliers.name as partner_name',
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(import_orders.total_amount) as total_value'),
                DB::raw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as successful_orders'),
                DB::raw('SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) as cancelled_orders'),
                DB::raw('ROUND(SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) * 100.0 / COUNT(*), 2) as success_rate')
            )
            ->groupBy('suppliers.id', 'suppliers.name')
            ->orderBy('total_orders', 'desc')
            ->get();

        // Thống kê khách hàng
        $customerStats = DB::table('orders')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->select(
                'customers.id as partner_id',
                'customers.name as partner_name',
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(orders.total_amount) as total_value'),
                DB::raw('SUM(CASE WHEN orders.status_id = 4 THEN 1 ELSE 0 END) as successful_orders'),
                DB::raw('SUM(CASE WHEN orders.status_id = 5 THEN 1 ELSE 0 END) as cancelled_orders'),
                DB::raw('ROUND(SUM(CASE WHEN orders.status_id = 4 THEN 1 ELSE 0 END) * 100.0 / COUNT(*), 2) as success_rate')
            )
            ->groupBy('customers.id', 'customers.name')
            ->orderBy('total_orders', 'desc')
            ->get();

        $suppliers = DB::table('suppliers')
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        $customers = DB::table('customers')
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        // Thêm thống kê theo tháng cho nhà cung cấp
        $supplierMonthlyStats = DB::table('import_orders')
            ->join('suppliers', 'import_orders.supplier_id', '=', 'suppliers.id')
            ->select(
                DB::raw('YEAR(import_orders.created_at) as year'),
                DB::raw('MONTH(import_orders.created_at) as month'),
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(import_orders.total_amount) as total_value'),
                DB::raw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as successful_orders'),
                DB::raw('SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) as cancelled_orders')
            )
            ->whereRaw('import_orders.created_at >= DATE_SUB(NOW(), INTERVAL 12 MONTH)')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Thêm thống kê theo tháng cho khách hàng
        $customerMonthlyStats = DB::table('orders')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->select(
                DB::raw('YEAR(orders.created_at) as year'),
                DB::raw('MONTH(orders.created_at) as month'),
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(orders.total_amount) as total_value'),
                DB::raw('SUM(CASE WHEN orders.status_id = 4 THEN 1 ELSE 0 END) as successful_orders'),
                DB::raw('SUM(CASE WHEN orders.status_id = 5 THEN 1 ELSE 0 END) as cancelled_orders')
            )
            ->whereRaw('orders.created_at >= DATE_SUB(NOW(), INTERVAL 12 MONTH)')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        return view('admin.components.thongke.doitac', compact(
            'supplierStats',
            'customerStats',
            'suppliers',
            'customers',
            'supplierMonthlyStats',
            'customerMonthlyStats',
            'dailyStats',
            'weeklyStats',
            'monthlyStats',
            'yearlyStats',
            'overviewStats',
            'topPartners',
            'financeStats',
            'productStats'
        ));
    }

    public function filterPartnerStats(Request $request)
    {
        if ($request->partner_type === 'supplier') {
            $query = DB::table('import_orders')
                ->join('suppliers', 'import_orders.supplier_id', '=', 'suppliers.id')
                ->select(
                    'suppliers.id as partner_id',
                    'suppliers.name as partner_name',
                    DB::raw('COUNT(*) as total_orders'),
                    DB::raw('SUM(import_orders.total_amount) as total_value'),
                    DB::raw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as successful_orders'),
                    DB::raw('SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) as cancelled_orders'),
                    DB::raw('ROUND(SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) * 100.0 / COUNT(*), 2) as success_rate')
                )
                ->groupBy('suppliers.id', 'suppliers.name');

            if ($request->partner_id) {
                $query->where('suppliers.id', $request->partner_id);
            }

            if ($request->start_date) {
                $query->where('import_orders.created_at', '>=', $request->start_date);
            }

            if ($request->end_date) {
                $query->where('import_orders.created_at', '<=', $request->end_date . ' 23:59:59');
            }
        } else {
            $query = DB::table('orders')
                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                ->select(
                    'customers.id as partner_id',
                    'customers.name as partner_name',
                    DB::raw('COUNT(*) as total_orders'),
                    DB::raw('SUM(orders.total_amount) as total_value'),
                    DB::raw('SUM(CASE WHEN orders.status_id = 4 THEN 1 ELSE 0 END) as successful_orders'),
                    DB::raw('SUM(CASE WHEN orders.status_id = 5 THEN 1 ELSE 0 END) as cancelled_orders'),
                    DB::raw('ROUND(SUM(CASE WHEN orders.status_id = 4 THEN 1 ELSE 0 END) * 100.0 / COUNT(*), 2) as success_rate')
                )
                ->groupBy('customers.id', 'customers.name');

            if ($request->partner_id) {
                $query->where('customers.id', $request->partner_id);
            }

            if ($request->start_date) {
                $query->where('orders.created_at', '>=', $request->start_date);
            }

            if ($request->end_date) {
                $query->where('orders.created_at', '<=', $request->end_date . ' 23:59:59');
            }
        }

        $filteredStats = $query->orderBy('total_orders', 'desc')->get();

        return response()->json($filteredStats);
    }
}

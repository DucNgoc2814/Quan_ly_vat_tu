<?php

namespace App\Http\Controllers;

use App\Events\ImportOrderCancelRequested;
use App\Events\ImportOrderConfirmed;
use App\Events\NewImportOrderCreated;
use App\Models\Import_order_detail;
use App\Models\Payment;
use App\Models\Supplier;
use App\Models\Variation;
use App\Models\Import_order;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreImport_orderRequest;
use App\Http\Requests\UpdateImport_orderRequest;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\NewOrderRequest;
use App\Models\Order;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;

class ImportOrderController extends Controller
{
    const PATH_VIEW = 'admin.components.import_orders.';
    public function index()
    {
        $token = Session::get('token');
        $payload = JWTAuth::setToken($token)->getPayload();
        $role = $payload->get('role');
        $userId = $payload->get('id');

        $query = Import_order::with(['payment', 'supplier']);

        // Filter for non-admin users
        if ($role != '1') {
            $query->where('employee_id', $userId);
        }

        $data = $query->latest('id')->get();

        // Keep existing low stock products query
        $lowStockProducts = Variation::with('product')
            ->where('stock', '<=', 30)
            ->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'lowStockProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $payments = Payment::query()->get();
        $suppliers = Supplier::query()->get();
        $variants = Variation::where('is_active', 1)->get();

        return view("admin.components.import_orders.create", compact("payments", "suppliers", "variants"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImport_orderRequest $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        try {
            DB::transaction(function () use ($request) {
                $randomChars = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3);
                $timestamp = now()->format('His');
                $slug = 'DHN' . $randomChars . $timestamp;

                // Đảm bảo total_amount là số nguyên
                $totalAmount = (int) str_replace([',', '.'], '', $request->total_amount);

                // Tạo đơn hàng nhập
                $importOrder = Import_order::create([
                    "supplier_id" => $request->supplier_id,
                    'employee_id' => JWTAuth::setToken(Session::get('token'))->getPayload()->get('id'),
                    "slug" => $slug,
                    "product_quantity" => array_sum($request->product_quantity),
                    "total_amount" => $totalAmount,
                    "paid_amount" => 0,
                    "status" => 1,
                ]);

                if (is_array($request->variation_id) && count($request->variation_id) > 0) {
                    foreach ($request->variation_id as $key => $variationID) {
                        $quantity = (int) $request->product_quantity[$key];
                        $price = (int) str_replace([',', '.'], '', $request->product_price[$key]);

                        Import_order_detail::create([
                            'import_order_id' => $importOrder->id,
                            'variation_id' => $variationID,
                            'quantity' => $quantity,
                            'price' => $price,
                        ]);

                        NewOrderRequest::create([
                            'import_order_id' => $importOrder->id,
                            'variation_id' => $variationID,
                            'quantity' => $quantity,
                        ]);
                    }
                }

                event(new NewImportOrderCreated($importOrder));
            });

            return redirect()->route('importOrder.index')
                ->with('success', 'Đơn hàng của bạn đã được gửi đến quản lý, chờ quản lý xác nhận');
        } catch (\Throwable $th) {
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi tạo đơn hàng nhập: ' . $th->getMessage());
        }
    }

    public function requestCancel(Request $request, $slug)
    {
        try {
            $importOrder = Import_order::where('slug', $slug)->firstOrFail();
            if ($importOrder->status != 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không thể  hủy đơn hàng này.'
                ], 403);
            }
            DB::transaction(function () use ($importOrder, $request) {
                $importOrder->cancel_reason = $request->reason;
                $importOrder->save();
                NewOrderRequest::where('import_order_id', $importOrder->id)->delete();
                event(new ImportOrderCancelRequested($importOrder));
            });
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getPendingCancelRequests()
    {
        $pendingRequests = Import_order::where('status', 1)
            ->whereNotNull('cancel_reason')
            ->get();

        return response()->json($pendingRequests);
    }

    public function cancelImportOrder($slug)
    {
        try {
            $importOrder = Import_order::where('slug', $slug)->firstOrFail();
            if ($importOrder->status != 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Chỉ có thể hủy đơn hàng ở trạng thái chờ xử lý'
                ], 403);
            }
            $importOrder->status = 4;
            $importOrder->save();

            return response()->json([
                'success' => true,
                'message' => 'Đã xác nhận hủy đơn hàng'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function confirmOrder($slug)
    {
        $importOrder = Import_order::where('slug', $slug)->firstOrFail();
        $importOrder->status = 2;
        $importOrder->save();

        event(new ImportOrderConfirmed($importOrder));

        return response()->json([
            'success' => true,
            'message' => 'Đã xác nhận đơn hàng, chờ đơn hàng giao',
        ]);
    }

    public function rejectOrder($slug)
    {
        $importOrder = Import_order::where('slug', $slug)->firstOrFail();
        $importOrder->status = 2;
        $importOrder->cancel_reason = null;
        $importOrder->save();

        return response()->json([
            'success' => true,
            'message' => 'Đã từ chối hủy đơn hàng',
        ]);
    }

    public function dashboard()
    {
        try {
            $token = Session('token');
            $dataToken = JWTAuth::setToken($token)->getPayload();
            $role_id = $dataToken['role'];
            $pendingNewOrders = NewOrderRequest::with(['importOrder', 'variation'])
                ->whereHas('importOrder', function ($query) {
                    $query->where('status', 1);
                })
                ->get();
            $pendingCancelRequests = Import_order::where('status', 1)
                ->whereNotNull('cancel_reason')
                ->distinct()
                ->get()
                ->unique('slug');
            $totalRevenueThisMonth = Order::whereMonth('updated_at', Carbon::now()->month)->whereYear('updated_at', Carbon::now()->year)->sum('total_amount');
            $actualRevenueThisMonth = Order::whereMonth('updated_at', Carbon::now()->month)
                ->whereYear('updated_at', Carbon::now()->year)
                ->where('status_id', 4)
                ->sum('total_amount');
            $totalRevenueLastMonth = Order::whereMonth('updated_at', Carbon::now()->subMonth()->month)->whereYear('updated_at', Carbon::now()->subMonth()->year)->sum('total_amount');
            $revenueDifference = $totalRevenueThisMonth - $totalRevenueLastMonth;
            if ($totalRevenueLastMonth != 0) {
                $growthRateRevenue = ($revenueDifference / $totalRevenueLastMonth) * 100;
            } else {
                $growthRateRevenue = 100;
            }
            // Khách hàng
            $totalCustomersThisMonth = Customer::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->count();
            $totalCustomersLastMonth = Customer::whereMonth('created_at', Carbon::now()->subMonth()->month)->whereYear('created_at', Carbon::now()->subMonth()->year)->count();
            $customerDifference = $totalCustomersThisMonth - $totalCustomersLastMonth;
            if ($totalCustomersLastMonth != 0) {
                $growthRateCustomers = ($customerDifference / $totalCustomersLastMonth) * 100;
            } else {
                $growthRateCustomers = 100;
            }
            // Đơn hàng nhập
            $totalRevenueImportThisMonth = Import_order::whereMonth('updated_at', Carbon::now()->month)->whereYear('updated_at', Carbon::now()->year)->sum('total_amount');
            $totalRevenueImportLastMonth = Import_order::whereMonth('updated_at', Carbon::now()->subMonth()->month)->whereYear('updated_at', Carbon::now()->subMonth()->year)->sum('total_amount');
            $revenueImportDifference = $totalRevenueImportThisMonth - $totalRevenueImportLastMonth;
            if ($totalRevenueImportLastMonth != 0) {
                $growthRateImportRevenue = ($revenueImportDifference / $totalRevenueImportLastMonth) * 100;
            } else {
                $growthRateImportRevenue = 100;
            }
            // Thống kê
            $startDate = Carbon::now()->subMonths(11)->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();

            for ($date = $startDate; $date <= $endDate; $date->addMonth()) {
                $ordersCountn = Import_order::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count();
                $ordersPerMonthN[] = $ordersCountn;
                $ordersCountx = Order::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count();
                $ordersPerMonthX[] = $ordersCountx;
                $totalAmout = Order::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->sum('total_amount');
                $totalAmoutx[] = $totalAmout / 1000000;
            }

            $statusValues = [
                Order::where('status_id', '!=', 4)
                    ->where('status_id', '!=', 5)
                    ->count(),
                Order::where('status_id', 4)->count(),
                Order::where('status_id', 5)->count(),
            ];
            $latestOrders = DB::table('orders')
                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                ->orderBy('orders.created_at', 'desc')
                ->take(10)
                ->get();
            $productsWithTotalQuantity = DB::table('variations')
                ->select('variations.name as variation_name', 'variations.sku as  variation_sku', 'variations.stock as  variation_stock', 'products.name as product_name', 'products.image', DB::raw('SUM(order_details.quantity) as total_quantity'))
                ->join('order_details', 'variations.id', '=', 'order_details.variation_id')
                ->join('products', 'products.id', '=', 'variations.product_id')
                ->groupBy('variations.name', 'products.name', 'products.image', 'variations.sku', 'variations.stock')
                ->orderByRaw('SUM(order_details.quantity) DESC')
                ->limit(10)
                ->get();
            return view('admin.dashboard', compact(
                'pendingNewOrders',
                'pendingCancelRequests',
                'totalRevenueThisMonth',
                'growthRateRevenue',
                'totalCustomersThisMonth',
                'growthRateCustomers',
                'totalRevenueImportThisMonth',
                'growthRateImportRevenue',
                'ordersPerMonthN',
                'ordersPerMonthX',
                'totalAmoutx',
                'statusValues',
                'latestOrders',
                'productsWithTotalQuantity',
                'actualRevenueThisMonth'
            ));
        } catch (\Exception $e) {
            return redirect()->route('employees.login')->with('error', 'Phiên đăng nhập đã hết hạn, vui lòng đăng nhập lại');
        }
    }




    public function checkOrderStatus($slug)
    {
        $importOrder = Import_order::where('slug', $slug)->first();
        if ($importOrder && $importOrder->status == 2) {
            return response()->json(['status' => 'confirmed']);
        }
        return response()->json(['status' => 'pending']);
    }




    public function updateOrderStatus($slug)
    {
        $importOrder = Import_order::where('slug', $slug)->first();
        if ($importOrder) {
            $importOrder->status = 3;
            $importOrder->save();

            $importOrderDetails = Import_order_detail::where('import_order_id', $importOrder->id)->get();
            foreach ($importOrderDetails as $detail) {
                $variation = Variation::find($detail->variation_id);
                if ($variation) {
                    $variation->stock += $detail->quantity;
                    $latestImportPrice = $detail->price;
                    if ($variation->avgImportPrice === 0) {
                        $variation->avgImportPrice = $latestImportPrice;
                    } else {
                        $totalQuantity = $variation->stock;
                        $totalCost = ($variation->avgImportPrice * ($totalQuantity - $detail->quantity)) + ($latestImportPrice * $detail->quantity);
                        $variation->avgImportPrice = $totalCost / $totalQuantity;
                    }
                    $variation->latestImportPrice = $latestImportPrice;
                    $variation->save();
                }
            }
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $import_order = Import_order::where('slug', $slug)->firstOrFail();

        // Kiểm tra nếu đơn nhập đã được xác nhận thì không cho sửa
        if ($import_order->status != 1) {
            return redirect()->route('importOrder.index')->with('error', 'Không thể sửa đơn nhập hàng');
        }

        $payments = Payment::pluck('name', 'id')->all();
        $suppliers = Supplier::pluck('name', 'id')->all();
        $importOrderDetails = Import_order_detail::where('import_order_id', $import_order->id)->get();
        $variants = Variation::where('is_active', 1)->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('import_order', 'payments', 'suppliers', 'variations', 'importOrderDetails'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImport_orderRequest $request, $slug)
    {
        $importOrder = Import_order::where('slug', $slug)->firstOrFail();

        // Kiểm tra nếu đơn nhập đã được xác nhận thì không cho cập nhật
        if ($importOrder->status != 1) {
            return redirect()->route('importOrder.index')->with('error', 'Không thể cập nhật đơn nhập hàng');
        }

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        try {
            DB::transaction(function () use ($request, $slug) {

                // lấy đơn hàng theo slug
                $importOrder = Import_order::where('slug', $slug)->firstOrFail();

                // Kiểm tra tính họp lệ của trạng thái mới

                $randomChars = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, length: 3);
                $timestamp = now()->format('His');
                $slug = 'DH' . $randomChars . $timestamp;

                $importOrderData = [
                    "supplier_id" => $request->supplier_id,
                    "product_quantity" => $request->product_quantity,
                    "total_amount" => $request->total_amount,
                ];

                $importOrder->update($importOrderData);
                // Trả lại số lượng hàng tồn kho trước khi cập nhật
                foreach ($importOrder->importOrderDetails as $detail) {
                    $variation = Variation::findOrFail($detail->variation_id);
                    $variation->stock += $detail->quantity; // Trả lại số lượng đã bán trước đó
                    $variation->save();
                }

                // xóa chi tiết đơn hàng cũ
                $importOrder->importOrderDetails()->delete();

                if (is_array($request->variation_id) && count($request->variation_id) > 0) {

                    foreach ($request->variation_id as $key => $variationID) {

                        // kiểm tra tính tồn tại của các mảng liên quan
                        $quantity = $request->product_quantity[$key] ?? null;
                        $price = $request->product_price[$key] ?? null;

                        if ($variationID && $quantity && $price) {

                            $variation = Variation::findOrFail($variationID);

                            Import_order_detail::query()->create([
                                'import_order_id' => $importOrder->id,
                                'variation_id' => $variationID,
                                'quantity' => $quantity,
                                'price' => $price,
                            ]);

                            // Giảm số lượng hàng tồn kho
                            $variation->stock -= $quantity;
                            $variation->save();
                        }
                    }
                } else {
                    throw new Exception('Không có sản phẩm nào để thêm vào đơn hàng nhập');
                }
            });
            return redirect()->route('importOrder.index')->with('success', 'Cập nhật đơn hàng thành công!');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật đơn hàng nhập: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Import_order $import_order)
    {
        //
    }

    public function getProductsBySupplier($supplierId)
    {
        try {
            $variations = Supplier::findOrFail($supplierId)
                ->variations()
                ->select('variations.id', 'variations.name', 'variations.sku')
                ->where('is_active', 1)
                ->get();
            return response()->json($variations);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getVariationsBySupplier($supplierId)
    {
        try {

            $variations = Supplier::find($supplierId)->variations()
                ->select('variations.id', 'variations.name', 'variations.sku')
                ->where('is_active', 1)
                ->get();
            return response()->json($variations);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

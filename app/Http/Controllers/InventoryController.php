<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Models\Variation;
use App\Imports\VariationsImport;
use App\Models\Import_order_detail;
use App\Models\InventoryDetail;
use App\Models\Order_detail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Log;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.8
     */
    const PATH_VIEW = 'admin.components.inventories.';
    public function index()
    {
        $variations = Variation::with('importOrderDetails') // Lấy thông tin đơn hàng nhập
            ->orderBy('id', 'desc')
            ->get();
        $allVariationIds = Variation::pluck('id')->toArray();
        
        $inventories = Inventory::orderBy('id', 'desc')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('variations', 'inventories', 'allVariationIds'));
    }

    public function getDetail($id)
    {
        try {
            $inventory = InventoryDetail::where('inventory_id', $id)->get();
            return view('admin.components.inventories.detail', compact('inventory'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
// App/Http/Controllers/Admin/InventoryController.php

public function bulkUpdate(Request $request)
{
    // Validate request
    $request->validate([
        'selected_variations' => 'required|string',
        'wholesale_price.*' => 'required|numeric|min:1', // Thêm validation rule này
    ], [
        'selected_variations.required' => 'Vui lòng chọn ít nhất một sản phẩm',
        'wholesale_price.*.required' => 'Giá bán lẻ không được để trống',
        'wholesale_price.*.numeric' => 'Giá bán lẻ phải là số',
        'wholesale_price.*.min' => 'Giá bán lẻ phải lớn hơn 0',
    ]);

    try {
        $selectedIds = explode(',', $request->selected_variations);
        $wholesalePrices = $request->wholesale_price;

        foreach ($selectedIds as $id) {
            if (isset($wholesalePrices[$id])) {
                $variation = Variation::find($id);
                if ($variation) {
                    $variation->retail_price = $wholesalePrices[$id];
                    $variation->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Cập nhật giá bán lẻ thành công');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật giá bán lẻ');
    }
}

    public function historyImport($id)
    {
        try {
            $historyImport = Import_order_detail::with(['importOrder', 'importOrder.supplier'])
                ->where('variation_id', $id)
                ->whereHas('importOrder', function ($query) {
                    $query->where('status', 3); // Chỉ lấy đơn đã hoàn thành
                })
                ->get();

            return response()->json($historyImport);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function import(Request $request)
    {
        // Kiểm tra xem file có được tải lên hay không
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Nhập dữ liệu từ file Excel
        $importedVariations = Excel::toArray(new VariationsImport, $request->file('file'));

        // Lọc ra những biến thể có sự khác biệt về số lượng
        $differences = array_filter($importedVariations[0], function ($variation) {
            return $variation !== null; // Chỉ lấy những biến thể không null
        });

        // Tạo mảng để lưu trữ kết quả so sánh
        $results = [];

        // So sánh số lượng
        foreach ($differences as $variation) {
            // Truy vấn biến thể từ cơ sở dữ liệu
            $dbVariation = Variation::where('sku', $variation['ma_bien_the'])->first();

            // Nếu biến thể tồn tại trong cơ sở dữ liệu
            if ($dbVariation) {
                $currentStock = $dbVariation->stock; // Số lượng trên web
                $deviation = $variation['so_luong'] - $currentStock; // Tính độ lệch

                if ($deviation !== 0) { // Nếu có độ lệch
                    $results[] = [
                        'ma_bien_the' => $variation['ma_bien_the'],
                        'ten_bien_the' => $variation['ten_bien_the'],
                        'danh_muc' => $variation['danh_muc'],
                        'thuong_hieu' => $variation['thuong_hieu'],
                        'so_luong' => $variation['so_luong'],
                        'dvt' => $variation['dvt'],
                        'current_stock' => $currentStock, // Số lượng trên web
                        'deviation' => $deviation, // Độ lệch
                    ];
                }
            }
        }

        // Kiểm tra xem có dữ liệu nào không
        if (empty($results)) {
            return redirect()->back()->with('error', 'Không có sản phẩm nào có sự khác biệt về số lượng.');
        }

        // Lưu results vào session trước khi return view
        session(['results' => $results]);

        return view('admin.components.inventories.difference', compact('results'));
    }
    public function save(Request $request)
    {
        try {
            $result = DB::transaction(function () use ($request) {
                // Create new inventory record
                $inventory = Inventory::create([
                    'name' => 'Kiểm kê #' . rand(1000000, 999999)
                ]);

                // Get the results from session
                $results = session('results');
                // Create inventory details for each variation 
                foreach ($results as $variation) {
                    InventoryDetail::create([
                        'inventory_id' => $inventory->id,
                        'variation_id' => $variation['ma_bien_the'],
                        'variation_name' => $variation['ten_bien_the'],
                        'actual_quantity' => $variation['so_luong'],
                        'system_quantity' => $variation['current_stock'],
                        'deviation' => $variation['deviation']
                    ]);
                }
            });

            return redirect()->route('inventories.index')->with('success', 'Đã lưu thành công kiểm kê tồn kho');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi lưu kiểm kê: ' . $e->getMessage());
        }
    }

    public function getExportHistory($id)
    {
        try {
            $orderDetails = Order_detail::with(['order', 'order.customer'])
                ->where('variation_id', $id)
                ->whereHas('order', function($query) {
                    $query->whereIn('status_id', [4]); // Đơn đã hoàn thành
                })
                ->get()
                ->map(function($detail) {
                    return [
                        'slug' => $detail->order->slug,
                        'quantity' => $detail->quantity,
                        'price' => $detail->price,
                        'customer_name' => $detail->order->customer_name ?? 'Khách lẻ',
                        'created_at' => $detail->order->created_at
                    ];
                });

            return response()->json($orderDetails);
        } catch (\Exception $e) {
            Log::error('Error in getExportHistory: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

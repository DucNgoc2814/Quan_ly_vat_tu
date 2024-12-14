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
        // Validate file upload
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Import data from Excel
        $importedVariations = Excel::toArray(new VariationsImport, $request->file('file'));

        // Filter out null values
        $differences = array_filter($importedVariations[0], function ($variation) {
            return $variation !== null;
        });

        $results = [];
        $missingSKUs = [];

        // Compare quantities
        foreach ($differences as $variation) {
            // Query variation from database
            $dbVariation = Variation::where('sku', $variation['ma_bien_the'])->first();

            if ($dbVariation) {
                $currentStock = $dbVariation->stock;
                $deviation = $variation['so_luong'] - $currentStock;

                if ($deviation !== 0) {
                    $results[] = [
                        'ma_bien_the' => $variation['ma_bien_the'],
                        'ten_bien_the' => $variation['ten_bien_the'],
                        'danh_muc' => $variation['danh_muc'],
                        'thuong_hieu' => $variation['thuong_hieu'],
                        'so_luong' => $variation['so_luong'],
                        'dvt' => $variation['dvt'],
                        'current_stock' => $currentStock,
                        'deviation' => $deviation,
                        'status' => 'exists' // Add status for existing SKUs
                    ];
                }
            } else {
                // Add to missing SKUs list
                $missingSKUs[] = $variation['ma_bien_the'];

                // Add to results with missing status
                $results[] = [
                    'ma_bien_the' => $variation['ma_bien_the'],
                    'ten_bien_the' => $variation['ten_bien_the'],
                    'danh_muc' => $variation['danh_muc'],
                    'thuong_hieu' => $variation['thuong_hieu'],
                    'so_luong' => $variation['so_luong'],
                    'dvt' => $variation['dvt'],
                    'current_stock' => 0,
                    'deviation' => 0,
                    'status' => 'missing' // Add status for missing SKUs
                ];
            }
        }

        // If there are missing SKUs, show error message
        if (!empty($missingSKUs)) {
            $message = 'Không tìm thấy các mã sau trong hệ thống: ' . implode(', ', $missingSKUs);
            session()->flash('warning', $message);
        }

        // Check if there's any data
        if (empty($results)) {
            return redirect()->back()->with('error', 'Không có sản phẩm nào có sự khác biệt về số lượng.');
        }

        // Save results to session
        session(['results' => $results]);

        return view('admin.components.inventories.difference', compact('results'));
    }
    public function save(Request $request)
    {
        try {
            $result = DB::transaction(function () use ($request) {
                // Create new inventory record
                $inventory = Inventory::create([
                    'name' => 'Kiểm kê #' . rand(0, 999999)
                ]);

                // Get the results from session
                $results = session('results');
                // Create inventory details for each variation 
                foreach ($results as $variation) {
                    $dbVariation = Variation::where('sku', $variation['ma_bien_the'])->first();

                    InventoryDetail::create([
                        'inventory_id' => $inventory->id,
                        'variation_id' => $dbVariation->id, 
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
                ->whereHas('order', function ($query) {
                    $query->whereIn('status_id', [4]); // Đơn đã hoàn thành
                })
                ->get()
                ->map(function ($detail) {
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

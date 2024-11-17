<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Models\Variation;
use App\Imports\VariationsImport;
use App\Models\InventoryDetail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.8
     */
    const PATH_VIEW = 'admin.components.inventories.';

    public function index()
    {
        $variations = Variation::orderBy('id', 'desc')->get();
        $inventories = Inventory::orderBy('id', 'desc')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('variations', 'inventories'));
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
                    'name' => 'Kiểm kê #' . rand(1000, 9999) . ' - ' . now()->format('d/m/Y H:i:s')
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
    public function getDetail($id)
    {
        $inventory = Inventory::with('inventoryDetails.variation')->findOrFail($id);
        return view('admin.components.inventories.detail', compact('inventory'));
    }
}

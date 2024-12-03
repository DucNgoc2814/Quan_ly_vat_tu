<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Variation;
use Symfony\Component\HttpFoundation\Request;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get("search");
        $listsupplier = Supplier::select('suppliers.*')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orwhere('email', 'like', "%{$search}%")
                    ->orwhere('number_phone', 'like', "%{$search}%")
                    ->orwhere('address', 'like', "%{$search}%");
            })->paginate(5);
        // $listsupplier = Supplier::query()->get();
        return view('admin.components.suppliers.index', compact('listsupplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.components.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        if ($request->isMethod('post')) {
            $params = $request->except('_token');
            Supplier::create($params);
            return redirect('quan-ly-tai-khoan/danh-sach-nha-cung-cap')->with('success', 'Bạn đã thêm mới thành công nhà cung cấp');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $variations = Variation::all();
        $supplierVariations = $supplier->variations()->paginate(10);
        
        return view('admin.components.suppliers.edit', compact('supplier', 'variations', 'supplierVariations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, String $id)
    {
        try {
            $supplier = Supplier::findOrFail($id);
            
            // Cập nhật thông tin cơ bản
            $supplier->update([
                'name' => $request->name,
                'email' => $request->email,
                'number_phone' => $request->number_phone,
                'address' => $request->address,
            ]);

            return redirect('quan-ly-tai-khoan/danh-sach-nha-cung-cap')
                ->with('success', 'Bạn đã thay đổi thông tin thành công nhà cung cấp');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function addVariations(Request $request, Supplier $supplier)
    {
        try {
            $variations = $request->variations ?? [];
            $supplier->variations()->attach($variations);

            return response()->json([
                'success' => true,
                'message' => 'Thêm biến thể thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    public function removeVariation(Request $request, $supplierId, $variationId)
    {
        try {
            $supplier = Supplier::findOrFail($supplierId);
            $supplier->variations()->detach($variationId);
            
            return response()->json([
                'success' => true,
                'message' => 'Xóa biến thể thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

}

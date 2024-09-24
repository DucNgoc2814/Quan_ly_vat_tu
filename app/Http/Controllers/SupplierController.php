<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
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
    public function edit(String $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.components.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, String $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');
            $supplier = Supplier::findOrFail($id);
            $supplier->update($params);
            return redirect('quan-ly-nha-phan-phoi/danh-sach')->with('success', 'Bạn đã thay đổi thông tin thành công nhà cung cấp');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, String $id)
    {
        if ($request->isMethod('delete')) {
            $supplier = Supplier::findOrFail($id);
            $supplier->delete();
            return redirect('quan-ly-nha-phan-phoi/danh-sach')->with('success', 'Bạn đã ẩn nhà cung cấp thành công !');
        }
    }

    public function listTrashSupplier(Request $request){
        $listTrashSupplier = Supplier::onlyTrashed()->paginate(5);
        return view('admin.components.suppliers.trashsuppier', compact('listTrashSupplier'));
    }
    public function restoreSupplier(String $id){
        $supplier = Supplier::onlyTrashed()->findOrFail($id);
        $supplier->restore();
        return redirect('quan-ly-nha-phan-phoi/danh-sach-da-an')->with('success','Bạn đã khôi phục thành công');
    }
}

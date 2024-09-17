<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContract_typeRequest;
use App\Http\Requests\UpdateContract_typeRequest;
use App\Models\Contract_type;
use Illuminate\Http\Request;

class ContractTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->input('search');
        $contract_types = Contract_type::query()
        ->when($search, function($query,$search){
            return $query->where('name','like',"%{$search}");
        })
        ->orderByDesc('id')
        ->paginate(4);
        $title = "Danh sách loại hợp đồng";

        return view('admin.components.contract_types.index', compact('contract_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = " Thêm loại hợp đồng ";
        return view('admin.components.contract_types.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContract_typeRequest  $request )
    {
        if($request->isMethod('POST')){
            $data = [
                'name'=> $request->name,
                'description'=> $request->description,
            ];
            Contract_type::create($data);
            return redirect()->route('index')->with('msg','Thêm loại hợp đồng thành công');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract_type $contract_type)
    {
        


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Cập nhật loại hợp đồng";
       $contract_types = Contract_type::findOrFail($id);
       return view('admin.components.contract_types.edit', compact('contract_types', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContract_typeRequest $request, string $id)
    {
        if($request->isMethod('PUT')){
            $contract_types = Contract_type::find($id);
            $data = [
                'name' => $request->name,
                'description' => $request->description,
            ];
            $contract_types->update($data);
            return redirect()->route('index')->with('msg','Cập nhật loại hợp đồng thành công');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $contract_type = Contract_type::findOrFail($id);
        $contract_type->delete();
        return redirect()->route('index')->with('msg', 'Xóa loại hợp đồng thành công ');
    }
}

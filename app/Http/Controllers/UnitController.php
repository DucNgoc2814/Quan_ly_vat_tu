<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title="Danh sách đơn vị";
        $unit = Unit::query()->get();
        return view('admin.components.units.index', compact('unit','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $title="Thêm đơn vị";
        return view('admin.components.units.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUnitRequest $request)
    {
        $unit = Unit::create([
            'name' => $request->name
        ]);

        return redirect()->route('units.index')
            ->with('success', 'Thêm thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Sửa đơn vị";
        $unit = Unit::findOrFail($id);
        return view('admin.components.units.edit',compact('title','unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnitRequest $request, string $id)
    {
        $unit = Unit::findOrFail($id);
        $unit->update([
            'name' => $request->name
        ]);

        return redirect()->route('units.index')
            ->with('success', 'Sửa thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unit = Unit::findOrFail($id);
        
        try {
            $unit->delete();
            return redirect()->route('units.index')
                ->with('success', 'Xóa đơn vị thành công.');
        } catch (\Exception $e) {
            return redirect()->route('units.index')
                ->with('error', 'Không thể xóa đơn vị này.');
        }
    }
}

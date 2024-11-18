<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Models\Attribute_value;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.components.valueVariations.';
    public function index()
    {
        $attribute = Attribute::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('attribute'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }



    // AttributeController.php
    public function storeValue(Request $request)
    {
        $request->validate([
            'value' => [
                'required',
                'string',
                'max:255',
                Rule::unique('attribute_values', 'value')->where(function ($query) use ($request) {
                    return $query->where('attribute_id', $request->attribute_id);
                })
            ],
            'attribute_id' => 'required|exists:attributes,id'
        ], [
            'value.required' => 'Giá trị biến thể không được để trống',
            'value.unique' => 'Giá trị này đã tồn tại trong loại biến thể này',
            'value.max' => 'Giá trị không được vượt quá 255 ký tự'
        ]);
    
        $value = Attribute_value::create([
            'attribute_id' => $request->attribute_id,
            'value' => $request->value
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Thêm giá trị thành công'
        ]);
    }
    




    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttributeRequest $request)
    {
        $attribute = Attribute::create([
            'name' => $request->name,
        ]);

        foreach ($request->values as $value) {
            Attribute_value::create([
                'attribute_id' => $attribute->id,
                'value' => $value
            ]);
        }

        return redirect()->route('valueVariations.index')
            ->with('success', 'Thêm loại biến thể thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attribute $attribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttributeRequest $request, Attribute $attribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Models\Attribute_value;
use Illuminate\Http\Request;

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
        //
    }



    // AttributeController.php
    public function storeValue(Request $request)
    {
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
        //
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

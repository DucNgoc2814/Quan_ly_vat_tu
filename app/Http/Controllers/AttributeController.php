<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Models\Attribute_value;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

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
                'min:3',
                'max:55',
                'regex:/^(?![0-9]+$).*/',
                Rule::unique('attribute_values', 'value')->where(function ($query) use ($request) {
                    return $query->where('attribute_id', $request->attribute_id);
                })
            ],
            'attribute_id' => 'required|exists:attributes,id'
        ], [
            'value.required' => 'Giá trị biến thể không được để trống',
            'value.unique' => 'Giá trị này đã tồn tại trong loại biến thể này',
            'value.min' => 'Giá trị biến thể phải có ít nhất 3 ký tự',
            'value.max' => 'Giá trị không được vượt quá 55 ký tự',
            'value.regex' => 'Giá trị biến thể không được chỉ chứa số',
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
     * Show the form for editing the specified resource.
     */
    public function edit(String $attribute)
    {

        $attribute = Attribute::with('attributeValues')->findOrFail($attribute);
        return view(self::PATH_VIEW . 'edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttributeRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            
            $attribute = Attribute::findOrFail($id);
            $attribute->update([
                'name' => $request->name,
            ]);

            $existingValues = $attribute->attributeValues->pluck('id')->toArray();
            $updatedValues = [];

            foreach ($request->values as $key => $value) {
                if (!empty(trim($value))) {
                    if (isset($existingValues[$key])) {
                        // Cập nhật giá trị cũ
                        Attribute_value::where('id', $existingValues[$key])
                            ->update(['value' => $value]);
                        $updatedValues[] = $existingValues[$key];
                    } else {
                        // Thêm giá trị mới
                        $newValue = $attribute->attributeValues()->create([
                            'value' => $value
                        ]);
                        $updatedValues[] = $newValue->id;
                    }
                }
            }

            // Xóa những giá trị không còn trong danh sách cập nhật
            if (!empty($updatedValues)) {
                $attribute->attributeValues()
                    ->whereNotIn('id', $updatedValues)
                    ->delete();
            }

            DB::commit();
            return redirect()->route('valueVariations.index')
                ->with('success', 'Cập nhật loại biến thể thành công');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Exception;
use voku\helper\ASCII;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.components.brand.';
    public function index()
    {
        $brands = Brand::query()->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $brand = $request->validated();
        try {
            $sku = Str::slug(ASCII::to_ascii($brand['name']));
            Brand::create([
                'name' => $brand['name'],
                'sku' => $sku,
                'is_active' => isset($brand['is_active']) ? 1 : 0,
            ]);
            return redirect()
                ->route('brand.index')
                ->with('success', 'Thao tác thành công!');
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $sku)
    {
        $brand = Brand::where('sku', $sku)->firstOrFail();
        return view(self::PATH_VIEW . __FUNCTION__, compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $data = $request->validated();
        try {
            $sku = Str::slug(ASCII::to_ascii($data['name']));
            $brand->update([
                'name' => $data['name'],
                'sku' => $sku,
                'is_active' => isset($data['is_active']) ? 1 : 0,
            ]);
            return redirect()
                ->route('brand.index')
                ->with('success', 'Thao tác thành công!');
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}

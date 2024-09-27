<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    const PATH_VIEW = 'admin.components.Categories.';

    public function index()
    {
        $data = DB::table('Categories')->get();
        return view(self::PATH_VIEW . 'index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->pluck('sku', 'id');
        return view(self::PATH_VIEW . __FUNCTION__, compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = [
            'name' => $request->name,
            'sku' => $request->sku,
            'image' => $request->image,
            'description' => $request->description,
        ];
        Category::create($data);
        // return view(self::PATH_VIEW . __FUNCTION__, compact('categories'));
        return redirect()->route('categories.index')->with('success', 'Thêm mới thành công!');
    }



    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}

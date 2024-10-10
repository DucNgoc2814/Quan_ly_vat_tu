<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
        return view(self::PATH_VIEW . 'create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
                'name' => 'required',
                'sku' => 'required',
                'image' => 'required',
                'description' => 'required',
            ]);
            $data = [
                'name' => $request->name,
                'sku' => $request->sku,
                'image' => $request->image,
                'description' => $request->description,
            ];
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
                $data['image'] = $imagePath;
            }
            Category::query()->create($data);
            return redirect()->route('category.index');
       
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
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.components.categories.edit', compact('category'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {


        $data = [
            'name' => $request->name,
            'sku' => $request->sku,
            'description' => $request->description,
        ];
        $request->validate([
            'name' => 'required|string|',
            'sku' => 'required|string|',
            'image' => 'nullable|image|',
            'description' => 'nullable|string',
        ]);

        $category = Category::findOrFail($id);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        DB::table('categories')
            ->where('id', $id)
            ->update($data);

        return redirect()->route('category.index')->with('success', 'Danh mục đã được cập nhật thành công.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}

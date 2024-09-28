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


        try {
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
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
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
    { {
            $category = Category::findOrFail($id);

            return view('admin.categories.edit', compact('category'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Tìm danh mục theo ID
        $category = Category::findOrFail($id);

        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        // Cập nhật dữ liệu danh mục
        $category->update([
            'name' => $request->name,
            'sku' => $request->sku,
            'image' => $request->image,
            'description' => $request->description,
        ]);

        return redirect()->route('category.index')->with('success', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->products()->count() > 0) {
            return redirect()->route('category.index')->with('error', 'Không thể xóa danh mục vì vẫn còn sản phẩm liên quan.');
        }

        $category->delete();

        return redirect()->route('category.index')->with('success', 'Xóa danh mục thành công.');
    }
}

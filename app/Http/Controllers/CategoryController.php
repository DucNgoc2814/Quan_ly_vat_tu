<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    const PATH_VIEW = 'admin.components.categories.';

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
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $sku = $this->convertSku($request->name);
        $data = [
            'name' => $request->name,
            'sku' => $sku,
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
        $category1 = Category::findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__,compact('category1'));
    }


    /** 
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $sku = $this->convertSku($request->name);
        $data = [
            'name' => $request->name,
            'sku' => $sku,
            'description' => $request->description,
        ];

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



    private function convertSku($string)
    {
        $string = strtolower($string);
        $string = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);
        $string = preg_replace('/[^a-z0-9\s]+/', '', $string);
        $string = preg_replace('/\s+/', '-', $string);
        $string = trim($string, '-');
        return $string;
    }
}

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
        return view(self::PATH_VIEW . 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sku = $this->convertSku($request->name);
            $request->validate([
                'name' => 'required|unique:categories,name',
                'image' => 'required',
                'description' => 'required',
            ]);

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
        $category = Category::findOrFail($id);
        return view('admin.components.categories.edit', compact('category'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $sku = $this->convertSku($request->name);

        $data = [
            'name' => $request->name,
            'sku' => $sku,
            'description' => $request->description,
        ];
        $request->validate([
            'name' => 'required|unique:categories,name',
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

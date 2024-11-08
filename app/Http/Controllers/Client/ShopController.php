<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

use function Laravel\Prompts\table;

class ShopController extends Controller
{
    const PATH_VIEW = 'client.client_list_product.';
    
    public function listProduct()
    {
        $categories = Category::get();
        $brands = Brand::get();
        $products = Product::with('variations')->get();
        return view(self::PATH_VIEW . 'index', compact('categories', 'brands', 'products'));
    }
    public function listProductWCategory($category)
    {
        $categories = Category::get();
        $category_id = Category::query()->where("sku",$category)->pluck('id');
        $brands = Brand::get();
        $products = Product::where("category_id", $category_id[0])->get();
        return view(self::PATH_VIEW . 'index', compact('categories', 'brands', 'products'));;
    }
}
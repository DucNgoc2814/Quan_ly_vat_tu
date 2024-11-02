<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ListProductCategoryController extends Controller
{
    const PATH_VIEW = 'client.client_list_product.';

    public function listProduct()
    {
        $categories = Category::get();
        $brands = Brand::get();
        $products = Product::with('variations')->get();
        return view(self::PATH_VIEW . 'index', compact('categories', 'brands', 'products'));
    }
}

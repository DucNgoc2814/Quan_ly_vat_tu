<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller

{
    // const PATH_VIEW = '';
    public function listHome()
    {
        $categories = Category::get();
        $brands = Brand::get();
        $products = Product::with('variations')->orderBy('id', 'desc')->paginate(4); // Gọi 1 lần duy nhất
        return view('index', compact('categories', 'brands', 'products'));
    }
    
}

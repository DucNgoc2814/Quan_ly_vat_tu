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
        $products = Product::with('variations')
            ->where('is_active', 1)
            ->orderBy('id', 'desc')
            ->paginate(4);
        return view('index', compact('categories', 'brands', 'products'));
    }

    public function contact()
    {
        return view('client.layouts.relates.contact');
    }

    public function about()
    {
        return view('client.layouts.relates.about');
    }
}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function index($slug)
    {
        $product = Product::where("slug", $slug)->firstOrFail();
        $galleries = $product->galleries;
        $variations = $product->variations()->with('attributeValues')->get();
        $attributes = Attribute::with('attributeValues')->whereHas('attributeValues.variations', function ($query) use ($product) {
            $query->where('product_id', $product->id);
        })->get();

        return view("client.productDetail", compact("product", "galleries", "variations", "attributes"));
    }
}

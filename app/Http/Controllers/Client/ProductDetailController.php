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
        $variations = $product->variations()->get();
        $attributes = Attribute::with('attributeValues')->whereHas('attributeValues.variations', function ($query) use ($product) {
            $query->where('product_id', $product->id);
        })->get();
     
        foreach ($variations as $a) {
            $b = $a->attributeValues;
            foreach ($b as $c) {
            }
        }
        dd($a);
        $initialStock = $variations->sum('stock');

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->orWhere('brand_id', $product->brand_id)
            ->where('id', '!=', $product->id)
            ->take(10)
            ->get();

        return view("client.productDetail", compact("product", "galleries", "variations", "attributes", "relatedProducts", "initialStock"));
    }
}

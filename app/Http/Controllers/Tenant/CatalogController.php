<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Product;

class CatalogController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('tenant.catalog.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->increment('views');
        return view('tenant.catalog.show', compact('product'));
    }

    public function like(Product $product)
    {
        $product->increment('likes');

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'likes' => $product->likes
            ]);
        }

        return back()->with('success', '¡Gracias por tu me gusta!');
    }
}

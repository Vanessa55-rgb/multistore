<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('tenant.admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('tenant.admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image'
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'image' => $path,
            'description' => $request->description
        ]);

        return redirect()->route('tenant.admin.products.index');
    }

    // Add edit/update/destroy as needed
}

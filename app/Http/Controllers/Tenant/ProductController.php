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
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'is_offer' => 'nullable|boolean',
            'offer_price' => 'nullable|numeric|required_if:is_offer,1'
        ]);

        try {
            $path = null;
            if ($request->hasFile('image')) {
                $path = $request->file('image')->storePublicly('products', 'public');
            }

            Product::create([
                'name' => $validated['name'],
                'price' => $validated['price'],
                'image' => $path,
                'description' => $request->description,
                'is_offer' => $request->has('is_offer'),
                'offer_price' => $request->offer_price
            ]);

            return redirect()->route('tenant.admin.products.index')->with('success', 'Producto creado con éxito');
        } catch (\Exception $e) {
            \Log::error('Error al guardar producto: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Error al guardar el producto: ' . $e->getMessage());
        }
    }

    public function edit(Product $product)
    {
        return view('tenant.admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'is_offer' => 'nullable|boolean',
            'offer_price' => 'nullable|numeric|required_if:is_offer,1'
        ]);

        try {
            $data = [
                'name' => $validated['name'],
                'price' => $validated['price'],
                'description' => $request->description,
                'is_offer' => $request->has('is_offer'),
                'offer_price' => $request->offer_price
            ];

            if ($request->hasFile('image')) {
                if ($product->image && !filter_var($product->image, FILTER_VALIDATE_URL)) {
                    Storage::disk('public')->delete($product->image);
                }
                $data['image'] = $request->file('image')->storePublicly('products', 'public');
            }

            $product->update($data);

            return redirect()->route('tenant.admin.products.index')->with('success', 'Producto actualizado con éxito');
        } catch (\Exception $e) {
            \Log::error('Error al actualizar producto: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Error al actualizar el producto: ' . $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('tenant.admin.products.index')->with('success', 'Producto eliminado con éxito');
    }
}

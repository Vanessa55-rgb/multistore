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
}

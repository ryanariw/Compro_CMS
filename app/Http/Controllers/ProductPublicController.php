<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductPublicController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        // route-model-binding will match by ID unless we specify; keep safe:
        $product->load('images');

        if (!$product->is_active) {
            abort(404);
        }

        return view('products.show', compact('product'));
    }
}

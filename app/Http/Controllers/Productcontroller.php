<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = ProductCategory::withCount('products')->get();

        $products = Product::with('category')
            ->where('is_active', true)
            ->when($request->kategori, fn($q) => $q->whereHas('category', fn($q) => $q->where('slug', $request->kategori)))
            ->when($request->q, fn($q) => $q->where('name', 'like', '%' . $request->q . '%'))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('product', compact('products', 'categories'));
    }

    public function show(string $slug)
    {
        $product = Product::with('category')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('productdetail', compact('product'));
    }
}
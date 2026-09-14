<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category')
            ->when($request->filled('category'), fn($q) => $q->where('product_category_id', $request->category))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = ProductCategory::orderBy('name')->get();

        return view('admin.product', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = ProductCategory::orderBy('name')->get();

        return view('admin.productcreate', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['slug'] = $this->uniqueSlug($validated['name']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::orderBy('name')->get();

        return view('admin.productedit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $this->validated($request);

        if ($validated['name'] !== $product->name) {
            $validated['slug'] = $this->uniqueSlug($validated['name'], $product->id);
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->thumbnail) {
            Storage::disk('public')->delete($product->thumbnail);
        }

        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'product_category_id' => 'nullable|exists:product_categories,id',
            'name' => 'required|string|max:150',
            'description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'thumbnail' => 'nullable|image|max:2048',
        ]);
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $i = 1;

        while (
            Product::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = "{$original}-{$i}";
            $i++;
        }

        return $slug;
    }
}

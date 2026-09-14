<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $productCategories = ProductCategory::withCount('products')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.productcategory', compact('productCategories'));
    }

    public function create()
    {
        return view('admin.productcategorycreate');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = $this->uniqueSlug($validated['name']);

        ProductCategory::create($validated);

        return redirect()->route('admin.productcategories.index')->with('success', 'Kategori produk berhasil ditambahkan.');
    }

    public function edit(ProductCategory $productcategory)
    {
        return view('admin.productcategoryedit', compact('productcategory'));
    }

    public function update(Request $request, ProductCategory $productcategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
        ]);

        if ($validated['name'] !== $productcategory->name) {
            $validated['slug'] = $this->uniqueSlug($validated['name'], $productcategory->id);
        }

        $productcategory->update($validated);

        return redirect()->route('admin.productcategories.index')->with('success', 'Kategori produk berhasil diperbarui.');
    }

    public function destroy(ProductCategory $productcategory)
    {
        $productcategory->delete();

        return back()->with('success', 'Kategori produk berhasil dihapus.');
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $i = 1;

        while (
            ProductCategory::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = "{$original}-{$i}";
            $i++;
        }

        return $slug;
    }
}

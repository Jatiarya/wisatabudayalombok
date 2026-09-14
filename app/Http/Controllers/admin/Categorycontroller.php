<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('destinations')->latest()->paginate(10);

        return view('admin.category', compact('categories'));
    }

    public function create()
    {
        return view('admin.categorycreate');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['slug'] = Str::slug($validated['name']);

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('admin.categoryedit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $this->validated($request);
        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
        ]);
    }
}

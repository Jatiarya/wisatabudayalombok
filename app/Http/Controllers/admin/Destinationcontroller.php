<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Destination;
use App\Models\DestinationImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::with('category')->latest()->paginate(10);

        return view('admin.destination', compact('destinations'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.destinationcreate', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('destinations', 'public');
        }

        $destination = Destination::create($validated);

        $this->syncGallery($request, $destination);

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil ditambahkan.');
    }

    public function edit(Destination $destination)
    {
        $categories = Category::orderBy('name')->get();
        $destination->load('images');

        return view('admin.destinationedit', compact('destination', 'categories'));
    }

    public function update(Request $request, Destination $destination)
    {
        $validated = $this->validated($request);
        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('thumbnail')) {
            if ($destination->thumbnail) {
                Storage::disk('public')->delete($destination->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('destinations', 'public');
        }

        $destination->update($validated);

        $this->syncGallery($request, $destination);

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil diperbarui.');
    }

    public function destroy(Destination $destination)
    {
        foreach ($destination->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        if ($destination->thumbnail) {
            Storage::disk('public')->delete($destination->thumbnail);
        }

        $destination->delete();

        return back()->with('success', 'Destinasi berhasil dihapus.');
    }

    public function destroyImage(Destination $destination, DestinationImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }

    private function syncGallery(Request $request, Destination $destination): void
    {
        if (! $request->hasFile('gallery')) {
            return;
        }

        foreach ($request->file('gallery') as $index => $file) {
            $destination->images()->create([
                'image_path' => $file->store('destinations/gallery', 'public'),
                'sort_order' => $index,
            ]);
        }
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:150',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'thumbnail' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
        ]);
    }
}

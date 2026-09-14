<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Destination;
use App\Models\TripItinerary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('destinations')->get();

        $destinations = Destination::with('category')
            ->when($request->kategori, fn($q) => $q->whereHas('category', fn($q) => $q->where('slug', $request->kategori)))
            ->when($request->q, fn($q) => $q->where('name', 'like', '%' . $request->q . '%'))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('destination', compact('destinations', 'categories'));
    }

    public function show(string $slug)
    {
        $destination = Destination::with(['category', 'images'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedTrips = TripItinerary::with('trip')
            ->where('destination_id', $destination->id)
            ->get()
            ->pluck('trip')
            ->filter()
            ->unique('id');

        // Optimasi: Tambah eagerly load 'user' pada ulasan untuk cegah N+1 query
        $reviews = $destination->approvedReviews()->with('user')->get();

        return view('destinationdetail', compact('destination', 'relatedTrips', 'reviews'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $this->uploadAndCompressImage($request->file('thumbnail'), $validated['name']);
        }

        $validated['slug'] = Str::slug($validated['name']);
        Destination::create($validated);

        return redirect()->back()->with('success', 'Destinasi berhasil ditambahkan!');
    }

    public function update(Request $request, Destination $destination)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($destination->thumbnail) {
                Storage::disk('public')->delete($destination->thumbnail);
            }
            $validated['thumbnail'] = $this->uploadAndCompressImage($request->file('thumbnail'), $validated['name']);
        }

        $validated['slug'] = Str::slug($validated['name']);
        $destination->update($validated);

        return redirect()->back()->with('success', 'Destinasi berhasil diperbarui!');
    }

    private function uploadAndCompressImage($file, string $name): string
    {
        $filename = 'destinations/' . Str::slug($name) . '-' . time() . '.webp';
        $imageStream = Image::read($file)->scale(width: 800)->toWebp(80);
        Storage::disk('public')->put($filename, (string) $imageStream);

        return $filename;
    }
}
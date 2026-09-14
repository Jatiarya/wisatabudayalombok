<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class TripController extends Controller
{
    public function index()
    {

        $trips = Trip::where('is_active', true)
            ->withCount(['itineraries', 'approvedReviews'])
            ->latest()
            ->paginate(9);

        return view('trip', compact('trips'));
    }

    public function show(string $slug)
    {
        $trip = Trip::with('itineraries.destination')
            ->where('slug', $slug)
            ->firstOrFail();

        // Optimasi: Tambah eagerly load 'user' pada ulasan untuk cegah N+1 query
        $reviews = $trip->approvedReviews()->with('user')->get();

        return view('tripdetail', compact('trip', 'reviews'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'duration_nights' => 'required|integer|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $this->uploadAndCompressImage($request->file('thumbnail'), $validated['name']);
        }

        $validated['slug'] = Str::slug($validated['name']);
        Trip::create($validated);

        return redirect()->back()->with('success', 'Paket trip berhasil ditambahkan!');
    }

    public function update(Request $request, Trip $trip)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'duration_nights' => 'required|integer|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($trip->thumbnail) {
                Storage::disk('public')->delete($trip->thumbnail);
            }
            $validated['thumbnail'] = $this->uploadAndCompressImage($request->file('thumbnail'), $validated['name']);
        }

        $validated['slug'] = Str::slug($validated['name']);
        $trip->update($validated);

        return redirect()->back()->with('success', 'Paket trip berhasil diperbarui!');
    }

    private function uploadAndCompressImage($file, string $name): string
    {
        $filename = 'trips/' . Str::slug($name) . '-' . time() . '.webp';
        $imageStream = Image::read($file)->scale(width: 800)->toWebp(80);
        Storage::disk('public')->put($filename, (string) $imageStream);

        return $filename;
    }
}
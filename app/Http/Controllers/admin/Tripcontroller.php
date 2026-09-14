<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::latest()->paginate(10);

        return view('admin.trip', compact('trips'));
    }

    public function create()
    {
        $destinations = Destination::orderBy('name')->get();

        return view('admin.tripcreate', compact('destinations'));
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('trips', 'public');
        }

        $trip = Trip::create($validated);

        $this->syncItineraries($request, $trip);

        return redirect()->route('admin.trips.index')->with('success', 'Paket trip berhasil ditambahkan.');
    }

    public function edit(Trip $trip)
    {
        $destinations = Destination::orderBy('name')->get();
        $trip->load('itineraries');

        return view('admin.tripedit', compact('trip', 'destinations'));
    }

    public function update(Request $request, Trip $trip)
    {
        $validated = $this->validated($request);
        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            if ($trip->thumbnail) {
                Storage::disk('public')->delete($trip->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('trips', 'public');
        }

        $trip->update($validated);

        $this->syncItineraries($request, $trip);

        return redirect()->route('admin.trips.index')->with('success', 'Paket trip berhasil diperbarui.');
    }

    public function destroy(Trip $trip)
    {
        if ($trip->thumbnail) {
            Storage::disk('public')->delete($trip->thumbnail);
        }

        $trip->delete();

        return back()->with('success', 'Paket trip berhasil dihapus.');
    }

    private function syncItineraries(Request $request, Trip $trip): void
    {
        $trip->itineraries()->delete();

        $days = $request->input('itinerary', []);

        foreach ($days as $index => $day) {
            if (blank($day['title'] ?? null)) {
                continue;
            }

            $trip->itineraries()->create([
                'day_number' => $index + 1,
                'title' => $day['title'],
                'description' => $day['description'] ?? null,
                'destination_id' => $day['destination_id'] ?: null,
            ]);
        }
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'duration_nights' => 'nullable|integer|min:0',
            'thumbnail' => 'nullable|image|max:2048',
            'itinerary.*.title' => 'nullable|string|max:150',
            'itinerary.*.description' => 'nullable|string',
            'itinerary.*.destination_id' => 'nullable|exists:destinations,id',
        ]);
    }
}

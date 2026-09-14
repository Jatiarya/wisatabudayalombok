<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Trip;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'reviewable_type' => 'required|in:destination,trip',
            'reviewable_id' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ];

        if (! $request->user()) {
            $rules['name'] = 'required|string|max:100';
        }

        $validated = $request->validate($rules);

        $modelClass = $validated['reviewable_type'] === 'destination' ? Destination::class : Trip::class;

        $reviewable = $modelClass::findOrFail($validated['reviewable_id']);

        $reviewable->reviews()->create([
            'user_id' => $request->user()?->id,
            'name' => $request->user()?->name ?? $validated['name'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_approved' => false,
        ]);

        return back()->with('success', 'Terima kasih! Ulasan kamu akan tampil setelah disetujui admin.');
    }
}

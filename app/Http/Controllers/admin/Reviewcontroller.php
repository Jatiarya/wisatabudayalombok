<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviews = Review::with('reviewable')
            ->when($request->filled('rating'), fn($q) => $q->where('rating', $request->rating))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.review', compact('reviews'));
    }

    public function approve(Review $review)
    {
        $review->update(['is_approved' => true]);

        return back()->with('success', 'Ulasan disetujui.');
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return back()->with('success', 'Ulasan dihapus.');
    }
}

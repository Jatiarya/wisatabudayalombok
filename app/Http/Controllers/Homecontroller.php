<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Product;
use App\Models\Review;
use App\Models\Trip;

class HomeController extends Controller
{
    public function index()
    {
        $featuredDestinations = Destination::with('category')
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        $trips = Trip::where('is_active', true)->latest()->take(3)->get();

        $featuredProducts = Product::with('category')
            ->where('is_featured', true)
            ->where('is_active', true)
            ->latest()
            ->take(6)
            ->get();

        $testimonials = Review::approved()->latest()->take(6)->get();

        return view('home', compact('featuredDestinations', 'trips', 'featuredProducts', 'testimonials'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
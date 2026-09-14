<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Review;
use App\Models\Trip;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'categories' => Category::count(),
            'destinations' => Destination::count(),
            'trips' => Trip::count(),
            'pending_reviews' => Review::where('is_approved', false)->count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'unpaid_bookings' => Booking::where('payment_status', 'unpaid')->count(),
            'completed_bookings' => Booking::where('status', 'completed')->count(),
        ];

        $activeTripsCount = Trip::where('is_active', true)->count();

        $monthlyRevenue = Booking::where('payment_status', 'paid')
            ->whereMonth('paid_at', now()->month)
            ->whereYear('paid_at', now()->year)
            ->sum('total_price');

        $latestReviews = Review::latest()->take(5)->get();
        $latestBookings = Booking::with(['user', 'trip'])->latest()->take(5)->get();

        // Distribusi jumlah destinasi per kategori (untuk progress bar)
        $categoryDistribution = Category::withCount('destinations')
            ->orderByDesc('destinations_count')
            ->take(6)
            ->get();

        // Destinasi dengan ulasan terbanyak & rating rata-rata tertinggi
        $topDestinations = Destination::withCount(['reviews as reviews_count' => function ($q) {
            $q->where('is_approved', true);
        }])
            ->withAvg(['reviews as reviews_avg_rating' => function ($q) {
                $q->where('is_approved', true);
            }], 'rating')
            ->orderByDesc('reviews_count')
            ->take(5)
            ->get();

        // Tren jumlah ulasan masuk 6 bulan terakhir
        $reviewTrendRaw = Review::selectRaw("DATE_FORMAT(created_at, '%Y-%m-01') as month, COUNT(*) as total")
            ->where('created_at', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $reviewTrend = collect(range(5, 0))->map(function ($i) use ($reviewTrendRaw) {
            $month = now()->subMonths($i)->startOfMonth();
            $match = $reviewTrendRaw->firstWhere('month', $month->format('Y-m-d'));

            return [
                'label' => $month->translatedFormat('M Y'),
                'total' => $match->total ?? 0,
            ];
        });

        // Tren pendapatan (booking yang sudah lunas) 6 bulan terakhir, berdasarkan tanggal pembayaran
        $revenueTrendRaw = Booking::selectRaw("DATE_FORMAT(paid_at, '%Y-%m-01') as month, SUM(total_price) as total")
            ->where('payment_status', 'paid')
            ->where('paid_at', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $revenueTrend = collect(range(5, 0))->map(function ($i) use ($revenueTrendRaw) {
            $month = now()->subMonths($i)->startOfMonth();
            $match = $revenueTrendRaw->firstWhere('month', $month->format('Y-m-d'));

            return [
                'label' => $month->translatedFormat('M Y'),
                'total' => (float) ($match->total ?? 0),
            ];
        });

        return view('admin.dashboard', compact(
            'stats',
            'activeTripsCount',
            'monthlyRevenue',
            'latestReviews',
            'latestBookings',
            'categoryDistribution',
            'topDestinations',
            'reviewTrend',
            'revenueTrend',
        ));
    }
}

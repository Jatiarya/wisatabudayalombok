<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\BookingReportExport;
use App\Models\Booking;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Notifications\BookingConfirmedNotification; // Panggil class notifikasi

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::with(['user', 'trip'])
            ->where('status', '!=', 'completed')
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->when($request->filled('payment_status'), fn($q) => $q->where('payment_status', $request->payment_status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.booking', compact('bookings'));
    }

    public function confirmPayment(Booking $booking)
    {
        $booking->update([
            'payment_status' => 'paid',
            'paid_at' => now(),
        ]);

        // Kirim notifikasi saat pembayaran dikonfirmasi admin
        $booking->user->notify(new BookingConfirmedNotification($booking));

        return back()->with('success', "Pembayaran pesanan {$booking->booking_code} berhasil dikonfirmasi.");
    }

    public function confirm(Booking $booking)
    {
        $booking->update(['status' => 'confirmed']);

        // Kirim notifikasi saat status pesanan dikonfirmasi admin
        $booking->user->notify(new BookingConfirmedNotification($booking));

        return back()->with('success', "Pesanan {$booking->booking_code} berhasil dikonfirmasi.");
    }

    public function cancel(Booking $booking)
    {
        $booking->update(['status' => 'cancelled']);

        return back()->with('success', "Pesanan {$booking->booking_code} berhasil dibatalkan.");
    }

    public function complete(Booking $booking)
    {
        abort_unless($booking->status === 'confirmed', 400, 'Hanya pesanan yang sudah dikonfirmasi yang bisa ditandai selesai.');

        $booking->update(['status' => 'completed']);

        return back()->with('success', "Pesanan {$booking->booking_code} ditandai selesai dan dipindahkan ke laporan.");
    }

    public function uncomplete(Booking $booking)
    {
        abort_unless($booking->status === 'completed', 400, 'Pesanan ini belum berstatus selesai.');

        $booking->update(['status' => 'confirmed']);

        return back()->with('success', "Pesanan {$booking->booking_code} dikembalikan ke daftar pesanan aktif.");
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return back()->with('success', 'Pesanan berhasil dihapus.');
    }

    public function report(Request $request)
    {
        $query = $this->completedQuery($request);

        $totalCompleted = (clone $query)->count();
        $totalRevenue = (clone $query)->sum('total_price');
        $totalParticipants = (clone $query)->sum('participants');

        return view('admin.report', compact('totalCompleted', 'totalRevenue', 'totalParticipants'));
    }

    public function reportData(Request $request)
    {
        $query = $this->completedQuery($request)->with(['user', 'trip']);

        return DataTables::eloquent($query)
            ->addColumn('customer', fn(Booking $b) => view('admin.partials.booking-customer-cell', ['booking' => $b])->render())
            ->addColumn('trip_name', fn(Booking $b) => $b->trip->name)
            ->editColumn('departure_date', fn(Booking $b) => $b->departure_date->format('d M Y'))
            ->editColumn('total_price', fn(Booking $b) => 'Rp ' . number_format($b->total_price, 0, ',', '.'))
            ->addColumn('action', fn(Booking $b) => view('admin.partials.booking-report-action', ['booking' => $b])->render())
            ->rawColumns(['customer', 'action'])
            ->toJson();
    }

    public function exportReport(Request $request)
    {
        $month = $request->filled('month') ? (int) $request->month : null;
        $year = $request->filled('year') ? (int) $request->year : null;

        $filename = 'laporan-pesanan-' . now()->format('Y-m-d_His') . '.xlsx';

        return Excel::download(new BookingReportExport($month, $year), $filename);
    }

    private function completedQuery(Request $request)
    {
        return Booking::query()
            ->where('status', 'completed')
            ->when($request->filled('month'), fn($q) => $q->whereMonth('departure_date', $request->month))
            ->when($request->filled('year'), fn($q) => $q->whereYear('departure_date', $request->year));
    }
}
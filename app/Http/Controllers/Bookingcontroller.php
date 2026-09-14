<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Trip;
use App\Services\MidtransService;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Mail\BookingInvoiceMail;
use Illuminate\Support\Facades\Mail;

use App\Notifications\BookingCreatedNotification;

class BookingController extends Controller
{
    public function create(string $slug)
    {
        $trip = Trip::where('slug', $slug)->where('is_active', true)->firstOrFail();

        return view('booking', compact('trip'));
    }

    public function store(Request $request, string $slug)
    {
        $trip = Trip::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $validated = $request->validate([
            'departure_date' => 'required|date|after:today',
            'participants' => 'required|integer|min:1|max:20',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:500',
        ]);

        $booking = Booking::create([
            'booking_code' => Booking::generateCode(),
            'user_id' => $request->user()->id,
            'trip_id' => $trip->id,
            'departure_date' => $validated['departure_date'],
            'participants' => $validated['participants'],
            'total_price' => $trip->price * $validated['participants'],
            'phone' => $validated['phone'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        // Kirim email konfirmasi pesanan ke email pengguna
        // Kirim email konfirmasi pesanan ke email pengguna
        // Kirim email konfirmasi pesanan ke email pengguna
        try {
            Mail::to($request->user()->email)->send(new BookingInvoiceMail($booking));
        } catch (\Exception $e) {
            // Tangkap atau abaikan jika gagal mengirim agar tidak merusak alur redirect
        }
        $request->user()->notify(new BookingCreatedNotification($booking));
        return redirect()->route('booking.show', $booking)
            ->with('success', 'Pesanan berhasil dibuat! Kode booking kamu: ' . $booking->booking_code);
    }

    public function index(Request $request)
    {
        $query = Booking::with('trip')
            ->where('user_id', $request->user()->id)
            ->latest();

        // 1. Filter berdasarkan Periode Waktu Cepat (jika tombol 30 hari diklik)
        if ($request->period === '30days') {
            $query->where('created_at', '>=', now()->subDays(30));
        } elseif ($request->period === '90days') {
            $query->where('created_at', '>=', now()->subDays(90));
        }

        // 2. Filter berdasarkan Date Picker (Diperbaiki agar mencakup seluruh rentang hari)
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('departure_date', '>=', $request->start_date)
                ->whereDate('departure_date', '<=', $request->end_date);
        } elseif ($request->filled('start_date')) {
            $query->whereDate('departure_date', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->whereDate('departure_date', '<=', $request->end_date);
        }

        // 3. Filter berdasarkan Status Pesanan
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->paginate(10)->withQueryString();

        return view('bookinghistory', compact('bookings'));
    }
    public function show(Booking $booking, MidtransService $midtrans)
    {
        abort_unless($booking->user_id === auth()->id(), 403);

        $booking->load('trip');

        $snapToken = $booking->snap_token;

        $needsPayment = $booking->payment_status === 'unpaid'
            && ! in_array($booking->status, ['cancelled', 'completed']);

        if ($needsPayment && ! $snapToken) {
            $snapToken = $midtrans->createSnapToken($booking);
        } elseif (! $needsPayment) {
            $snapToken = null;
        }

        return view('bookingdetail', compact('booking', 'snapToken'));
    }

    public function cancel(Booking $booking)
    {
        abort_unless($booking->user_id === auth()->id(), 403);
        abort_if($booking->status !== 'pending' || $booking->payment_status !== 'unpaid', 400, 'Pesanan ini tidak bisa dibatalkan.');

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function downloadPdf(Booking $booking)
    {
        // Pastikan hanya pemilik booking atau admin yang bisa mengunduh
        abort_unless($booking->user_id === auth()->id() || auth()->user()->role === 'admin', 403);

        $booking->load('trip', 'user');

        // Sesuaikan view PDF dengan struktur folder Anda (misal: 'pdf.invoice' atau 'invoice')
        $pdf = Pdf::loadView('invoice', compact('booking'));

        return $pdf->download('Invoice-Booking-' . $booking->booking_code . '.pdf');
    }
}

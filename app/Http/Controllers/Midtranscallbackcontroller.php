<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Notifications\BookingConfirmedNotification; // Panggil class notifikasi

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        $serverKey = config('midtrans.server_key');

        $orderId = $request->input('order_id');
        $statusCode = $request->input('status_code');
        $grossAmount = $request->input('gross_amount');
        $signatureKey = $request->input('signature_key');

        $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        if ($signatureKey !== $expectedSignature) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $booking = Booking::where('booking_code', $orderId)->first();

        if (! $booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $transactionStatus = $request->input('transaction_status');
        $fraudStatus = $request->input('fraud_status');

        if ($transactionStatus === 'capture') {
            if ($fraudStatus === 'accept') {
                $booking->update([
                    'payment_status' => 'paid',
                    'status' => 'confirmed',
                    'paid_at' => now(),
                ]);
                // Kirim notifikasi ke pengguna
                $booking->user->notify(new BookingConfirmedNotification($booking));
            }
        } elseif ($transactionStatus === 'settlement') {
            $booking->update([
                'payment_status' => 'paid',
                'status' => 'confirmed',
                'paid_at' => now(),
            ]);
            // Kirim notifikasi ke pengguna
            $booking->user->notify(new BookingConfirmedNotification($booking));
        } elseif (in_array($transactionStatus, ['cancel', 'deny'])) {
            $booking->update(['payment_status' => 'failed']);
        } elseif ($transactionStatus === 'expire') {
            $booking->update(['payment_status' => 'expired', 'status' => 'cancelled']);
        } elseif ($transactionStatus === 'pending') {
            $booking->update(['payment_status' => 'unpaid']);
        }

        return response()->json(['message' => 'OK']);
    }
}
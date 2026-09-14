<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createSnapToken(Booking $booking): string
    {
        $params = [
            'transaction_details' => [
                'order_id' => $booking->booking_code,
                'gross_amount' => (int) $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $booking->user->name,
                'email' => $booking->user->email,
                'phone' => $booking->phone,
            ],
            'item_details' => [[
                'id' => 'trip-' . $booking->trip_id,
                'price' => (int) $booking->trip->price,
                'quantity' => $booking->participants,
                'name' => Str::limit($booking->trip->name, 50),
            ]],
        ];

        $snapToken = Snap::getSnapToken($params);

        $booking->update(['snap_token' => $snapToken]);

        return $snapToken;
    }
}

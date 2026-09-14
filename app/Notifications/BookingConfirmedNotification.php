<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingConfirmedNotification extends Notification
{
    use Queueable;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via(object $notifiable): array
    {
        return ['database']; // Menyimpan ke database agar muncul di lonceng UI
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Pesanan Dikonfirmasi! 🎉',
            'message' => 'Pembayaran untuk kode booking ' . $this->booking->booking_code . ' telah berhasil dikonfirmasi. Sampai jumpa di trip nanti!',
            'booking_code' => $this->booking->booking_code,
            'status' => 'confirmed'
        ];
    }
}
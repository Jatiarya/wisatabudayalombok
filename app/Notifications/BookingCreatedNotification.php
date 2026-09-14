<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingCreatedNotification extends Notification
{
    use Queueable;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via(object $notifiable): array
    {
        // Menyimpan notifikasi ke dalam database
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        // Data ini yang akan dipanggil di Blade Anda via $notification->data['title']
        return [
            'title' => 'Pesanan Berhasil Dibuat!',
            'message' => 'Kode booking Anda ' . $this->booking->booking_code . ' menunggu pembayaran.',
            'booking_code' => $this->booking->booking_code,
        ];
    }
}
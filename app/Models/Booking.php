<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    protected $fillable = [
        'booking_code',
        'user_id',
        'trip_id',
        'departure_date',
        'participants',
        'total_price',
        'phone',
        'notes',
        'status',
        'snap_token',
        'payment_status',
        'paid_at',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'total_price' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public static function generateCode(): string
    {
        do {
            $code = 'BKG-' . strtoupper(Str::random(6));
        } while (static::where('booking_code', $code)->exists());

        return $code;
    }
}

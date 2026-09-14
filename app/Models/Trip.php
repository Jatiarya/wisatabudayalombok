<?php

namespace App\Models;

use App\Models\Concerns\HasReviews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory, HasReviews;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'duration_days',
        'duration_nights',
        'thumbnail',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function itineraries()
    {
        return $this->hasMany(TripItinerary::class)->orderBy('day_number');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

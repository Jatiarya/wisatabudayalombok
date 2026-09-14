<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripItinerary extends Model
{
    protected $fillable = ['trip_id', 'destination_id', 'day_number', 'title', 'description'];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}

<?php

namespace App\Models;

use App\Models\Concerns\HasReviews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory, HasReviews;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'address',
        'latitude',
        'longitude',
        'thumbnail',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(DestinationImage::class)->orderBy('sort_order');
    }

    public function itineraries()
    {
        return $this->hasMany(TripItinerary::class);
    }
}

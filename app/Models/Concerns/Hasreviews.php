<?php

namespace App\Models\Concerns;

use App\Models\Review;

trait HasReviews
{
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable')->latest();
    }

    public function approvedReviews()
    {
        return $this->reviews()->approved();
    }

    public function averageRating(): float
    {
        return round($this->approvedReviews()->avg('rating') ?? 0, 1);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id', 'reviewable_id', 'reviewable_type', 'name', 'rating', 'comment', 'is_approved'];

    protected $casts = [
        'is_approved' => 'boolean',
        'rating' => 'integer',
    ];

    public function reviewable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }
}

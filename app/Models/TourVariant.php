<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourVariant extends Model
{
    protected $fillable = ['tour_id', 'label', 'duration_minutes', 'price_per_person_cents','currency',];

    public function tour(): BelongsTo {
        return $this->belongsTo(Tour::class);
    }

    public function getPricePerPersonAttribute(): string {
        return number_format($this->price_per_person_cents / 100 ,2);
    }
}

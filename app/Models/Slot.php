<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Slot extends Model
{
    protected $fillable = [
        'tour_variant_id',
        'starts_at',
        'min_people',
        'max_people',
        'booking_cutoff_hours',
        'cancel_cutoff_hours',
        'status',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
    ];

    public function variant(): BelongsTo
    {
        return $this->belongsTo(TourVariant::class, 'tour_variant_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function confirmedSeats(): int
    {
        return (int) $this->bookings()
            ->whereIn('status', ['paid', 'confirmed'])
            ->sum('people_count');
    }

    public function remainingSeats(): int
    {
        return max(0, (int) $this->max_people - $this->confirmedSeats());
    }
}

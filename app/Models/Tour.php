<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tour extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'highlights', 'meeting_point', 'is_active'];

    public function variants(): HasMany
    {
        return $this->hasMany(TourVariant::class);
    }

    public function media(): MorphtoMany {
        return $this->MorphToMany(Media::class, 'mediable','mediables')
            ->withPivot(['role','sort_order'])
            ->withTimestamps()
            ->orderBy('mediables.sort_order');
    }

    public function coverImage(): MorphToMany {
        return $this->media()->wherePivot('role','cover');
    }

    public function galleryImages(): MorphToMany {
        return $this->media()->wherePivot('role','gallery');
    }
    public function getCoverMediaAttribute(): ?Media
    {
        // first cover by sort_order
        return $this->coverImage->sortBy('pivot.sort_order')->first()
            ?? $this->media->where('pivot.role', 'cover')->sortBy('pivot.sort_order')->first();
    }

    public function getCoverUrlAttribute(): ?string
    {
        $m = $this->cover_media;
        return $m ? asset('storage/' . ltrim($m->file_path, '/')) : null;
    }
    public function getStartingFromCentsAttribute(): ?int
    {
        if (! $this->relationLoaded('variants')) {
            return null;
        }

        $min = $this->variants->min('price_per_person_cents');
        return $min !== null ? (int) $min : null;
    }

    public function getStartingFromFormattedAttribute(): ?string
    {
        $cents = $this->starting_from_cents;
        if ($cents === null) return null;

        return '€' . number_format($cents / 100, 2);
    }
}

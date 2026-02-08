<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\morphToMany;

class Tour extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'highlights', 'meeting_point', 'is_active'];

    public function variants(): HasMany
    {
        return $this->hasMany(TourVariant::class);
    }

    public function media(): MorphtoMany {
        return $this->morphToMany(Media::class, 'mediable','mediables')->withPivot(['role','sort_order'])
            ->withTimestamps()
            ->orderBy('mediables.sort_order');
    }

    public function coverImage(): MorphToMany {
        return $this->media()->wherePivot('role','cover');
    }

    public function galleryImages(): MorphToMany {
        return $this->media()->wherePivot('role','gallery');
    }
}

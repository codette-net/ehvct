<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphedByMany;
use App\Models\Tour;

class Media extends Model
{
    protected $fillable = ['file_path', 'title', 'alt_text','caption','credits',];

    public function tours(): MorphedByMany {
        return $this->morphedByMany(Tour::class, 'mediable', 'mediables')
            ->withPivot(['role', 'sort_order'])->withTimestamps();
    }

    public function getUrlAttribute(): string {
        return asset('storage/' . ltrim($this->file_path,'/'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Tour;

class TourPublicController extends Controller
{
    public function index()
    {
        $tours = Tour::query()
            ->where('is_active', true)
            ->orderBy('title')
            ->get();

        return view('tours.index', compact('tours'));
    }

    public function show(Tour $tour)
    {
        abort_unless($tour->is_active, 404);

        $tour->load([
            'variants' => function ($query) {
            $query->orderBy('id');
            },
            'variants.slots' => function ($query) {
            $query->where('status', 'active')
            ->where('starts_at', '>=', now())
            ->orderBy('starts_at')
            ->limit(20);
            },
            'media',
        ]);

        return view('tours.show', compact('tour'));
    }
}

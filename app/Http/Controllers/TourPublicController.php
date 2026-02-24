<?php

namespace App\Http\Controllers;

use App\Models\Tour;

class TourPublicController extends Controller
{
    public function index()
    {
        $tours = Tour::query()
            ->where('is_active', true)
            ->with([
                'variants:id,tour_id,price_per_person_cents,currency,label',
                'coverImage' => function ($q) {
                    $q->orderBy('mediables.sort_order');
                },
            ])
            ->orderBy('id')
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

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

        return view('pages.tours.index', compact('tours'));
    }

    public function show(Tour $tour)
    {
        abort_unless($tour->is_active, 404);

        $tour->load([
            'variants',
            'media',
        ]);

        return view('pages.tours.show', compact('tour'));
    }
}

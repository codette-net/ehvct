<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Slot;

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

        $upcomingTours = Tour::query()
            ->where('is_active', true)

            ->whereHas('variants.slots', function ($query) {
                $query->where('status', 'active')
                    ->where('starts_at', '>=', now());
            })

            ->select('tours.*')
            ->selectSub(
                Slot::query()
                    ->join('tour_variants', 'tour_variants.id', '=', 'slots.tour_variant_id')
                    ->whereColumn('tour_variants.tour_id', 'tours.id')
                    ->where('slots.status', 'active')
                    ->where('slots.starts_at', '>=', now())
                    ->selectRaw('MIN(slots.starts_at)'),
                'next_slot_at'
            )

            ->with([
                'variants:id,tour_id,price_per_person_cents,currency,label',
                'coverImage' => function ($q) {
                    $q->orderBy('mediables.sort_order');
                },
                'variants.slots' => function ($query) {
                    $query->where('status', 'active')
                        ->where('starts_at', '>=', now())
                        ->orderBy('starts_at')
                        ->limit(20);
                },
            ])

            ->orderBy('next_slot_at')
            ->limit(6)
            ->get();

        return view('tours.index', compact('tours', 'upcomingTours'));
    }

    public function show(Tour $tour)
    {
        abort_unless($tour->is_active, 404);

        $tour->load([
            'variants' => function ($query) {
            $query->orderBy('id');
            },
            'coverImage' => function ($q) {
                $q->orderBy('mediables.sort_order');
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

    public function toursForHome() {
        $tours = Tour::query()
            ->where('is_active', true)

            ->whereHas('variants.slots', function ($query) {
                $query->where('status', 'active')
                    ->where('starts_at', '>=', now());
            })

            ->select('tours.*')
            ->selectSub(
                Slot::query()
                    ->join('tour_variants', 'tour_variants.id', '=', 'slots.tour_variant_id')
                    ->whereColumn('tour_variants.tour_id', 'tours.id')
                    ->where('slots.status', 'active')
                    ->where('slots.starts_at', '>=', now())
                    ->selectRaw('MIN(slots.starts_at)'),
                'next_slot_at'
            )

            ->with([
                'variants:id,tour_id,price_per_person_cents,currency,label',
                'coverImage' => function ($q) {
                    $q->orderBy('mediables.sort_order');
                },
                'variants.slots' => function ($query) {
                    $query->where('status', 'active')
                        ->where('starts_at', '>=', now())
                        ->orderBy('starts_at')
                        ->limit(20);
                },
            ])

            ->orderBy('next_slot_at')
            ->limit(3)
            ->get();

        return view('pages.home', compact('tours'));
    }
}

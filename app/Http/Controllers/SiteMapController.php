<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Tour;


class SiteMapController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function __invoke(): Response
    {
        $tours = Tour::query()
            ->where('is_active', true)
            ->get();

        $content = view('seo.sitemap', [
            'tours' => $tours,
        ])->render();

        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
}

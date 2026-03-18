{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ route('home') }}</loc>
    </url>
    <url>
        <loc>{{ route('tours.index') }}</loc>
    </url>
    <url>
        <loc>{{ route('about') }}</loc>
    </url>
    <url>
        <loc>{{ route('impressions') }}</loc>
    </url>
    <url>
        <loc>{{ route('contact.show') }}</loc>
    </url>

    @foreach($tours as $tour)
        <url>
            <loc>{{ route('tours.show', $tour) }}</loc>
            @if($tour->updated_at)
                <lastmod>{{ $tour->updated_at->toAtomString() }}</lastmod>
            @endif
        </url>
    @endforeach
</urlset>

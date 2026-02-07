<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Eindhoven Cycling Tours') }}</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-slate-900">
<header class="border-b">
    <div class="mx-auto max-w-6xl px-4 py-4 flex items-center justify-between">
        <a href="{{ route('home') }}" class="font-semibold">Eindhoven Cycling Tours</a>
        <nav class="flex gap-4 text-sm">
            <a href="{{ route('tours.index') }}">Tours</a>
            <a href="{{ route('impressions') }}">Impressions</a>
            <a href="{{ route('contact') }}">Contact</a>
        </nav>
    </div>
</header>

<main class="mx-auto max-w-6xl px-4 py-8">
    @yield('content')
</main>

<footer class="border-t">
    <div class="mx-auto max-w-6xl px-4 py-6 text-sm text-slate-600">
        © {{ date('Y') }} Eindhoven Cycling Tours
    </div>
</footer>
</body>
</html>

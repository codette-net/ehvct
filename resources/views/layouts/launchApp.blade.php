<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="emerald" class="scroll-smooth">
<head>
    <title>
        @hasSection('title')
            @yield('title') | Eindhoven Cycling Tours
        @else
            Eindhoven Cycling Tours
        @endif
    </title>

       @vite(['resources/css/app.css', 'resources/css/rj-styles.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen relative ">


<main class="mx-auto rj-gradient-sand mask-container">
    @yield('content')
</main>



</body>
</html>

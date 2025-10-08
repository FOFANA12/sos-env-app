<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @hasSection('title')
            @yield('title') - {{ config('app.name') }}
        @else
            {{ config('app.name') }}
        @endif
    </title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}">
    <meta name="theme-color" content="#ffffff">

    @routes
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    {{-- Header --}}
    @include('layouts.partials.header')

    {{-- Contenu --}}
    <div id="app" class="flex-1">
        <main class="h-full px-4 sm:px-6 lg:px-0">
            @yield('content')
        </main>
    </div>

    <div id="global-loader"></div>

    {{-- Footer --}}
    @include('layouts.partials.footer')

    <script>
        window.currentUser = @json(Auth::check() ? new \App\Http\Resources\Auth\UserProfileResource(Auth::user()) : null);
    </script>
    <!-- Alpine.js (global) -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>

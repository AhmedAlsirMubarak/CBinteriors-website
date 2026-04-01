<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ($page ?? null)?->meta_title ?? ($siteSettings['name'] ?? 'CB Interiors') }}</title>

    @if(($page ?? null)?->meta_description)
        <meta name="description" content="{{ $page->meta_description }}">
    @endif

    <link rel="icon" type="image/png" href="{{ asset('/images/black-logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
</head>
<body>

    @include('navbar')

    <main>
        @yield('content')
    </main>

    @include('footer')

    @stack('scripts')
</body>
</html>

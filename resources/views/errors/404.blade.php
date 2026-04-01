<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 — Page Not Found | {{ config('app.name', 'CB Interiors') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('/images/black-logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cb-offwhite">

    @include('navbar')

    <main class="min-h-[70vh] flex items-center justify-center px-5 py-20 sm:py-32">
        <div class="text-center max-w-lg mx-auto">

            {{-- Large 404 --}}
            <p class="font-display text-[8rem] sm:text-[11rem] lg:text-[14rem] font-light leading-none text-cb-black/[0.06] select-none -mb-6 sm:-mb-10">
                404
            </p>

            {{-- Eyebrow --}}
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="w-6 h-px bg-cb-gray-300"></div>
                <span class="font-body text-[0.6rem] tracking-[0.35em] uppercase text-cb-gray-400">Page Not Found</span>
                <div class="w-6 h-px bg-cb-gray-300"></div>
            </div>

            {{-- Heading --}}
            <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl font-light text-cb-black leading-tight mb-4">
                This page doesn't exist
            </h1>

            {{-- Sub --}}
            <p class="font-body text-base text-cb-gray-400 leading-relaxed mb-10">
                The page you're looking for may have been moved, renamed, or is temporarily unavailable.
            </p>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ url('/') }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2
                          bg-cb-black text-white font-body text-sm tracking-widest uppercase
                          px-8 py-3.5 hover:bg-cb-black/80 transition-colors duration-300 touch-manipulation">
                    Back to Home
                </a>
                <a href="{{ route('contact') }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2
                          border border-cb-black text-cb-black font-body text-sm tracking-widest uppercase
                          px-8 py-3.5 hover:bg-cb-black hover:text-white transition-colors duration-300 touch-manipulation">
                    Contact Us
                </a>
            </div>

        </div>
    </main>

    @include('footer')

</body>
</html>

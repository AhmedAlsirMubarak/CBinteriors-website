{{-- components/navbar.blade.php v6 --}}
@php
    $navLinks = [
        ['route' => 'home',           'label' => 'Home'],
        ['route' => 'about',          'label' => 'About'],
        ['route' => 'services.index', 'label' => 'Services'],
        ['route' => 'products.index', 'label' => 'Products'],
        ['route' => 'partners',       'label' => 'Partners'],
        ['route' => 'contact',        'label' => 'Contact'],
    ];
    $socials = [
        'instagram' => ['label' => 'Instagram', 'path' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z'],
        'facebook'  => ['label' => 'Facebook',  'path' => 'M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z'],
        'linkedin'  => ['label' => 'LinkedIn',   'path' => 'M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z'],
    ];
@endphp

<div x-data="{
        scrolled: false,
        open: false,
        init() {
            this.scrolled = window.scrollY > 60;
            window.addEventListener('scroll', () => { this.scrolled = window.scrollY > 60; }, { passive: true });
        },
        toggleMenu(val) {
            this.open = val;
            document.body.style.overflow = val ? 'hidden' : '';
        }
     }"
     style="display:contents">

{{-- ── Desktop / top header ──────────────────────────────── --}}
<header :class="scrolled ? 'bg-cb-offwhite/95 backdrop-blur-md shadow-[0_1px_0_0_rgba(0,0,0,0.06)]' : 'bg-cb-offwhite'"
        class="fixed inset-x-0 top-0 z-50 transition-all duration-500"
        role="banner">

    <div class="max-w-8xl mx-auto px-5 sm:px-8 lg:px-14">
        <div class="flex items-center justify-between h-16 sm:h-20">

            {{-- Logo --}}
            <a href="{{ route('home') }}" aria-label="CB Interiors" class="shrink-0 group">
                <img src="{{ asset('images/black-logo.png') }}" alt="CB Interiors"
                     class="h-10 sm:h-12 w-auto transition-opacity duration-300 group-hover:opacity-60">
            </a>

            {{-- Desktop nav --}}
            <nav class="hidden lg:flex items-center gap-8 xl:gap-10" aria-label="Primary">
                @foreach($navLinks as $link)
                    <a href="{{ route($link['route']) }}"
                       class="nav-link text-xs text-cb-gray-500 hover:text-cb-black
                              {{ request()->routeIs($link['route']) ? 'after:w-full' : 'after:w-0 hover:after:w-full' }}"
                       @if(request()->routeIs($link['route'])) aria-current="page" @endif>
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>

            {{-- Right side: socials + CTA + hamburger --}}
            <div class="flex items-center gap-4">

                {{-- Social icons (desktop only) --}}
                <div class="hidden xl:flex items-center gap-2">
                    @foreach($socials as $key => $social)
                        @php $url = $siteSettings[$key] ?? null; @endphp
                        <a href="{{ $url ?: '#' }}"
                           @if($url) target="_blank" rel="noopener noreferrer" @endif
                           aria-label="{{ $social['label'] }}"
                           class="w-7 h-7 flex items-center justify-center text-cb-gray-400 hover:text-cb-black transition-colors duration-300">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="{{ $social['path'] }}"/>
                            </svg>
                        </a>
                    @endforeach
                </div>

                {{-- Divider (desktop) --}}
                <div class="hidden xl:block w-px h-4 bg-cb-gray-200"></div>

                {{-- CTA button --}}
                <a href="{{ route('contact') }}"
                   class="hidden lg:inline-flex btn-primary text-[0.65rem] px-5 py-2.5">
                    Get in Touch
                </a>

                {{-- Hamburger --}}
                <button @click="toggleMenu(!open)" :aria-expanded="open.toString()" aria-label="Menu"
                        class="lg:hidden w-11 h-11 flex flex-col justify-center items-center gap-1.5 touch-manipulation -mr-2">
                    <span :class="open ? 'rotate-45 translate-y-1.75' : ''"
                          class="block w-5 h-px bg-cb-black transition-all duration-300 origin-center rounded-full"></span>
                    <span :class="open ? 'opacity-0 -translate-x-3' : ''"
                          class="block w-5 h-px bg-cb-black transition-all duration-300 rounded-full"></span>
                    <span :class="open ? '-rotate-45 -translate-y-1.75' : ''"
                          class="block w-5 h-px bg-cb-black transition-all duration-300 origin-center rounded-full"></span>
                </button>
            </div>
        </div>
    </div>
</header>

{{-- ── Mobile full-screen overlay ───────────────────────── --}}
<div x-show="open"
     x-transition:enter="transition duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition duration-200"
     x-transition:leave-end="opacity-0"
     class="lg:hidden fixed inset-0 bg-cb-black flex flex-col overflow-y-auto"
     style="display:none; z-index:9999">

    {{-- Top bar --}}
    <div class="flex items-center justify-between px-5 sm:px-8 h-16 sm:h-20 shrink-0">
        <img src="{{ asset('images/cb-logo.png') }}" alt="CB Interiors" class="h-10 w-auto opacity-90">
        <button @click="toggleMenu(false)" aria-label="Close"
                class="w-11 h-11 flex items-center justify-center text-white/50 hover:text-white transition-colors touch-manipulation">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Links --}}
    <nav class="flex-1 flex flex-col justify-center px-8 sm:px-12">
        @foreach($navLinks as $link)
            <a href="{{ route($link['route']) }}" @click="toggleMenu(false)"
               class="flex items-center justify-between py-5 border-b border-white/8
                      font-display text-3xl sm:text-4xl font-light
                      {{ request()->routeIs($link['route']) ? 'text-white' : 'text-white/60 hover:text-white' }}
                      transition-colors duration-200 group">
                <span>{{ $link['label'] }}</span>
                <svg class="w-5 h-5 text-white/20 group-hover:text-white/50 -rotate-45 group-hover:rotate-0 transition-all duration-300"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        @endforeach
    </nav>

    {{-- Bottom: CTA + socials --}}
    <div class="px-8 sm:px-12 pb-10 pt-6 shrink-0 space-y-6">
        <a href="{{ route('contact') }}" @click="toggleMenu(false)"
           class="block w-full text-center py-4 rounded-full bg-white text-cb-black
                  font-body text-xs tracking-[0.2em] uppercase
                  hover:bg-cb-gray-100 transition-all duration-300 touch-manipulation">
            Get in Touch
        </a>

        {{-- Social icons --}}
        <div class="flex items-center justify-center gap-4">
            @foreach($socials as $key => $social)
                @php $url = $siteSettings[$key] ?? null; @endphp
                <a href="{{ $url ?: '#' }}"
                   @if($url) target="_blank" rel="noopener noreferrer" @endif
                   aria-label="{{ $social['label'] }}"
                   class="w-9 h-9 rounded-full border border-white/15 flex items-center justify-center
                          text-white/40 hover:text-white hover:border-white/40 transition-all duration-300 touch-manipulation">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="{{ $social['path'] }}"/>
                    </svg>
                </a>
            @endforeach
        </div>

        @if(!empty($siteSettings['email']))
            <p class="text-center font-body text-xs text-white/25">{{ $siteSettings['email'] }}</p>
        @endif
    </div>
</div>

</div>{{-- /x-data --}}

<div class="h-16 sm:h-20"></div>

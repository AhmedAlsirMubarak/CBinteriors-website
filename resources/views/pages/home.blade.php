{{-- pages/home.blade.php v3 — Verdance-inspired luxury redesign --}}
@extends('layouts.app')

@push('head')
<style>
@keyframes marquee { from{transform:translateX(0)} to{transform:translateX(-33.333%)} }
</style>
@endpush

@section('content')

{{-- ═══════════════════════════════════════════════════════
     HERO — Split panel: text left · image right
     ═══════════════════════════════════════════════════════ --}}
@php
    $socials = [
        'instagram' => ['label'=>'Instagram','path'=>'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z'],
        'facebook'  => ['label'=>'Facebook', 'path'=>'M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z'],
        'linkedin'  => ['label'=>'LinkedIn',  'path'=>'M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z'],
    ];
@endphp

<section class="relative min-h-[100svh] sm:min-h-screen flex flex-col lg:flex-row bg-cb-offwhite overflow-hidden"
         aria-label="Hero">

    {{-- ── LEFT PANEL ─────────────────────────────────────── --}}
    <div class="relative flex flex-col justify-between w-full lg:w-1/2 px-6 sm:px-10 lg:px-14 xl:px-20
                pt-12 sm:pt-16 pb-10 sm:pb-14 z-10">

        {{-- Studio label --}}
        <p class="font-body text-[0.6rem] tracking-[0.35em] uppercase text-cb-gray-400 opacity-0 animate-fade-in"
           style="animation-delay:150ms;animation-fill-mode:forwards">
            {{ $hs['studio_label'] ?? 'Interior Design Studio · Muscat, Oman' }}
        </p>

        {{-- Headline block --}}
        <div class="my-auto py-10 sm:py-14">
            <h1 class="font-display font-light leading-[1.02] text-cb-black
                       text-[3rem] sm:text-[4rem] lg:text-[4.5rem] xl:text-[5.5rem]
                       opacity-0 animate-slide-in-left"
                style="animation-delay:300ms;animation-fill-mode:forwards">
                {!! nl2br(e($page?->title ?? 'Elevate Your Space')) !!}
            </h1>

            @if($page?->subtitle)
                <p class="mt-4 font-body text-base sm:text-lg text-cb-gray-500 leading-relaxed max-w-md
                          opacity-0 animate-fade-in"
                   style="animation-delay:500ms;animation-fill-mode:forwards">
                    {{ $page->subtitle }}
                </p>
            @else
                <p class="mt-4 font-body text-base text-cb-gray-500 leading-relaxed max-w-sm
                          opacity-0 animate-fade-in"
                   style="animation-delay:500ms;animation-fill-mode:forwards">
                    With meticulous attention to detail, we craft spaces that transform homes into personalised sanctuaries of comfort and style.
                </p>
            @endif

            {{-- CTAs --}}
            <div class="flex flex-wrap gap-3 mt-8 sm:mt-10 opacity-0 animate-fade-up"
                 style="animation-delay:650ms;animation-fill-mode:forwards">
                <a href="{{ route('contact') }}" class="btn-primary touch-manipulation">
                    Get a Quote
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="{{ route('services.index') }}"
                   class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full
                          border border-cb-black/20 text-cb-black font-body text-xs tracking-[0.18em] uppercase
                          hover:bg-cb-black hover:text-white hover:border-cb-black transition-all duration-300 touch-manipulation">
                    Our Services
                </a>
            </div>
        </div>

        {{-- Bottom: social icons + scroll indicator --}}
        <div class="flex items-center justify-between opacity-0 animate-fade-in"
             style="animation-delay:800ms;animation-fill-mode:forwards">

            {{-- Social icons --}}
            <div class="flex items-center gap-3">
                @foreach($socials as $key => $social)
                    @php $url = $siteSettings[$key] ?? null; @endphp
                    <a href="{{ $url ?: '#' }}"
                       @if($url) target="_blank" rel="noopener noreferrer" @endif
                       aria-label="{{ $social['label'] }}"
                       class="w-8 h-8 rounded-full border border-cb-black/15 flex items-center justify-center
                              text-cb-gray-400 hover:text-cb-black hover:border-cb-black/40 transition-all duration-300 touch-manipulation">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="{{ $social['path'] }}"/>
                        </svg>
                    </a>
                @endforeach
            </div>

            {{-- Scroll cue --}}
            <div class="hidden sm:flex flex-col items-center gap-2" aria-hidden="true">
                <span class="font-body text-[0.5rem] tracking-[0.3em] uppercase text-cb-gray-400 [writing-mode:vertical-rl]">Scroll</span>
                <div class="w-px h-10 bg-linear-to-bfrom-cb-gray-300 to-transparent"></div>
            </div>
        </div>
    </div>

    {{-- ── RIGHT PANEL — hero image ───────────────────────── --}}
    <div class="relative w-full lg:w-1/2 min-h-[55vw] sm:min-h-[45vw] lg:min-h-0">
        @if($page?->heroImageUrl())
            <img src="{{ $page->heroImageUrl() }}" alt="CB Interiors"
                 class="absolute inset-0 w-full h-full object-cover">
        @else
            {{-- Decorative fallback --}}
            <div class="absolute inset-0 bg-cb-warm flex items-center justify-center overflow-hidden">
                <div class="absolute inset-0 opacity-[0.04]"
                     style="background-image:linear-gradient(#0C0C0B 1px,transparent 1px),linear-gradient(90deg,#0C0C0B 1px,transparent 1px);background-size:40px 40px"></div>
                <span class="font-display font-light text-cb-black/10 leading-none select-none text-[40vw] lg:text-[22vw]">CB</span>
            </div>
        @endif

        {{-- Subtle overlay gradient on the left edge to blend with left panel --}}
        <div class="absolute inset-y-0 left-0 w-12 bg-linear-to-rfrom-cb-offwhite to-transparent lg:block hidden pointer-events-none"></div>

        {{-- Year badge --}}
        <div class="absolute bottom-6 right-6 sm:bottom-8 sm:right-8">
            <div class="bg-white/90 backdrop-blur-sm rounded-xl px-4 py-3 shadow-sm">
                <p class="font-display text-2xl font-light text-cb-black leading-none">{{ date('Y') }}</p>
                <p class="font-body text-[0.55rem] tracking-[0.3em] uppercase text-cb-gray-400 mt-0.5">Est. Studio</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     ANIMATED COUNTERS (Verdance style)
     ═══════════════════════════════════════════════════════ --}}
<div class="bg-cb-offwhite border-b border-cb-gray-200/60">
    <div class="max-w-8xl mx-auto px-5 sm:px-8 lg:px-14">
        <div class="grid grid-cols-2 lg:grid-cols-4 divide-x divide-cb-gray-200/60">
            @php
                $stats = [
                    ['num' => $hs['stat1_num'] ?? '10',  'suffix' => $hs['stat1_suffix'] ?? '+', 'label' => $hs['stat1_label'] ?? 'Design Awards'],
                    ['num' => $hs['stat2_num'] ?? '250', 'suffix' => $hs['stat2_suffix'] ?? '+', 'label' => $hs['stat2_label'] ?? 'Satisfied Clients'],
                    ['num' => $hs['stat3_num'] ?? '500', 'suffix' => $hs['stat3_suffix'] ?? '+', 'label' => $hs['stat3_label'] ?? 'Projects Completed'],
                    ['num' => $hs['stat4_num'] ?? '15',  'suffix' => $hs['stat4_suffix'] ?? '+', 'label' => $hs['stat4_label'] ?? 'Unique Concepts'],
                ];
            @endphp
            @foreach($stats as $i => $stat)
                <div class="py-8 sm:py-10 px-5 sm:px-8 lg:px-10 animate-on-scroll {{ $i > 1 ? 'border-t border-cb-gray-200/60 lg:border-t-0' : '' }}"
                     style="animation-delay:{{ $i * 80 }}ms">
                    <p class="font-display text-3xl sm:text-4xl lg:text-5xl font-light text-cb-black leading-none mb-1"
                       data-counter="{{ $stat['num'] }}"
                       data-suffix="{{ $stat['suffix'] }}">
                        0{{ $stat['suffix'] }}
                    </p>
                    <p class="font-body text-xs tracking-[0.2em] uppercase text-cb-gray-400">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════
     ABOUT SPLIT — Image + text (Verdance "Where Design Meets Comfort")
     ═══════════════════════════════════════════════════════ --}}
<section class="py-12 sm:py-20 lg:py-28" style="background:#FAFAF7" aria-labelledby="about-home-heading">
    <div class="max-w-8xl mx-auto px-5 sm:px-8 lg:px-14">

        {{-- Label row --}}
        <div class="flex items-center gap-3 mb-10 sm:mb-14 animate-on-scroll">
            <div class="w-6 h-px bg-cb-gray-300"></div>
            <p class="section-label">Interior Design Studio</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 sm:gap-14 lg:gap-20 items-center">

            {{-- Left: bento image cluster --}}
            <div class="animate-on-scroll order-2 lg:order-1">
                <div class="grid grid-cols-3 gap-2 sm:gap-3">
                    {{-- Large main image --}}
                    <div class="col-span-2 row-span-2 overflow-hidden rounded-2xl sm:rounded-3xl aspect-square sm:aspect-auto sm:h-80 lg:h-96 bg-cb-gray-200">
                        @if(!empty($hs['bento_image_main']))
                            <img src="{{ asset('storage/' . $hs['bento_image_main']) }}" alt="CB Interiors studio"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-linear-to-brfrom-cb-gray-100 to-cb-gray-200 flex items-end p-6">
                                <span class="font-display text-6xl text-cb-gray-300 leading-none">CB</span>
                            </div>
                        @endif
                    </div>
                    {{-- Small top-right --}}
                    <div class="overflow-hidden rounded-xl sm:rounded-2xl aspect-square
                                {{ empty($hs['bento_image1']) ? 'bg-cb-offwhite flex items-center justify-center' : '' }}">
                        @if(!empty($hs['bento_image1']))
                            <img src="{{ asset('storage/' . $hs['bento_image1']) }}" alt=""
                                 class="w-full h-full object-cover">
                        @else
                            <div class="text-center px-3">
                                <p class="font-display text-2xl sm:text-3xl font-light text-cb-black">{{ $hs['bento_years'] ?? '10+' }}</p>
                                <p class="font-body text-[0.55rem] tracking-widest uppercase text-cb-gray-500 mt-0.5">Years</p>
                            </div>
                        @endif
                    </div>
                    {{-- Small bottom-right --}}
                    <div class="overflow-hidden rounded-xl sm:rounded-2xl aspect-square
                                {{ empty($hs['bento_image2']) ? 'bg-cb-black flex items-center justify-center' : '' }}">
                        @if(!empty($hs['bento_image2']))
                            <img src="{{ asset('storage/' . $hs['bento_image2']) }}" alt=""
                                 class="w-full h-full object-cover">
                        @else
                            <div class="text-center px-3">
                                <p class="font-display text-xl sm:text-2xl font-light text-white">OMR</p>
                                <p class="font-body text-[0.55rem] tracking-widest uppercase text-white/40 mt-0.5">Oman</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Right: copy --}}
            <div class="order-1 lg:order-2 animate-on-scroll delay-100">
                <h2 id="about-home-heading"
                    class="font-display text-4xl sm:text-5xl lg:text-6xl font-light leading-[1.08] text-cb-black mb-6 sm:mb-8">
                    {{ $hs['about_heading'] ?? 'Where Design' }}<br>
                    <em class="italic text-cb-gray-500">{{ $hs['about_heading_em'] ?? 'Meets Comfort' }}</em>
                </h2>

                <a href="{{ route('contact') }}" class="btn-outline mb-8 sm:mb-10">Get a Quote</a>

                <div class="divider mb-6 sm:mb-8"></div>

                @if(!empty($hs['about_body1']))
                <p class="font-body text-cb-gray-500 leading-relaxed text-sm sm:text-base mb-4 sm:mb-5">
                    {{ $hs['about_body1'] }}
                </p>
                @endif
                @if(!empty($hs['about_body2']))
                <p class="font-body text-cb-gray-500 leading-relaxed text-sm sm:text-base">
                    {{ $hs['about_body2'] }}
                </p>
                @endif

                <div class="mt-8 sm:mt-10">
                    <a href="{{ route('about') }}" class="btn-ghost text-cb-gray-600 hover:text-cb-black">
                        Our Story
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     MARQUEE TICKER
     ═══════════════════════════════════════════════════════ --}}
<div class="py-4 bg-cb-offwhite border-y border-cb-gray-200/60 overflow-hidden" aria-hidden="true">
    <div class="flex whitespace-nowrap" style="animation:marquee 26s linear infinite">
        @php
            $marqueeRaw = $hs['marquee_items'] ?? 'Residential Design,Commercial Interiors,Space Planning,Furniture Curation,Project Management,Bespoke Luxury,Muscat · Oman';
            $items = array_map('trim', explode(',', $marqueeRaw));
        @endphp
        @foreach(array_merge($items,$items,$items) as $item)
            <span class="font-display italic text-cb-gray-400 text-base sm:text-lg px-6 sm:px-8">{{ $item }}</span>
            <span class="font-body text-cb-gray-300 text-xs self-center">·</span>
        @endforeach
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════
     SERVICES — Icon cards on warm cream (Verdance "What we do")
     ═══════════════════════════════════════════════════════ --}}
@if($services->isNotEmpty())
<section class="py-12 sm:py-20 lg:py-28 bg-cb-offwhite" aria-labelledby="services-home-heading">
    <div class="max-w-8xl mx-auto px-5 sm:px-8 lg:px-14">

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 sm:gap-6 mb-12 sm:mb-16">
            <div>
                <div class="flex items-center gap-3 mb-4 animate-on-scroll">
                    <div class="w-6 h-px bg-cb-gray-300"></div>
                    <p class="section-label">What We Do</p>
                </div>
                <h2 id="services-home-heading" class="section-title animate-on-scroll delay-100">
                    {!! nl2br(e($hs['services_heading'] ?? "This Is What\nWe're Best At")) !!}
                </h2>
            </div>
            <a href="{{ route('services.index') }}"
               class="btn-ghost self-start sm:self-auto text-cb-gray-500 animate-on-scroll">
                All Services
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        {{-- Service cards: 1 col → 2 col sm → 3 col lg --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
            @foreach($services as $i => $service)
                <article class="group bg-white rounded-2xl sm:rounded-3xl overflow-hidden
                                transition-all duration-500 hover:shadow-lg hover:-translate-y-0.5
                                animate-on-scroll"
                         style="animation-delay:{{ $i * 80 }}ms">
                    {{-- Image area --}}
                    @if($service->imageUrl())
                        <div class="aspect-4/3 overflow-hidden">
                            <img src="{{ $service->imageUrl() }}" alt="{{ $service->title }}" loading="lazy"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        </div>
                    @else
                        <div class="aspect-4/3 bg-cb-gray-100 flex items-center justify-center">
                            <span class="font-display text-5xl text-cb-gray-200 select-none">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                    @endif

                    {{-- Card body --}}
                    <div class="p-6 sm:p-7">
                        <h3 class="font-display text-xl sm:text-2xl font-light text-cb-black mb-2">{{ $service->title }}</h3>
                        @if($service->short_desc)
                            <p class="font-body text-sm text-cb-gray-500 leading-relaxed mb-5">{{ $service->short_desc }}</p>
                        @endif
                        <a href="{{ route('services.show', $service->slug) }}"
                           class="inline-flex items-center gap-2 font-body text-xs tracking-[0.18em] uppercase text-cb-black
                                  border-b border-cb-gray-300 pb-0.5 hover:border-cb-black transition-colors duration-300 group/link">
                            Learn More
                            <svg class="w-3 h-3 group-hover/link:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════
     GALLERY BENTO GRID (Verdance "More of our work")
     ═══════════════════════════════════════════════════════ --}}
@if($products->isNotEmpty())
<section class="py-12 sm:py-20 lg:py-28" style="background:#FAFAF7" aria-labelledby="gallery-home-heading">
    <div class="max-w-8xl mx-auto px-5 sm:px-8 lg:px-14">

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-10 sm:mb-14">
            <div>
                <div class="flex items-center gap-3 mb-4 animate-on-scroll">
                    <div class="w-6 h-px bg-cb-gray-300"></div>
                    <p class="section-label">Our Work</p>
                </div>
                <h2 id="gallery-home-heading" class="section-title animate-on-scroll delay-100">
                    {{ $hs['work_heading'] ?? 'More of Our Work' }}
                </h2>
            </div>
            <a href="{{ route('products.index') }}"
               class="btn-outline self-start sm:self-auto animate-on-scroll">
                View All
            </a>
        </div>

        {{-- Masonry bento grid --}}
        <div class="grid grid-cols-2 lg:grid-cols-12 gap-3 sm:gap-4 auto-rows-[130px] sm:auto-rows-[180px] lg:auto-rows-[200px]">
            @foreach($products->take(8) as $i => $product)
                @php
                    $spans = [
                        0 => 'col-span-2 lg:col-span-8 row-span-2',   // wide tall
                        1 => 'col-span-1 lg:col-span-4 row-span-1',
                        2 => 'col-span-1 lg:col-span-4 row-span-1',
                        3 => 'col-span-1 lg:col-span-5 row-span-2',
                        4 => 'col-span-1 lg:col-span-4 row-span-1',
                        5 => 'col-span-2 lg:col-span-3 row-span-1',
                        6 => 'col-span-1 lg:col-span-4 row-span-1',
                        7 => 'col-span-1 lg:col-span-8 row-span-1',
                    ];
                    $span = $spans[$i] ?? 'col-span-1 lg:col-span-4 row-span-1';
                @endphp
                <article class="group relative overflow-hidden rounded-2xl sm:rounded-3xl bg-cb-gray-100 {{ $span }}
                                animate-on-scroll"
                         style="animation-delay:{{ $i * 60 }}ms">
                    <a href="{{ route('products.show', $product->slug) }}" class="block w-full h-full">
                        @if($product->primaryImageUrl())
                            <img src="{{ $product->primaryImageUrl() }}" alt="{{ $product->name }}" loading="lazy"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="font-display text-3xl text-cb-gray-200 select-none">CB</span>
                            </div>
                        @endif
                        {{-- Hover overlay with product name --}}
                        <div class="absolute inset-0 bg-linear-to-tfrom-cb-black/70 to-transparent
                                    opacity-0 group-hover:opacity-100 transition-opacity duration-400 flex items-end p-5 sm:p-6">
                            <div>
                                @if($product->category)
                                    <p class="font-body text-[0.6rem] tracking-[0.2em] uppercase text-white/60 mb-1">{{ $product->category->name }}</p>
                                @endif
                                <p class="font-display text-lg sm:text-xl font-light text-white">{{ $product->name }}</p>
                            </div>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════
     TESTIMONIAL — Dark full-bleed (Verdance style)
     ═══════════════════════════════════════════════════════ --}}
<section class="py-12 sm:py-20 lg:py-28 bg-cb-black relative overflow-hidden" aria-label="Testimonial">
    <div class="hidden sm:block absolute inset-0 opacity-[0.04]"
         style="background-image:linear-gradient(#fff 1px,transparent 1px),linear-gradient(90deg,#fff 1px,transparent 1px);background-size:56px 56px"
         aria-hidden="true"></div>

    <div class="relative z-10 max-w-8xl mx-auto px-5 sm:px-8 lg:px-14 animate-on-scroll">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 sm:gap-14 lg:gap-20 items-center">

            {{-- Quote --}}
            <div class="lg:col-span-7">
                <div class="font-display text-6xl sm:text-8xl text-white/10 leading-none mb-2 select-none">&ldquo;</div>
                <blockquote class="font-display text-2xl sm:text-3xl lg:text-4xl font-light text-white leading-relaxed -mt-4 sm:-mt-8 mb-8 sm:mb-10">
                    {{ $hs['testimonial_quote'] ?? 'Working with CB Interiors was a revelation. They transformed our home into a sanctuary we never want to leave.' }}
                </blockquote>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-px bg-white/30"></div>
                    <div>
                        <p class="font-body text-sm text-white font-medium">{{ $hs['testimonial_author'] ?? 'A. Al-Rashid' }}</p>
                        <p class="font-body text-xs text-white/40 tracking-wide">{{ $hs['testimonial_project'] ?? 'Muscat Villa Project' }}</p>
                    </div>
                </div>
            </div>

            {{-- Profile / decoration --}}
            <div class="lg:col-span-5 flex items-center justify-center">
                <div class="relative">
                    <div class="w-40 h-40 sm:w-56 sm:h-56 rounded-full overflow-hidden bg-cb-gray-800 ring-1 ring-white/10">
                        @if(!empty($hs['testimonial_image']))
                            <img src="{{ asset('storage/' . $hs['testimonial_image']) }}"
                                 alt="{{ $hs['testimonial_author'] ?? '' }}"
                                 class="w-full h-full object-cover object-top">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="font-display text-5xl text-white/20 select-none">{{ $hs['testimonial_initials'] ?? 'AR' }}</span>
                            </div>
                        @endif
                    </div>
                    {{-- Star rating --}}
                    <div class="absolute -bottom-4 -right-4 bg-white rounded-2xl px-4 py-2.5 shadow-xl flex items-center gap-1.5">
                        <div class="flex">
                            @for($s = 0; $s < 5; $s++)
                                <svg class="w-3.5 h-3.5 text-cb-gold fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="font-body text-xs font-medium text-cb-black">5.0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════
     OUR CLIENTS
════════════════════════════════════════════════════════ --}}
@if($clients->isNotEmpty())
<section class="py-12 sm:py-20 bg-white overflow-hidden">
    <div class="max-w-8xl mx-auto px-5 sm:px-8 lg:px-14">

        <div class="text-center mb-12 sm:mb-16 animate-on-scroll">
            <div class="flex items-center justify-center gap-3 mb-4">
                <div class="w-6 h-px bg-cb-black/20"></div>
                <p class="section-label">Trusted By</p>
                <div class="w-6 h-px bg-cb-black/20"></div>
            </div>
            <h2 class="font-display text-4xl sm:text-5xl font-light">Our Clients</h2>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-{{ min($clients->count(), 5) }} gap-px bg-cb-gray-100">
            @foreach($clients as $client)
            <div class="bg-white flex items-center justify-center p-8 sm:p-10 group animate-on-scroll"
                 style="transition-delay: {{ $loop->index * 40 }}ms">
                @if($client->logoUrl())
                    @if($client->url)
                        <a href="{{ $client->url }}" target="_blank" rel="noopener" aria-label="{{ $client->name }}">
                            <img src="{{ $client->logoUrl() }}" alt="{{ $client->name }}"
                                 class="max-h-10 max-w-30 w-auto object-contain grayscale opacity-50 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-400">
                        </a>
                    @else
                        <img src="{{ $client->logoUrl() }}" alt="{{ $client->name }}"
                             class="max-h-10 max-w-30 w-auto object-contain grayscale opacity-50 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-400">
                    @endif
                @else
                    <span class="font-body text-sm font-medium text-cb-gray-400 group-hover:text-cb-black transition-colors duration-300">{{ $client->name }}</span>
                @endif
            </div>
            @endforeach
        </div>

        <div class="mt-10 text-center animate-on-scroll">
            <a href="{{ route('partners') }}"
               class="inline-flex items-center gap-2 font-body text-xs tracking-[0.18em] uppercase text-cb-gray-400 hover:text-cb-black transition-colors duration-300">
                View All Partners
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════
     OUR PROCESS
════════════════════════════════════════════════════════ --}}
@if($processSteps->isNotEmpty())
<section class="py-12 sm:py-20 lg:py-28 bg-cb-warm overflow-hidden">
    <div class="max-w-8xl mx-auto px-5 sm:px-8 lg:px-14">

        <div class="flex items-center gap-3 mb-4 animate-on-scroll">
            <div class="w-6 h-px bg-cb-black/20"></div>
            <p class="section-label">How We Work</p>
        </div>
        <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl font-light mb-16 sm:mb-20 animate-on-scroll">
            Our Process
        </h2>

        {{-- Timeline grid --}}
        <div class="relative">
            {{-- Horizontal connector line (desktop) --}}
            <div class="hidden lg:block absolute top-8 left-0 right-0 h-px bg-cb-black/10" aria-hidden="true"></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-{{ min($processSteps->count(), 6) }} gap-10 lg:gap-6">
                @foreach($processSteps as $step)
                <div class="relative animate-on-scroll" style="transition-delay: {{ $loop->index * 80 }}ms">
                    {{-- Step dot --}}
                    <div class="hidden lg:flex w-4 h-4 rounded-full bg-cb-black border-4 border-cb-warm mb-8 relative z-10"></div>

                    {{-- Number --}}
                    <span class="font-display text-5xl sm:text-6xl font-light text-cb-black/10 leading-none select-none block mb-4">
                        {{ str_pad($step->step_number, 2, '0', STR_PAD_LEFT) }}
                    </span>

                    <h3 class="font-body text-sm font-semibold tracking-widest uppercase text-cb-black mb-3">
                        {{ $step->title }}
                    </h3>
                    @if($step->description)
                        <p class="font-body text-sm text-cb-gray-500 leading-relaxed">{{ $step->description }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════
     FAQ ACCORDION (Verdance-style)
     ═══════════════════════════════════════════════════════ --}}
<section class="py-12 sm:py-20 lg:py-28 bg-cb-offwhite" aria-labelledby="faq-heading">
    <div class="max-w-8xl mx-auto px-5 sm:px-8 lg:px-14">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 sm:gap-14 lg:gap-20">

            {{-- Left: heading --}}
            <div class="lg:col-span-5 animate-on-scroll">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-6 h-px bg-cb-gray-300"></div>
                    <p class="section-label">FAQ</p>
                </div>
                <h2 id="faq-heading" class="section-title mb-6 sm:mb-8">
                    Frequently Asked Questions
                </h2>
                <p class="font-body text-cb-gray-500 leading-relaxed text-sm sm:text-base mb-8 sm:mb-10">
                    Can't find what you're looking for? We're happy to answer any questions you might have.
                </p>
                <a href="{{ route('contact') }}" class="btn-primary">Contact Us</a>
            </div>

            {{-- Right: accordion --}}
            <div class="lg:col-span-7 animate-on-scroll delay-100"
                 x-data="{ active: 0 }">
                @php
                    $faqs = [];
                    for ($n = 1; $n <= 5; $n++) {
                        $q = $hs["faq{$n}_q"] ?? null;
                        $a = $hs["faq{$n}_a"] ?? null;
                        if ($q) $faqs[] = ['q' => $q, 'a' => $a ?? ''];
                    }
                @endphp

                <div class="divide-y divide-cb-gray-200">
                    @foreach($faqs as $i => $faq)
                        <div x-data="{ open: {{ $i === 0 ? 'true' : 'false' }} }">
                            <button @click="open = !open; active = {{ $i }}"
                                    class="w-full flex items-center justify-between gap-4 py-5 sm:py-6
                                           text-left font-body text-sm sm:text-base font-medium text-cb-black
                                           hover:text-cb-gray-600 transition-colors duration-200 touch-manipulation">
                                <span>{{ $faq['q'] }}</span>
                                <span :class="open ? 'rotate-45' : ''"
                                      class="shrink-0 w-6 h-6 rounded-full border border-cb-gray-300 flex items-center justify-center
                                             transition-transform duration-300 text-cb-gray-500">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </span>
                            </button>
                            <div x-show="open" x-collapse>
                                <p class="font-body text-sm text-cb-gray-500 leading-relaxed pb-5 sm:pb-6 max-w-prose">
                                    {{ $faq['a'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     CONTACT CTA — Large email-centred footer (Verdance style)
     ═══════════════════════════════════════════════════════ --}}
<section class="py-12 sm:py-20 lg:py-28 bg-cb-black text-white relative overflow-hidden" aria-labelledby="cta-heading">
    <div class="hidden sm:block absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute -right-56 -top-56 w-[600px] h-[600px] rounded-full border border-white/[0.05]"></div>
        <div class="absolute -left-32 -bottom-32 w-[400px] h-[400px] rounded-full border border-white/[0.05]"></div>
    </div>

    <div class="relative z-10 max-w-8xl mx-auto px-5 sm:px-8 lg:px-14">
        <div class="max-w-3xl mx-auto text-center animate-on-scroll">
            <div class="flex items-center justify-center gap-3 mb-6 sm:mb-8">
                <div class="w-6 h-px bg-white/30"></div>
                <p class="section-label text-white/40">Start a Project</p>
                <div class="w-6 h-px bg-white/30"></div>
            </div>

            <h2 id="cta-heading"
                class="font-display text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-light leading-[1.06] mb-8 sm:mb-10">
                {{ $hs['cta_heading'] ?? "Let's Create" }}<br>
                <em class="italic text-white/60">{{ $hs['cta_heading_em'] ?? 'Something Beautiful' }}</em>
            </h2>

            {{-- Large email link (Verdance's centrepiece) --}}
            @if(!empty($siteSettings['email']))
                <a href="mailto:{{ $siteSettings['email'] }}"
                   class="block font-display text-2xl sm:text-3xl lg:text-4xl font-light text-white/70
                          hover:text-white transition-colors duration-300 mb-10 sm:mb-12 break-all">
                    {{ $siteSettings['email'] }}
                </a>
            @endif

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('contact') }}" class="btn-primary bg-white text-cb-black hover:bg-cb-gray-100 w-full sm:w-auto">
                    Send a Message
                </a>
                @if(!empty($siteSettings['phone']))
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['phone']) }}"
                       class="inline-flex items-center gap-2 font-body text-xs tracking-[0.18em] uppercase
                              text-white/50 hover:text-white transition-colors duration-300 touch-manipulation">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        {{ $siteSettings['phone'] }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>





@endsection

@push('scripts')
<script>
// ── Animated counters ─────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('[data-counter]');
    if (!counters.length) return;

    const ease = t => t < 0.5 ? 2*t*t : -1+(4-2*t)*t;

    const animateCounter = (el) => {
        const target = parseInt(el.dataset.counter, 10);
        const suffix = el.dataset.suffix ?? '';
        const duration = 1800;
        const start = performance.now();

        const tick = (now) => {
            const elapsed = Math.min((now - start) / duration, 1);
            const value   = Math.round(ease(elapsed) * target);
            el.textContent = value + suffix;
            if (elapsed < 1) requestAnimationFrame(tick);
            else el.textContent = target + suffix;
        };
        requestAnimationFrame(tick);
    };

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(el => observer.observe(el));
});

// ── Scroll-reveal ────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    const obs = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('is-visible');
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.08, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('.animate-on-scroll').forEach(el => obs.observe(el));
});
</script>
@endpush

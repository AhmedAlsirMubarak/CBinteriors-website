@extends('layouts.app')

@section('content')

{{-- Hero --}}
<section class="relative min-h-[40vh] bg-cb-black flex items-end overflow-hidden pt-16 sm:pt-20"
         aria-label="Services hero">
    @if($page?->heroImageUrl())
        <div class="absolute inset-0">
            <img src="{{ $page->heroImageUrl() }}" alt="" role="presentation"
                 class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-linear-to-t from-cb-black/80 to-transparent"></div>
        </div>
    @endif
    <div class="relative z-10 max-w-8xl mx-auto px-5 sm:px-8 lg:px-14 pb-14 sm:pb-20 w-full">
        <div class="flex items-center gap-3 mb-5">
            <div class="w-6 h-px bg-white/40"></div>
            <p class="font-body text-[0.6rem] tracking-[0.35em] uppercase text-white/50">What We Do</p>
        </div>
        <h1 class="font-display text-4xl sm:text-6xl lg:text-7xl font-light text-white leading-[1.06]">
            {{ $page?->title ?? 'Our Services' }}
        </h1>
        @if($page?->subtitle)
            <p class="mt-4 font-body text-base sm:text-lg text-white/55 max-w-2xl">{{ $page->subtitle }}</p>
        @endif
    </div>
</section>

{{-- Services grid --}}
<section class="py-12 sm:py-20 lg:py-28 bg-[#FAFAF7]">
    <div class="max-w-8xl mx-auto px-5 sm:px-8 lg:px-14">
        @if($services->isEmpty())
            <p class="font-body text-cb-gray-400 text-center py-20">No services available yet.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
                @foreach($services as $i => $service)
                    <article class="group bg-white rounded-2xl sm:rounded-3xl overflow-hidden
                                    transition-all duration-500 hover:shadow-lg hover:-translate-y-0.5
                                    animate-on-scroll"
                             style="animation-delay:{{ $i * 80 }}ms">
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
                        <div class="p-6 sm:p-8">
                            <h2 class="font-display text-xl sm:text-2xl font-light text-cb-black mb-2">{{ $service->title }}</h2>
                            @if($service->short_desc)
                                <p class="font-body text-sm text-cb-gray-500 leading-relaxed mb-5">{{ $service->short_desc }}</p>
                            @endif
                            <a href="{{ route('services.show', $service->slug) }}"
                               class="inline-flex items-center gap-2 font-body text-xs tracking-[0.18em] uppercase text-cb-black
                                      border-b border-cb-gray-300 pb-0.5 hover:border-cb-black transition-colors duration-300 group/link">
                                Learn More
                                <svg class="w-3 h-3 group-hover/link:translate-x-0.5 transition-transform"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>

@endsection

@extends('layouts.app')

@section('content')

{{-- Hero --}}
<section class="relative min-h-[45vh] bg-cb-black flex items-end overflow-hidden pt-16 sm:pt-20"
         aria-label="Service hero">
    @if($service->imageUrl())
        <div class="absolute inset-0">
            <img src="{{ $service->imageUrl() }}" alt="" role="presentation"
                 class="w-full h-full object-cover opacity-35">
            <div class="absolute inset-0 bg-gradient-to-t from-cb-black/80 via-transparent to-transparent"></div>
        </div>
    @endif
    <div class="relative z-10 max-w-8xl mx-auto px-5 sm:px-8 lg:px-14 pb-14 sm:pb-20 w-full">
        <div class="flex items-center gap-3 mb-5">
            <a href="{{ route('services.index') }}"
               class="font-body text-[0.6rem] tracking-[0.35em] uppercase text-white/50 hover:text-white/80 transition-colors">
                ← Services
            </a>
        </div>
        <h1 class="font-display text-4xl sm:text-6xl lg:text-7xl font-light text-white leading-[1.06]">
            {{ $service->title }}
        </h1>
        @if($service->short_desc)
            <p class="mt-4 font-body text-base sm:text-lg text-white/55 max-w-2xl">{{ $service->short_desc }}</p>
        @endif
    </div>
</section>

{{-- Content --}}
<section class="py-20 sm:py-28 lg:py-36 bg-[#FAFAF7]">
    <div class="max-w-5xl mx-auto px-5 sm:px-8 lg:px-14">
        @if($service->description)
            <div class="prose prose-neutral max-w-none font-body text-cb-gray-500 leading-relaxed text-sm sm:text-base animate-on-scroll">
                {!! $service->description !!}
            </div>
        @endif
        <div class="mt-14 pt-10 border-t border-cb-gray-200 flex flex-col sm:flex-row items-start sm:items-center gap-4">
            <a href="{{ route('contact') }}" class="btn-primary">Enquire About This Service</a>
            <a href="{{ route('services.index') }}" class="btn-ghost text-cb-gray-500">
                All Services
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

@endsection

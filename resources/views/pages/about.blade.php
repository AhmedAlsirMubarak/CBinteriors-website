@extends('layouts.app')

@section('content')

{{-- Hero --}}
<section class="relative min-h-[45vh] sm:min-h-[55vh] bg-cb-black flex items-end overflow-hidden pt-16 sm:pt-20"
         aria-label="About hero">
    @if($page?->heroImageUrl())
        <div class="absolute inset-0">
            <img src="{{ $page->heroImageUrl() }}" alt="" role="presentation"
                 class="w-full h-full object-cover opacity-35">
            <div class="absolute inset-0 bg-linear-to-t from-cb-black/80 via-transparent to-transparent"></div>
        </div>
    @endif
    <div class="relative z-10 max-w-8xl mx-auto px-5 sm:px-8 lg:px-14 pb-14 sm:pb-20 w-full">
        <div class="flex items-center gap-3 mb-5">
            <div class="w-6 h-px bg-white/40"></div>
            <p class="font-body text-[0.6rem] tracking-[0.35em] uppercase text-white/50">About Us</p>
        </div>
        <h1 class="font-display text-4xl sm:text-6xl lg:text-7xl font-light text-white leading-[1.06]">
            {{ $page?->title ?? 'About CB Interiors' }}
        </h1>
        @if($page?->subtitle)
            <p class="mt-4 font-body text-base sm:text-lg text-white/55 max-w-2xl">{{ $page->subtitle }}</p>
        @endif
    </div>
</section>

{{-- Story --}}
<section class="py-12 sm:py-20 lg:py-28 bg-[#FAFAF7]">
    <div class="max-w-8xl mx-auto px-5 sm:px-8 lg:px-14">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 lg:gap-24 items-start">

            {{-- Text --}}
            <div class="animate-on-scroll">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-6 h-px bg-cb-gray-300"></div>
                    <p class="section-label">Our Story</p>
                </div>
                @if($page?->body)
                    <div class="prose prose-neutral max-w-none font-body text-cb-gray-500 leading-relaxed">
                        {!! $page->body !!}
                    </div>
                @else
                    <p class="font-body text-cb-gray-500 leading-relaxed text-sm sm:text-base mb-5">
                        Founded with a belief that great design transforms lives, CB Interiors has been creating bespoke spaces across Oman. Our team brings together architecture, art, and craftsmanship to deliver environments that are both beautiful and deeply personal.
                    </p>
                    <p class="font-body text-cb-gray-500 leading-relaxed text-sm sm:text-base">
                        With meticulous attention to detail, we craft spaces that transform homes into personalised sanctuaries of comfort and style.
                    </p>
                @endif
                <div class="mt-10">
                    <a href="{{ route('contact') }}" class="btn-primary">Get in Touch</a>
                </div>
            </div>

            {{-- Stats --}}
            @php
                $pm = $page?->meta ?? [];
                $aboutStats = [
                    ['value' => $pm['stat1_value'] ?? '10+',  'label' => $pm['stat1_label'] ?? 'Years of Excellence'],
                    ['value' => $pm['stat2_value'] ?? '250+', 'label' => $pm['stat2_label'] ?? 'Satisfied Clients'],
                    ['value' => $pm['stat3_value'] ?? '500+', 'label' => $pm['stat3_label'] ?? 'Projects Completed'],
                    ['value' => $pm['stat4_value'] ?? '15+',  'label' => $pm['stat4_label'] ?? 'Design Awards'],
                ];
            @endphp
            <div class="grid grid-cols-2 gap-4 animate-on-scroll delay-100">
                @foreach($aboutStats as $stat)
                    <div class="bg-white rounded-2xl p-7 sm:p-8">
                        <p class="font-display text-4xl sm:text-5xl font-light text-cb-black mb-1">{{ $stat['value'] }}</p>
                        <p class="font-body text-xs tracking-[0.2em] uppercase text-cb-gray-400">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ── Team ──────────────────────────────────────────────── --}}
@if($team->isNotEmpty())
<section class="bg-white overflow-hidden">
    <div class="max-w-8xl mx-auto px-5 sm:px-8 lg:px-14 py-12 sm:py-20">
        <div class="flex items-center gap-3 mb-4 animate-on-scroll">
            <div class="w-6 h-px bg-cb-black/20"></div>
            <p class="section-label">The People Behind the Work</p>
        </div>
        <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-light text-cb-black mb-10 sm:mb-14 animate-on-scroll">
            Meet the Team
        </h2>
    </div>

    <div class="space-y-0">
        @foreach($team as $member)
        <div class="grid grid-cols-1 lg:grid-cols-2 animate-on-scroll {{ !$loop->last ? 'border-b border-cb-gray-100' : '' }}">

            {{-- Photo — alternates left/right --}}
            <div class="{{ $loop->even ? 'lg:order-last' : '' }} relative overflow-hidden bg-cb-warm min-h-[280px] sm:min-h-[400px] lg:min-h-[520px]">
                @if($member->photoUrl())
                    <img src="{{ $member->photoUrl() }}" alt="{{ $member->name }}"
                         class="absolute inset-0 w-full h-full object-cover object-top">
                @else
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="font-display font-light text-cb-black/10" style="font-size:15vw">
                            {{ strtoupper(substr($member->name, 0, 1)) }}
                        </span>
                    </div>
                @endif
            </div>

            {{-- Text --}}
            <div class="flex flex-col justify-center px-6 sm:px-10 lg:px-16 xl:px-20 py-10 sm:py-16 bg-cb-offwhite">
                <p class="font-body text-[0.6rem] tracking-[0.35em] uppercase text-cb-gray-400 mb-5">
                    {{ $member->role ?? 'Team Member' }}
                </p>
                <h3 class="font-display text-3xl sm:text-4xl lg:text-5xl font-light text-cb-black leading-[1.06] mb-6">
                    Meet<br><span class="italic text-cb-gray-400">{{ $member->name }}</span>
                </h3>
                @if($member->bio)
                    <p class="font-body text-sm sm:text-base text-cb-gray-500 leading-relaxed max-w-lg">
                        {{ $member->bio }}
                    </p>
                @endif
            </div>

        </div>
        @endforeach
    </div>
</section>
@endif

{{-- CTA --}}
<section class="py-12 sm:py-20 bg-cb-black">
    <div class="max-w-8xl mx-auto px-5 sm:px-8 lg:px-14 text-center">
        <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl font-light text-white mb-6">
            Ready to Transform<br><em class="italic text-white/50">Your Space?</em>
        </h2>
        <a href="{{ route('contact') }}" class="btn-primary bg-white text-cb-black hover:bg-cb-gray-100 mt-4">
            Start a Project
        </a>
    </div>
</section>

@endsection

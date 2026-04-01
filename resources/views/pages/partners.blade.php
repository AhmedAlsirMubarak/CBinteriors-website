@extends('layouts.app')
@section('title', ($page?->meta_title ?: ($page?->title ? $page->title . ' — CB Interiors' : 'Our Partners — CB Interiors')))

@section('content')

{{-- ── Hero ──────────────────────────────────────────────── --}}
<section class="py-14 sm:py-20 lg:py-28 bg-cb-warm">
    <div class="max-w-8xl mx-auto px-5 sm:px-8 lg:px-14">
        <div class="max-w-2xl animate-on-scroll">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-6 h-px bg-cb-black/20"></div>
                <p class="section-label text-cb-gray-500">Who We Work With</p>
            </div>
            <h1 class="font-display text-5xl sm:text-6xl lg:text-7xl font-light leading-[1.06]">
                {{ $page?->title ?? 'Our Partners' }}
            </h1>
            @if($page?->subtitle)
            <p class="mt-6 font-body text-sm text-cb-gray-500 leading-relaxed max-w-lg">
                {{ $page->subtitle }}
            </p>
            @endif
        </div>
    </div>
</section>

{{-- ── Clients grid ─────────────────────────────────────── --}}
<section class="py-12 sm:py-20 lg:py-28 bg-white">
    <div class="max-w-8xl mx-auto px-5 sm:px-8 lg:px-14">

        @if($clients->isNotEmpty())
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-px bg-cb-gray-100">
                @foreach($clients as $client)
                <div class="bg-white flex flex-col items-center justify-center gap-3 p-6 sm:p-10 group animate-on-scroll"
                     style="transition-delay: {{ $loop->index * 50 }}ms">
                    @if($client->logoUrl())
                        @if($client->url)
                            <a href="{{ $client->url }}" target="_blank" rel="noopener" aria-label="{{ $client->name }}">
                                <img src="{{ $client->logoUrl() }}" alt="{{ $client->name }}"
                                     class="max-h-10 max-w-22.5 sm:max-h-12 sm:max-w-36 w-auto object-contain grayscale opacity-50 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-400">
                            </a>
                        @else
                            <img src="{{ $client->logoUrl() }}" alt="{{ $client->name }}"
                                 class="max-h-10 max-w-22.5 sm:max-h-12 sm:max-w-36 w-auto object-contain grayscale opacity-50 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-400">
                        @endif
                    @else
                        <span class="font-body text-base font-medium text-cb-gray-400 group-hover:text-cb-black transition-colors duration-300 text-center">{{ $client->name }}</span>
                    @endif
                    <p class="font-body text-xs text-cb-gray-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-center">{{ $client->name }}</p>
                </div>
                @endforeach
            </div>
        @else
            <p class="text-center font-body text-sm text-cb-gray-400 py-20">No clients to display yet.</p>
        @endif

    </div>
</section>

{{-- ── CTA ───────────────────────────────────────────────── --}}
<section class="py-12 sm:py-20 bg-cb-black text-white text-center">
    <div class="max-w-2xl mx-auto px-5 sm:px-8 animate-on-scroll">
        <h2 class="font-display text-4xl sm:text-5xl font-light mb-6">
            Join Our <em class="italic text-white/50">Client List</em>
        </h2>
        <p class="font-body text-sm text-white/50 leading-relaxed mb-10">
            Ready to transform your space? Let's start a conversation.
        </p>
        <a href="{{ route('contact') }}" class="btn-primary bg-white text-cb-black hover:bg-cb-gray-100">
            Get in Touch
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const obs = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('is-visible'); obs.unobserve(e.target); }
        });
    }, { threshold: 0.08, rootMargin: '0px 0px -50px 0px' });
    document.querySelectorAll('.animate-on-scroll').forEach(el => obs.observe(el));
});
</script>
@endpush

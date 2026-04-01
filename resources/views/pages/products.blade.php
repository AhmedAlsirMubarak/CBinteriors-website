@extends('layouts.app')

@section('content')

{{-- Hero --}}
<section class="relative min-h-[40vh] bg-cb-black flex items-end overflow-hidden pt-16 sm:pt-20"
         aria-label="Products hero">
    @if($page?->heroImageUrl())
        <div class="absolute inset-0">
            <img src="{{ $page->heroImageUrl() }}" alt="" role="presentation"
                 class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-gradient-to-t from-cb-black/80 to-transparent"></div>
        </div>
    @endif
    <div class="relative z-10 max-w-8xl mx-auto px-5 sm:px-8 lg:px-14 pb-14 sm:pb-20 w-full">
        <div class="flex items-center gap-3 mb-5">
            <div class="w-6 h-px bg-white/40"></div>
            <p class="font-body text-[0.6rem] tracking-[0.35em] uppercase text-white/50">Collection</p>
        </div>
        <h1 class="font-display text-4xl sm:text-6xl lg:text-7xl font-light text-white leading-[1.06]">
            {{ $page?->title ?? 'Our Products' }}
        </h1>
        @if($page?->subtitle)
            <p class="mt-4 font-body text-base sm:text-lg text-white/55 max-w-2xl">{{ $page->subtitle }}</p>
        @endif
    </div>
</section>

{{-- Filters + Grid --}}
<section class="py-16 sm:py-24 lg:py-32 bg-[#FAFAF7]">
    <div class="max-w-8xl mx-auto px-5 sm:px-8 lg:px-14">

        {{-- Category filter --}}
        @if($categories->isNotEmpty())
            <div class="flex flex-wrap gap-2 sm:gap-3 mb-12 sm:mb-16">
                <a href="{{ route('products.index') }}"
                   class="pill {{ !request('category') ? 'bg-cb-black text-white' : '' }} transition-colors duration-200 hover:bg-cb-black hover:text-white">
                    All
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('products.index', ['category' => $cat->slug]) }}"
                       class="pill {{ request('category') === $cat->slug ? 'bg-cb-black text-white' : '' }} transition-colors duration-200 hover:bg-cb-black hover:text-white">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        @endif

        {{-- Products grid --}}
        @if($products->isEmpty())
            <p class="font-body text-cb-gray-400 text-center py-20">No products found.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-5">
                @foreach($products as $i => $product)
                    <article class="group animate-on-scroll" style="animation-delay:{{ ($i % 8) * 60 }}ms">
                        <a href="{{ route('products.show', $product->slug) }}" class="block">
                            <div class="relative aspect-[3/4] overflow-hidden rounded-xl sm:rounded-2xl bg-cb-gray-100 mb-4">
                                @if($product->primaryImageUrl())
                                    <img src="{{ $product->primaryImageUrl() }}" alt="{{ $product->name }}" loading="lazy"
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="font-display text-5xl text-cb-gray-200">CB</span>
                                    </div>
                                @endif
                                <div class="img-overlay rounded-xl sm:rounded-2xl"></div>
                            </div>
                            <div class="px-1">
                                @if($product->category)
                                    <p class="font-body text-[0.6rem] tracking-[0.3em] uppercase text-cb-gray-400 mb-1">{{ $product->category->name }}</p>
                                @endif
                                <h2 class="font-display text-lg sm:text-xl font-light text-cb-black group-hover:opacity-70 transition-opacity duration-300 mb-1">
                                    {{ $product->name }}
                                </h2>
                                <p class="font-body text-sm text-cb-gray-500">{{ $product->formattedPrice() }}</p>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($products->hasPages())
                <div class="mt-16 flex justify-center">
                    {{ $products->links() }}
                </div>
            @endif
        @endif
    </div>
</section>

@endsection

@extends('layouts.app')

@section('content')

<div class="pt-16 sm:pt-20 bg-[#FAFAF7] min-h-screen">
    <div class="max-w-8xl mx-auto px-5 sm:px-8 lg:px-14 py-14 sm:py-20">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 mb-10 font-body text-xs tracking-[0.2em] uppercase text-cb-gray-400">
            <a href="{{ route('products.index') }}" class="hover:text-cb-black transition-colors">Products</a>
            @if($product->category)
                <span>/</span>
                <a href="{{ route('products.index', ['category' => $product->category->slug]) }}"
                   class="hover:text-cb-black transition-colors">{{ $product->category->name }}</a>
            @endif
            <span>/</span>
            <span class="text-cb-black">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 xl:gap-24">

            {{-- Images --}}
            <div class="animate-on-scroll" x-data="{ active: 0 }">
                @php $images = $product->allImageUrls(); @endphp
                @if(count($images))
                    <div class="aspect-[4/3] overflow-hidden rounded-2xl sm:rounded-3xl bg-cb-gray-100 mb-3">
                        @foreach($images as $idx => $url)
                            <img src="{{ $url }}" alt="{{ $product->name }}"
                                 x-show="active === {{ $idx }}"
                                 class="w-full h-full object-cover">
                        @endforeach
                    </div>
                    @if(count($images) > 1)
                        <div class="flex gap-2 overflow-x-auto scrollbar-none">
                            @foreach($images as $idx => $url)
                                <button @click="active = {{ $idx }}"
                                        :class="active === {{ $idx }} ? 'ring-2 ring-cb-black' : 'opacity-60'"
                                        class="shrink-0 w-16 h-16 rounded-lg overflow-hidden transition-all duration-200">
                                    <img src="{{ $url }}" alt="" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="aspect-[4/3] rounded-2xl sm:rounded-3xl bg-cb-gray-100 flex items-center justify-center">
                        <span class="font-display text-7xl text-cb-gray-200">CB</span>
                    </div>
                @endif
            </div>

            {{-- Details --}}
            <div class="animate-on-scroll delay-100">
                @if($product->category)
                    <p class="font-body text-[0.6rem] tracking-[0.35em] uppercase text-cb-gray-400 mb-3">{{ $product->category->name }}</p>
                @endif
                <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl font-light text-cb-black mb-4 leading-[1.1]">
                    {{ $product->name }}
                </h1>
                <p class="font-display text-2xl sm:text-3xl font-light text-cb-black mb-8">
                    {{ $product->formattedPrice() }}
                </p>
                <div class="divider mb-8"></div>
                @if($product->description)
                    <div class="prose prose-neutral max-w-none font-body text-cb-gray-500 leading-relaxed text-sm sm:text-base mb-10">
                        {!! $product->description !!}
                    </div>
                @endif
                <a href="{{ route('contact') }}" class="btn-primary">Enquire About This Product</a>
            </div>
        </div>

        {{-- Related products --}}
        @if($related->isNotEmpty())
            <div class="mt-24 sm:mt-32">
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-6 h-px bg-cb-gray-300"></div>
                    <p class="section-label">You May Also Like</p>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
                    @foreach($related as $i => $rel)
                        <article class="group animate-on-scroll" style="animation-delay:{{ $i * 80 }}ms">
                            <a href="{{ route('products.show', $rel->slug) }}" class="block">
                                <div class="relative aspect-[3/4] overflow-hidden rounded-xl sm:rounded-2xl bg-cb-gray-100 mb-3">
                                    @if($rel->primaryImageUrl())
                                        <img src="{{ $rel->primaryImageUrl() }}" alt="{{ $rel->name }}" loading="lazy"
                                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="font-display text-4xl text-cb-gray-200">CB</span>
                                        </div>
                                    @endif
                                    <div class="img-overlay rounded-xl sm:rounded-2xl"></div>
                                </div>
                                <h3 class="font-display text-base sm:text-lg font-light text-cb-black group-hover:opacity-70 transition-opacity mb-1">
                                    {{ $rel->name }}
                                </h3>
                                <p class="font-body text-sm text-cb-gray-500">{{ $rel->formattedPrice() }}</p>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

@endsection

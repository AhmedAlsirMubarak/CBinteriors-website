@extends('layouts.app')

@section('content')

<div class="pt-16 sm:pt-20 bg-[#FAFAF7] min-h-screen">
    <div class="max-w-3xl mx-auto px-5 sm:px-8 py-10 sm:py-16 lg:py-24">

        <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl font-light text-cb-black mb-4 leading-[1.08]">
            {{ $page->title }}
        </h1>
        @if($page->subtitle)
            <p class="font-body text-cb-gray-500 text-base sm:text-lg mb-10">{{ $page->subtitle }}</p>
        @endif

        <div class="divider mb-10"></div>

        @if($page->body)
            <div class="prose prose-neutral max-w-none font-body text-cb-gray-500 leading-relaxed">
                {!! $page->body !!}
            </div>
        @endif

        <div class="mt-14 pt-10 border-t border-cb-gray-200">
            <a href="{{ route('home') }}" class="btn-ghost text-cb-gray-500">
                ← Back to Home
            </a>
        </div>
    </div>
</div>

@endsection

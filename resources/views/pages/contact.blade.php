@extends('layouts.app')

@section('content')

{{-- Hero --}}
<section class="relative min-h-[35vh] bg-cb-black flex items-end overflow-hidden pt-16 sm:pt-20">
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
            <p class="font-body text-[0.6rem] tracking-[0.35em] uppercase text-white/80">Contact</p>
        </div>
        <h1 class="font-display text-4xl sm:text-6xl lg:text-7xl font-light text-white leading-[1.06]">
            {{ $page?->title ?? 'Get in Touch' }}
        </h1>
        @if($page?->subtitle)
            <p class="mt-4 font-body text-base text-white/55 max-w-xl">{{ $page->subtitle }}</p>
        @endif
    </div>
</section>

{{-- Contact form + info --}}
<section class="py-12 sm:py-20 lg:py-28 bg-[#FAFAF7]">
    <div class="max-w-8xl mx-auto px-5 sm:px-8 lg:px-14">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-20">

            {{-- Form --}}
            <div class="animate-on-scroll">
                @if(session('success'))
                    <div class="mb-8 p-5 rounded-xl bg-white border border-green-200 text-green-800 font-body text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('contact.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-6">

                        <div>
                            <label for="name" class="field-label">Name <span class="text-red-400">*</span></label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}"
                                   class="field-input @error('name') border-red-400 @enderror"
                                   placeholder="Your full name" required>
                            @error('name') <p class="mt-1 font-body text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email" class="field-label">Email <span class="text-red-400">*</span></label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}"
                                   class="field-input @error('email') border-red-400 @enderror"
                                   placeholder="you@example.com" required>
                            @error('email') <p class="mt-1 font-body text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="phone" class="field-label">Phone</label>
                            <input id="phone" name="phone" type="tel" value="{{ old('phone') }}"
                                   class="field-input" placeholder="+968 00 000 000">
                        </div>

                        <div>
                            <label for="subject" class="field-label">Subject</label>
                            <input id="subject" name="subject" type="text" value="{{ old('subject') }}"
                                   class="field-input" placeholder="How can we help?">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="message" class="field-label">Message <span class="text-red-400">*</span></label>
                            <textarea id="message" name="message" rows="5"
                                      class="field-input resize-none @error('message') border-red-400 @enderror"
                                      placeholder="Tell us about your project..." required>{{ old('message') }}</textarea>
                            @error('message') <p class="mt-1 font-body text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <button type="submit" class="btn-primary">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Contact info --}}
            <div class="animate-on-scroll delay-100 flex flex-col gap-10">
                @if(!empty($siteSettings['email']))
                    <div>
                        <p class="field-label mb-3">Email</p>
                        <a href="mailto:{{ $siteSettings['email'] }}"
                           class="font-display text-xl sm:text-2xl font-light text-cb-black hover:opacity-60 transition-opacity">
                            {{ $siteSettings['email'] }}
                        </a>
                    </div>
                @endif
                @if(!empty($siteSettings['phone']))
                    <div>
                        <p class="field-label mb-4">Phone</p>
                        <div class="flex flex-col gap-5">
                            @foreach([['phone','phone_label'],['phone2','phone2_label']] as [$pk,$lk])
                                @php $num = $siteSettings[$pk] ?? null; $lbl = $siteSettings[$lk] ?? null; @endphp
                                @if($num)
                                    @php $wa = 'https://api.whatsapp.com/send?phone=' . preg_replace('/[^0-9]/', '', $num); @endphp
                                    <div class="flex items-center gap-4">
                                        <div>
                                            @if($lbl)
                                                <p class="font-body text-xs tracking-widest uppercase text-cb-gray-400 mb-1">{{ $lbl }}</p>
                                            @endif
                                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $num) }}"
                                               class="font-display text-xl sm:text-2xl font-light text-cb-black hover:opacity-60 transition-opacity">
                                                {{ $num }}
                                            </a>
                                        </div>
                                        <a href="{{ $wa }}" target="_blank" rel="noopener noreferrer"
                                           aria-label="WhatsApp {{ $lbl ?? $num }}"
                                           class="shrink-0 w-10 h-10 rounded-full bg-[#25D366] flex items-center justify-center hover:opacity-80 transition-opacity touch-manipulation">
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                            </svg>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
                @if(!empty($siteSettings['address']))
                    <div>
                        <p class="field-label mb-3">Studio</p>
                        <p class="font-body text-cb-gray-500 leading-relaxed">{{ $siteSettings['address'] }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection

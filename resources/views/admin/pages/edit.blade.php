@extends('layouts.admin')
@section('title', 'Edit Page — ' . $page->title)
@section('heading', 'Edit Page: ' . $page->title)

@section('content')

<div class="max-w-3xl">

    {{-- Remove-hero form lives OUTSIDE the main form to avoid invalid nesting --}}
    @if($page->heroImageUrl())
    <form id="remove-hero-form" method="POST" action="{{ route('admin.pages.remove-hero', $page->slug) }}" class="hidden">
        @csrf
        @method('DELETE')
    </form>
    @endif

    <form method="POST" action="{{ route('admin.pages.update', $page->slug) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="admin-card p-6 space-y-6">

            {{-- Title & Subtitle --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="admin-label">Title</label>
                    <input name="title" type="text" value="{{ old('title', $page->title) }}"
                           class="admin-input @error('title') border-red-400 @enderror" required>
                    @error('title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="admin-label">Subtitle</label>
                    <input name="subtitle" type="text" value="{{ old('subtitle', $page->subtitle) }}"
                           class="admin-input">
                </div>
            </div>

            {{-- Body --}}
            <div>
                <label class="admin-label">Body Content <span class="normal-case text-cb-gray-400">(HTML)</span></label>
                <textarea name="body" rows="8" class="admin-textarea">{{ old('body', $page->body) }}</textarea>
            </div>

            {{-- Hero Image --}}
            <div>
                <label class="admin-label">Hero Image</label>
                @if($page->heroImageUrl())
                    <div class="mb-3 flex items-start gap-4">
                        <img src="{{ $page->heroImageUrl() }}" alt="Hero"
                             class="w-40 h-24 object-cover rounded-lg border border-cb-gray-200">
                        <button type="button" class="admin-btn-danger text-xs rounded-lg px-3 py-1.5"
                                onclick="if(confirm('Remove hero image?')) document.getElementById('remove-hero-form').submit()">
                            Remove
                        </button>
                    </div>
                @endif
                <input name="hero_image" type="file" accept="image/*"
                       data-preview="hero-preview"
                       class="block w-full text-sm text-cb-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:bg-cb-gray-100 file:text-cb-black hover:file:bg-cb-gray-200 cursor-pointer">
                <img id="hero-preview" src="" alt="" class="hidden mt-3 w-40 h-24 object-cover rounded-lg border border-cb-gray-200">
            </div>

            {{-- SEO --}}
            <div class="border-t border-cb-gray-100 pt-5 space-y-4">
                <p class="font-body text-xs font-medium tracking-wider uppercase text-cb-gray-400">SEO</p>
                <div>
                    <label class="admin-label">Meta Title</label>
                    <input name="meta_title" type="text" value="{{ old('meta_title', $page->meta_title) }}"
                           class="admin-input">
                </div>
                <div>
                    <label class="admin-label">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="admin-textarea">{{ old('meta_description', $page->meta_description) }}</textarea>
                </div>
            </div>

            {{-- Active --}}
            <div class="flex items-center gap-3">
                <input id="active" name="active" type="checkbox" value="1"
                       {{ old('active', $page->active) ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-cb-gray-300 text-cb-black focus:ring-cb-black">
                <label for="active" class="font-body text-sm text-cb-gray-700">Page is active (visible on site)</label>
            </div>
        </div>

        {{-- ── About page extra fields ─────────────────────── --}}
        @if($page->slug === 'about')
        @php $pm = $page->meta ?? []; @endphp
        <div class="admin-card p-6 space-y-5 mt-6">
            <p class="font-body text-xs font-medium tracking-wider uppercase text-cb-gray-400">Stats</p>
            @foreach([1,2,3,4] as $n)
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="admin-label">Stat {{ $n }} — Value</label>
                    <input name="page_meta[stat{{ $n }}_value]" type="text"
                           value="{{ old("page_meta.stat{$n}_value", $pm["stat{$n}_value"] ?? '') }}"
                           class="admin-input" placeholder="250+">
                </div>
                <div>
                    <label class="admin-label">Stat {{ $n }} — Label</label>
                    <input name="page_meta[stat{{ $n }}_label]" type="text"
                           value="{{ old("page_meta.stat{$n}_label", $pm["stat{$n}_label"] ?? '') }}"
                           class="admin-input" placeholder="Satisfied Clients">
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- ── Home page extra fields ──────────────────────── --}}
        @if($page->slug === 'home')
        @php $pm = $page->meta ?? []; @endphp

        {{-- Hero --}}
        <div class="admin-card p-6 space-y-5 mt-6">
            <p class="font-body text-xs font-medium tracking-wider uppercase text-cb-gray-400">Hero</p>
            <div>
                <label class="admin-label">Studio Label <span class="normal-case text-cb-gray-400">(small text above headline)</span></label>
                <input name="page_meta[studio_label]" type="text"
                       value="{{ old('page_meta.studio_label', $pm['studio_label'] ?? 'Interior Design Studio · Muscat, Oman') }}"
                       class="admin-input">
            </div>
        </div>

        {{-- Counters --}}
        <div class="admin-card p-6 space-y-5 mt-6">
            <p class="font-body text-xs font-medium tracking-wider uppercase text-cb-gray-400">Counters</p>
            @foreach([1,2,3,4] as $n)
            <div class="grid grid-cols-3 gap-3">
                <div>
                    <label class="admin-label">Stat {{ $n }} Number</label>
                    <input name="page_meta[stat{{ $n }}_num]" type="text"
                           value="{{ old("page_meta.stat{$n}_num", $pm["stat{$n}_num"] ?? '') }}"
                           class="admin-input" placeholder="250">
                </div>
                <div>
                    <label class="admin-label">Suffix</label>
                    <input name="page_meta[stat{{ $n }}_suffix]" type="text"
                           value="{{ old("page_meta.stat{$n}_suffix", $pm["stat{$n}_suffix"] ?? '+') }}"
                           class="admin-input" placeholder="+">
                </div>
                <div>
                    <label class="admin-label">Label</label>
                    <input name="page_meta[stat{{ $n }}_label]" type="text"
                           value="{{ old("page_meta.stat{$n}_label", $pm["stat{$n}_label"] ?? '') }}"
                           class="admin-input" placeholder="Projects Completed">
                </div>
            </div>
            @endforeach
        </div>

        {{-- About section --}}
        <div class="admin-card p-6 space-y-5 mt-6">
            <p class="font-body text-xs font-medium tracking-wider uppercase text-cb-gray-400">About Section</p>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="admin-label">Heading (line 1)</label>
                    <input name="page_meta[about_heading]" type="text"
                           value="{{ old('page_meta.about_heading', $pm['about_heading'] ?? 'Where Design') }}"
                           class="admin-input">
                </div>
                <div>
                    <label class="admin-label">Heading (italic line)</label>
                    <input name="page_meta[about_heading_em]" type="text"
                           value="{{ old('page_meta.about_heading_em', $pm['about_heading_em'] ?? 'Meets Comfort') }}"
                           class="admin-input">
                </div>
            </div>
            <div>
                <label class="admin-label">Years Badge <span class="normal-case text-cb-gray-400">(shown if no image uploaded)</span></label>
                <input name="page_meta[bento_years]" type="text"
                       value="{{ old('page_meta.bento_years', $pm['bento_years'] ?? '10+') }}"
                       class="admin-input" style="max-width:8rem">
            </div>

            <div class="pt-2">
                <label class="admin-label">Bento Main Image <span class="normal-case text-cb-gray-400">(large left box)</span></label>
                @if(!empty($pm['bento_image_main']))
                    <div class="flex items-center gap-3 mb-2">
                        <img src="{{ asset('storage/' . $pm['bento_image_main']) }}" alt=""
                             class="w-32 h-20 object-cover rounded-lg border border-cb-gray-200">
                        <p class="font-body text-xs text-cb-gray-400">Upload new to replace</p>
                    </div>
                @endif
                <input name="bento_image_main" type="file" accept="image/*" data-preview="bento-main-preview"
                       class="block w-full text-sm text-cb-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:bg-cb-gray-100 file:text-cb-black hover:file:bg-cb-gray-200 cursor-pointer">
                <img id="bento-main-preview" src="" alt="" class="hidden mt-2 w-32 h-20 object-cover rounded-lg border border-cb-gray-200">
            </div>

            <div class="grid grid-cols-2 gap-5 pt-2">
                <div>
                    <label class="admin-label">Bento Box 1 — Image <span class="normal-case text-cb-gray-400">(top-right)</span></label>
                    @if(!empty($pm['bento_image1']))
                        <div class="flex items-center gap-3 mb-2">
                            <img src="{{ asset('storage/' . $pm['bento_image1']) }}" alt=""
                                 class="w-20 h-20 object-cover rounded-lg border border-cb-gray-200">
                            <p class="font-body text-xs text-cb-gray-400">Upload new to replace</p>
                        </div>
                    @endif
                    <input name="bento_image1" type="file" accept="image/*" data-preview="bento1-preview"
                           class="block w-full text-sm text-cb-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:bg-cb-gray-100 file:text-cb-black hover:file:bg-cb-gray-200 cursor-pointer">
                    <img id="bento1-preview" src="" alt="" class="hidden mt-2 w-20 h-20 object-cover rounded-lg border border-cb-gray-200">
                </div>
                <div>
                    <label class="admin-label">Bento Box 2 — Image <span class="normal-case text-cb-gray-400">(bottom-right)</span></label>
                    @if(!empty($pm['bento_image2']))
                        <div class="flex items-center gap-3 mb-2">
                            <img src="{{ asset('storage/' . $pm['bento_image2']) }}" alt=""
                                 class="w-20 h-20 object-cover rounded-lg border border-cb-gray-200">
                            <p class="font-body text-xs text-cb-gray-400">Upload new to replace</p>
                        </div>
                    @endif
                    <input name="bento_image2" type="file" accept="image/*" data-preview="bento2-preview"
                           class="block w-full text-sm text-cb-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:bg-cb-gray-100 file:text-cb-black hover:file:bg-cb-gray-200 cursor-pointer">
                    <img id="bento2-preview" src="" alt="" class="hidden mt-2 w-20 h-20 object-cover rounded-lg border border-cb-gray-200">
                </div>
            </div>
            <div>
                <label class="admin-label">Paragraph 1</label>
                <textarea name="page_meta[about_body1]" rows="3" class="admin-textarea">{{ old('page_meta.about_body1', $pm['about_body1'] ?? '') }}</textarea>
            </div>
            <div>
                <label class="admin-label">Paragraph 2</label>
                <textarea name="page_meta[about_body2]" rows="3" class="admin-textarea">{{ old('page_meta.about_body2', $pm['about_body2'] ?? '') }}</textarea>
            </div>
        </div>

        {{-- Marquee --}}
        <div class="admin-card p-6 space-y-5 mt-6">
            <p class="font-body text-xs font-medium tracking-wider uppercase text-cb-gray-400">Marquee Ticker</p>
            <div>
                <label class="admin-label">Items <span class="normal-case text-cb-gray-400">(comma-separated)</span></label>
                <textarea name="page_meta[marquee_items]" rows="2" class="admin-textarea">{{ old('page_meta.marquee_items', $pm['marquee_items'] ?? 'Residential Design,Commercial Interiors,Space Planning,Furniture Curation,Project Management,Bespoke Luxury,Muscat · Oman') }}</textarea>
            </div>
        </div>

        {{-- Section headings --}}
        <div class="admin-card p-6 space-y-5 mt-6">
            <p class="font-body text-xs font-medium tracking-wider uppercase text-cb-gray-400">Section Headings</p>
            <div>
                <label class="admin-label">Services Heading</label>
                <input name="page_meta[services_heading]" type="text"
                       value="{{ old('page_meta.services_heading', $pm['services_heading'] ?? "This Is What We're Best At") }}"
                       class="admin-input">
            </div>
            <div>
                <label class="admin-label">Work / Gallery Heading</label>
                <input name="page_meta[work_heading]" type="text"
                       value="{{ old('page_meta.work_heading', $pm['work_heading'] ?? 'More of Our Work') }}"
                       class="admin-input">
            </div>
        </div>

        {{-- Testimonial --}}
        <div class="admin-card p-6 space-y-5 mt-6">
            <p class="font-body text-xs font-medium tracking-wider uppercase text-cb-gray-400">Testimonial</p>
            <div>
                <label class="admin-label">Quote</label>
                <textarea name="page_meta[testimonial_quote]" rows="3" class="admin-textarea">{{ old('page_meta.testimonial_quote', $pm['testimonial_quote'] ?? '') }}</textarea>
            </div>
            <div>
                <label class="admin-label">Avatar Image <span class="normal-case text-cb-gray-400">(circular photo)</span></label>
                @if(!empty($pm['testimonial_image']))
                    <div class="flex items-center gap-3 mb-2">
                        <img src="{{ asset('storage/' . $pm['testimonial_image']) }}" alt=""
                             class="w-16 h-16 object-cover rounded-full border border-cb-gray-200">
                        <p class="font-body text-xs text-cb-gray-400">Upload new to replace</p>
                    </div>
                @endif
                <input name="testimonial_image" type="file" accept="image/*" data-preview="testimonial-img-preview"
                       class="block w-full text-sm text-cb-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:bg-cb-gray-100 file:text-cb-black hover:file:bg-cb-gray-200 cursor-pointer">
                <img id="testimonial-img-preview" src="" alt="" class="hidden mt-2 w-16 h-16 object-cover rounded-full border border-cb-gray-200">
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="admin-label">Author Name</label>
                    <input name="page_meta[testimonial_author]" type="text"
                           value="{{ old('page_meta.testimonial_author', $pm['testimonial_author'] ?? '') }}"
                           class="admin-input">
                </div>
                <div>
                    <label class="admin-label">Project</label>
                    <input name="page_meta[testimonial_project]" type="text"
                           value="{{ old('page_meta.testimonial_project', $pm['testimonial_project'] ?? '') }}"
                           class="admin-input">
                </div>
                <div>
                    <label class="admin-label">Initials (avatar)</label>
                    <input name="page_meta[testimonial_initials]" type="text"
                           value="{{ old('page_meta.testimonial_initials', $pm['testimonial_initials'] ?? '') }}"
                           class="admin-input" placeholder="AR" style="max-width:8rem">
                </div>
            </div>
        </div>

        {{-- FAQs --}}
        <div class="admin-card p-6 space-y-6 mt-6">
            <p class="font-body text-xs font-medium tracking-wider uppercase text-cb-gray-400">FAQs</p>
            @foreach([1,2,3,4,5] as $n)
            <div class="space-y-3 {{ $n > 1 ? 'border-t border-cb-gray-100 pt-5' : '' }}">
                <p class="font-body text-xs text-cb-gray-400">FAQ {{ $n }}</p>
                <div>
                    <label class="admin-label">Question</label>
                    <input name="page_meta[faq{{ $n }}_q]" type="text"
                           value="{{ old("page_meta.faq{$n}_q", $pm["faq{$n}_q"] ?? '') }}"
                           class="admin-input">
                </div>
                <div>
                    <label class="admin-label">Answer</label>
                    <textarea name="page_meta[faq{{ $n }}_a]" rows="2" class="admin-textarea">{{ old("page_meta.faq{$n}_a", $pm["faq{$n}_a"] ?? '') }}</textarea>
                </div>
            </div>
            @endforeach
        </div>

        {{-- CTA --}}
        <div class="admin-card p-6 space-y-5 mt-6">
            <p class="font-body text-xs font-medium tracking-wider uppercase text-cb-gray-400">CTA Section</p>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="admin-label">Heading (line 1)</label>
                    <input name="page_meta[cta_heading]" type="text"
                           value="{{ old('page_meta.cta_heading', $pm['cta_heading'] ?? "Let's Create") }}"
                           class="admin-input">
                </div>
                <div>
                    <label class="admin-label">Heading (italic line)</label>
                    <input name="page_meta[cta_heading_em]" type="text"
                           value="{{ old('page_meta.cta_heading_em', $pm['cta_heading_em'] ?? 'Something Beautiful') }}"
                           class="admin-input">
                </div>
            </div>
        </div>
        @endif

        <div class="flex items-center gap-3 mt-5">
            <button type="submit" class="admin-btn-primary rounded-lg">Save Changes</button>
            <a href="{{ route('admin.pages.index') }}" class="admin-btn-outline rounded-lg">Cancel</a>
        </div>
    </form>
</div>

@endsection

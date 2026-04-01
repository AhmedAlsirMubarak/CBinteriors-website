@extends('layouts.admin')
@section('title', 'Edit Service — ' . $service->title)
@section('heading', 'Edit Service: ' . $service->title)

@section('content')

<div class="max-w-3xl">
    <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="admin-card p-6 space-y-5">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label class="admin-label">Title <span class="text-red-400">*</span></label>
                    <input name="title" type="text" value="{{ old('title', $service->title) }}"
                           class="admin-input @error('title') border-red-400 @enderror" required>
                    @error('title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="admin-label">Short Description</label>
                    <input name="short_desc" type="text" value="{{ old('short_desc', $service->short_desc) }}"
                           class="admin-input">
                </div>

                <div class="sm:col-span-2">
                    <label class="admin-label">Full Description <span class="normal-case text-cb-gray-400">(HTML)</span></label>
                    <textarea name="description" rows="8" class="admin-textarea">{{ old('description', $service->description) }}</textarea>
                </div>

                <div>
                    <label class="admin-label">Image</label>
                    @if($service->imageUrl())
                        <img src="{{ $service->imageUrl() }}" alt=""
                             class="w-32 h-24 object-cover rounded-lg border border-cb-gray-200 mb-2">
                        <p class="text-xs text-cb-gray-400 mb-2">Upload a new file to replace</p>
                    @endif
                    <input name="image" type="file" accept="image/*" data-preview="img-preview"
                           class="block w-full text-sm text-cb-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:bg-cb-gray-100 file:text-cb-black hover:file:bg-cb-gray-200 cursor-pointer">
                    <img id="img-preview" src="" alt="" class="hidden mt-2 w-32 h-24 object-cover rounded-lg border border-cb-gray-200">
                </div>
            </div>

            <div class="border-t border-cb-gray-100 pt-5 flex flex-wrap gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input name="is_featured" type="checkbox" value="1"
                           {{ old('is_featured', $service->is_featured) ? 'checked' : '' }}
                           class="w-4 h-4 rounded border-cb-gray-300 text-cb-black focus:ring-cb-black">
                    <span class="font-body text-sm text-cb-gray-700">Featured</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input name="active" type="checkbox" value="1"
                           {{ old('active', $service->active) ? 'checked' : '' }}
                           class="w-4 h-4 rounded border-cb-gray-300 text-cb-black focus:ring-cb-black">
                    <span class="font-body text-sm text-cb-gray-700">Active</span>
                </label>
            </div>
        </div>

        <div class="flex items-center gap-3 mt-5">
            <button type="submit" class="admin-btn-primary rounded-lg">Save Changes</button>
            <a href="{{ route('admin.services.index') }}" class="admin-btn-outline rounded-lg">Cancel</a>
        </div>
    </form>
</div>

@endsection

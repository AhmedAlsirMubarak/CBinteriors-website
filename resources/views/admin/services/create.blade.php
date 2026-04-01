@extends('layouts.admin')
@section('title', 'Add Service')
@section('heading', 'Add Service')

@section('content')

<div class="max-w-3xl">
    <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="admin-card p-6 space-y-5">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label class="admin-label">Title <span class="text-red-400">*</span></label>
                    <input name="title" type="text" value="{{ old('title') }}"
                           class="admin-input @error('title') border-red-400 @enderror" required>
                    @error('title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="admin-label">Short Description</label>
                    <input name="short_desc" type="text" value="{{ old('short_desc') }}"
                           class="admin-input" placeholder="One-line summary shown on cards">
                </div>

                <div class="sm:col-span-2">
                    <label class="admin-label">Full Description <span class="normal-case text-cb-gray-400">(HTML)</span></label>
                    <textarea name="description" rows="8" class="admin-textarea">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label class="admin-label">Image</label>
                    <input name="image" type="file" accept="image/*" data-preview="img-preview"
                           class="block w-full text-sm text-cb-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:bg-cb-gray-100 file:text-cb-black hover:file:bg-cb-gray-200 cursor-pointer">
                    <img id="img-preview" src="" alt="" class="hidden mt-3 w-32 h-24 object-cover rounded-lg border border-cb-gray-200">
                </div>
            </div>

            <div class="border-t border-cb-gray-100 pt-5 flex flex-wrap gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input name="is_featured" type="checkbox" value="1" {{ old('is_featured') ? 'checked' : '' }}
                           class="w-4 h-4 rounded border-cb-gray-300 text-cb-black focus:ring-cb-black">
                    <span class="font-body text-sm text-cb-gray-700">Featured (shown on homepage)</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input name="active" type="checkbox" value="1" {{ old('active', true) ? 'checked' : '' }}
                           class="w-4 h-4 rounded border-cb-gray-300 text-cb-black focus:ring-cb-black">
                    <span class="font-body text-sm text-cb-gray-700">Active</span>
                </label>
            </div>
        </div>

        <div class="flex items-center gap-3 mt-5">
            <button type="submit" class="admin-btn-primary rounded-lg">Create Service</button>
            <a href="{{ route('admin.services.index') }}" class="admin-btn-outline rounded-lg">Cancel</a>
        </div>
    </form>
</div>

@endsection

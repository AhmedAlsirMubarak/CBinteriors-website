@extends('layouts.admin')
@section('title', 'Add Product')
@section('heading', 'Add Product')

@section('content')

<div class="max-w-3xl">
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="admin-card p-6 space-y-5">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <div class="sm:col-span-2">
                    <label class="admin-label">Product Name <span class="text-red-400">*</span></label>
                    <input name="name" type="text" value="{{ old('name') }}"
                           class="admin-input @error('name') border-red-400 @enderror" required>
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="admin-label">Category</label>
                    <select name="category_id" class="admin-input">
                        <option value="">— No category —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="admin-label">Price <span class="normal-case text-cb-gray-400">(OMR, leave blank for "Price on request")</span></label>
                    <input name="price" type="number" step="0.001" min="0" value="{{ old('price') }}"
                           class="admin-input" placeholder="0.000">
                </div>

                <div class="sm:col-span-2">
                    <label class="admin-label">Description <span class="normal-case text-cb-gray-400">(HTML)</span></label>
                    <textarea name="description" rows="6" class="admin-textarea">{{ old('description') }}</textarea>
                </div>

                <div class="sm:col-span-2">
                    <label class="admin-label">Images <span class="normal-case text-cb-gray-400">(first image is the primary)</span></label>
                    <input name="new_images[]" type="file" accept="image/*" multiple
                           class="block w-full text-sm text-cb-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:bg-cb-gray-100 file:text-cb-black hover:file:bg-cb-gray-200 cursor-pointer">
                    @error('new_images.*') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
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
            <button type="submit" class="admin-btn-primary rounded-lg">Create Product</button>
            <a href="{{ route('admin.products.index') }}" class="admin-btn-outline rounded-lg">Cancel</a>
        </div>
    </form>
</div>

@endsection

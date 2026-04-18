@extends('layouts.admin')
@section('title', 'Edit Product — ' . $product->name)
@section('heading', 'Edit Product: ' . $product->name)

@section('content')

<div class="max-w-3xl">

    @if($errors->any())
        <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-xl">
            <p class="font-body text-sm font-medium text-red-700 mb-2">Please fix the following errors:</p>
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li class="font-body text-sm text-red-600">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="admin-card p-6 space-y-5">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <div class="sm:col-span-2">
                    <label class="admin-label">Product Name <span class="text-red-400">*</span></label>
                    <input name="name" type="text" value="{{ old('name', $product->name) }}"
                           class="admin-input @error('name') border-red-400 @enderror" required>
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="admin-label">Category</label>
                    <select name="category_id" class="admin-input">
                        <option value="">— No category —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                    {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="admin-label">Price <span class="normal-case text-cb-gray-400">(OMR)</span></label>
                    <input name="price" type="number" step="0.001" min="0"
                           value="{{ old('price', $product->price) }}"
                           class="admin-input" placeholder="0.000">
                </div>

                <div class="sm:col-span-2">
                    <label class="admin-label">Description <span class="normal-case text-cb-gray-400">(HTML)</span></label>
                    <textarea name="description" rows="6" class="admin-textarea">{{ old('description', $product->description) }}</textarea>
                </div>

                {{-- Existing images --}}
                @if($product->allImageUrls())
                    <div class="sm:col-span-2">
                        <label class="admin-label">Current Images</label>
                        <div class="flex flex-wrap gap-3 mt-1">
                            @foreach($product->allImageUrls() as $i => $url)
                                @php $imagePath = $product->images[$i]; @endphp
                                <div class="relative group">
                                    <img src="{{ $url }}" alt=""
                                         class="w-24 h-20 object-cover rounded-lg border border-cb-gray-200">
                                    <button type="submit"
                                            form="remove-image-{{ $i }}"
                                            class="absolute top-1 right-1 opacity-0 group-hover:opacity-100 transition-opacity w-5 h-5 bg-red-600 text-white rounded-full flex items-center justify-center text-xs leading-none"
                                            data-confirm="Remove this image?">×</button>
                                    @if($i === 0)
                                        <span class="absolute bottom-1 left-1 text-[9px] bg-cb-black text-white px-1 rounded">Primary</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="sm:col-span-2">
                    <label class="admin-label">Replace Images <span class="normal-case font-normal text-cb-gray-400">(uploading new images will remove all current ones)</span></label>
                    <input name="new_images[]" type="file" accept="image/*" multiple
                           class="block w-full text-sm text-cb-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:bg-cb-gray-100 file:text-cb-black hover:file:bg-cb-gray-200 cursor-pointer">
                </div>
            </div>

            <div class="border-t border-cb-gray-100 pt-5 flex flex-wrap gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input name="is_featured" type="checkbox" value="1"
                           {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                           class="w-4 h-4 rounded border-cb-gray-300 text-cb-black focus:ring-cb-black">
                    <span class="font-body text-sm text-cb-gray-700">Featured</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input name="active" type="checkbox" value="1"
                           {{ old('active', $product->active) ? 'checked' : '' }}
                           class="w-4 h-4 rounded border-cb-gray-300 text-cb-black focus:ring-cb-black">
                    <span class="font-body text-sm text-cb-gray-700">Active</span>
                </label>
            </div>
        </div>

        <div class="flex items-center gap-3 mt-5">
            <button type="submit" class="admin-btn-primary rounded-lg">Save Changes</button>
            <a href="{{ route('admin.products.index') }}" class="admin-btn-outline rounded-lg">Cancel</a>
        </div>
    </form>

    {{-- Remove-image forms live outside the main form to avoid nested-form invalid HTML --}}
    @foreach($product->allImageUrls() as $i => $url)
        @php $imagePath = $product->images[$i]; @endphp
        <form id="remove-image-{{ $i }}"
              method="POST"
              action="{{ route('admin.products.remove-image', $product) }}">
            @csrf @method('PATCH')
            <input type="hidden" name="image_path" value="{{ $imagePath }}">
        </form>
    @endforeach

</div>

@endsection

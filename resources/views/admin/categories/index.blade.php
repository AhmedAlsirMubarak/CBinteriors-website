@extends('layouts.admin')
@section('title', 'Categories')
@section('heading', 'Categories')

@section('content')

{{-- Single shared x-data scope so the form and table communicate --}}
<div class="grid grid-cols-1 lg:grid-cols-5 gap-6"
     x-data="{ editing: null, name: '', description: '', active: true }"
     @edit-category.window="editing = $event.detail.id; name = $event.detail.name; description = $event.detail.description; active = $event.detail.active">

    {{-- Add / Edit form --}}
    <div class="lg:col-span-2">

        {{-- Edit form --}}
        <div x-show="editing !== null" x-cloak class="admin-card p-5 mb-4">
            <h3 class="font-body text-sm font-medium text-cb-black mb-4">Edit Category</h3>
            <form method="POST" :action="`/admin/categories/${editing}`" class="space-y-4">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div>
                    <label class="admin-label">Name <span class="text-red-400">*</span></label>
                    <input name="name" type="text" x-model="name" class="admin-input" required>
                </div>
                <div>
                    <label class="admin-label">Description</label>
                    <textarea name="description" rows="3" x-model="description" class="admin-textarea"></textarea>
                </div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input name="active" type="checkbox" value="1" x-model="active"
                           class="w-4 h-4 rounded border-cb-gray-300 text-cb-black focus:ring-cb-black">
                    <span class="font-body text-sm text-cb-gray-700">Active</span>
                </label>
                <div class="flex gap-2 pt-1">
                    <button type="submit" class="admin-btn-primary rounded-lg text-xs px-4 py-2">Save</button>
                    <button type="button" @click="editing = null" class="admin-btn-outline rounded-lg text-xs px-4 py-2">Cancel</button>
                </div>
            </form>
        </div>

        {{-- Create form --}}
        <div x-show="editing === null" class="admin-card p-5">
            <h3 class="font-body text-sm font-medium text-cb-black mb-4">New Category</h3>
            <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="admin-label">Name <span class="text-red-400">*</span></label>
                    <input name="name" type="text" value="{{ old('name') }}"
                           class="admin-input @error('name') border-red-400 @enderror" required>
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="admin-label">Description</label>
                    <textarea name="description" rows="3" class="admin-textarea">{{ old('description') }}</textarea>
                </div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input name="active" type="checkbox" value="1" {{ old('active', true) ? 'checked' : '' }}
                           class="w-4 h-4 rounded border-cb-gray-300 text-cb-black focus:ring-cb-black">
                    <span class="font-body text-sm text-cb-gray-700">Active</span>
                </label>
                <button type="submit" class="admin-btn-primary rounded-lg w-full justify-center">Create Category</button>
            </form>
        </div>
    </div>

    {{-- Categories list --}}
    <div class="lg:col-span-3 admin-card">
        <div class="px-5 py-4 border-b border-cb-gray-100 flex items-center justify-between">
            <h2 class="font-body text-sm font-medium text-cb-black">{{ $categories->count() }} Categor{{ $categories->count() === 1 ? 'y' : 'ies' }}</h2>
            <p class="font-body text-xs text-cb-gray-400">Drag to reorder</p>
        </div>

        @if($categories->isEmpty())
            <p class="px-5 py-10 text-center font-body text-sm text-cb-gray-400">No categories yet.</p>
        @else
            <div class="overflow-x-auto">
            <table class="admin-table" data-sortable="{{ route('admin.categories.reorder') }}">
                <thead>
                    <tr>
                        <th class="w-8"></th>
                        <th>Name</th>
                        <th>Products</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr data-id="{{ $category->id }}">
                            <td><span class="drag-handle">⠿</span></td>
                            <td>
                                <p class="font-medium text-cb-black">{{ $category->name }}</p>
                                @if($category->description)
                                    <p class="text-xs text-cb-gray-400 truncate max-w-45">{{ $category->description }}</p>
                                @endif
                            </td>
                            <td>{{ $category->products_count ?? 0 }}</td>
                            <td>
                                @if($category->active)
                                    <span class="badge-green">Active</span>
                                @else
                                    <span class="badge-gray">Hidden</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button"
                                            class="admin-btn-outline text-xs rounded-lg px-3 py-1.5"
                                            @click="$dispatch('edit-category', {
                                                id: {{ $category->id }},
                                                name: '{{ addslashes($category->name) }}',
                                                description: '{{ addslashes($category->description ?? '') }}',
                                                active: {{ $category->active ? 'true' : 'false' }}
                                            })">
                                        Edit
                                    </button>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="admin-btn-danger text-xs rounded-lg px-3 py-1.5"
                                                data-confirm="Delete '{{ $category->name }}'? Products won't be deleted.">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        @endif
    </div>
</div>

@endsection

@extends('layouts.admin')
@section('title', 'Clients & Partners')
@section('heading', 'Clients & Partners')

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-5 gap-6"
     x-data="{ editing: null, name: '', url: '', active: true }"
     @edit-client.window="editing = $event.detail.id; name = $event.detail.name; url = $event.detail.url; active = $event.detail.active">

    {{-- Add / Edit form --}}
    <div class="lg:col-span-2">

        {{-- Edit form --}}
        <div x-show="editing !== null" x-cloak class="admin-card p-5 mb-4">
            <h3 class="font-body text-sm font-medium text-cb-black mb-4">Edit Client</h3>
            <form method="POST" :action="`/admin/clients/${editing}`" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div>
                    <label class="admin-label">Name <span class="text-red-400">*</span></label>
                    <input name="name" type="text" x-model="name" class="admin-input" required>
                </div>
                <div>
                    <label class="admin-label">Website URL</label>
                    <input name="url" type="url" x-model="url" class="admin-input" placeholder="https://...">
                </div>
                <div>
                    <label class="admin-label">Replace Logo</label>
                    <input name="logo" type="file" accept="image/*,image/svg+xml"
                           class="block w-full text-sm text-cb-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:bg-cb-gray-100 file:text-cb-black hover:file:bg-cb-gray-200 cursor-pointer">
                </div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input name="active" type="checkbox" value="1" x-model="active"
                           class="w-4 h-4 rounded border-cb-gray-300 text-cb-black focus:ring-cb-black">
                    <span class="font-body text-sm text-cb-gray-700">Active</span>
                </label>
                <div class="flex gap-2">
                    <button type="submit" class="admin-btn-primary rounded-lg text-xs px-4 py-2">Save</button>
                    <button type="button" @click="editing = null" class="admin-btn-outline rounded-lg text-xs px-4 py-2">Cancel</button>
                </div>
            </form>
        </div>

        {{-- Create form --}}
        <div x-show="editing === null" class="admin-card p-5">
            <h3 class="font-body text-sm font-medium text-cb-black mb-4">Add Client</h3>
            <form method="POST" action="{{ route('admin.clients.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="admin-label">Name <span class="text-red-400">*</span></label>
                    <input name="name" type="text" value="{{ old('name') }}"
                           class="admin-input @error('name') border-red-400 @enderror" required>
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="admin-label">Website URL</label>
                    <input name="url" type="url" value="{{ old('url') }}" class="admin-input" placeholder="https://...">
                </div>
                <div>
                    <label class="admin-label">Logo <span class="normal-case text-cb-gray-400">(PNG, JPG, SVG)</span></label>
                    <input name="logo" type="file" accept="image/*,image/svg+xml"
                           class="block w-full text-sm text-cb-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:bg-cb-gray-100 file:text-cb-black hover:file:bg-cb-gray-200 cursor-pointer">
                </div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input name="active" type="checkbox" value="1" {{ old('active', true) ? 'checked' : '' }}
                           class="w-4 h-4 rounded border-cb-gray-300 text-cb-black focus:ring-cb-black">
                    <span class="font-body text-sm text-cb-gray-700">Active</span>
                </label>
                <button type="submit" class="admin-btn-primary rounded-lg w-full justify-center">Add Client</button>
            </form>
        </div>
    </div>

    {{-- Clients list --}}
    <div class="lg:col-span-3 admin-card">
        <div class="px-5 py-4 border-b border-cb-gray-100 flex items-center justify-between">
            <h2 class="font-body text-sm font-medium text-cb-black">{{ $clients->count() }} Client(s)</h2>
            <p class="font-body text-xs text-cb-gray-400">Drag to reorder</p>
        </div>

        @if($clients->isEmpty())
            <p class="px-5 py-10 text-center font-body text-sm text-cb-gray-400">No clients yet.</p>
        @else
            <table class="admin-table" data-sortable="{{ route('admin.clients.reorder') }}">
                <thead>
                    <tr>
                        <th class="w-8"></th>
                        <th>Client</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr data-id="{{ $client->id }}">
                            <td><span class="drag-handle">⠿</span></td>
                            <td>
                                <div class="flex items-center gap-3">
                                    @if($client->logoUrl())
                                        <img src="{{ $client->logoUrl() }}" alt="{{ $client->name }}"
                                             class="w-14 h-10 object-contain rounded border border-cb-gray-200 bg-cb-gray-50 p-1 shrink-0">
                                    @else
                                        <div class="w-14 h-10 rounded border border-cb-gray-200 bg-cb-gray-100 flex items-center justify-center shrink-0">
                                            <span class="text-xs text-cb-gray-400">No logo</span>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-medium text-cb-black text-sm">{{ $client->name }}</p>
                                        @if($client->url)
                                            <p class="text-xs text-cb-gray-400 truncate max-w-40">{{ $client->url }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($client->active)
                                    <span class="badge-green">Active</span>
                                @else
                                    <span class="badge-gray">Hidden</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button"
                                            class="admin-btn-outline text-xs rounded-lg px-3 py-1.5"
                                            @click="$dispatch('edit-client', {
                                                id: {{ $client->id }},
                                                name: '{{ addslashes($client->name) }}',
                                                url: '{{ $client->url ?? '' }}',
                                                active: {{ $client->active ? 'true' : 'false' }}
                                            })">
                                        Edit
                                    </button>
                                    <form method="POST" action="{{ route('admin.clients.destroy', $client) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="admin-btn-danger text-xs rounded-lg px-3 py-1.5"
                                                data-confirm="Delete '{{ $client->name }}'?">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection

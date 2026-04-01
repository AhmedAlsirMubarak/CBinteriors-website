@extends('layouts.admin')
@section('title', 'Team Members')
@section('heading', 'Team Members')

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-5 gap-6"
     x-data="{ editing: null, name: '', role: '', bio: '', sort_order: '', active: true }">

    {{-- ── Form panel ──────────────────────────────────────── --}}
    <div class="lg:col-span-2 space-y-4">

        {{-- Edit form --}}
        <div x-show="editing !== null" style="display:none" class="admin-card p-5">
            <h3 class="font-body text-sm font-medium text-cb-black mb-4">Edit Member</h3>
            <form method="POST" :action="`/admin/team/${editing}`" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div>
                    <label class="admin-label">Name <span class="text-red-400">*</span></label>
                    <input name="name" type="text" x-model="name" class="admin-input" required>
                </div>
                <div>
                    <label class="admin-label">Role / Title</label>
                    <input name="role" type="text" x-model="role" class="admin-input" placeholder="Co-Founder & Lead Designer">
                </div>
                <div>
                    <label class="admin-label">Bio</label>
                    <textarea name="bio" rows="5" x-model="bio" class="admin-textarea"></textarea>
                </div>
                <div>
                    <label class="admin-label">Replace Photo</label>
                    <input name="photo" type="file" accept="image/*"
                           class="block w-full text-sm text-cb-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:bg-cb-gray-100 file:text-cb-black hover:file:bg-cb-gray-200 cursor-pointer">
                </div>
                <div>
                    <label class="admin-label">Sort Order</label>
                    <input name="sort_order" type="number" x-model="sort_order" min="0" class="admin-input w-28">
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

        {{-- Add form --}}
        <div x-show="editing === null" class="admin-card p-5">
            <h3 class="font-body text-sm font-medium text-cb-black mb-4">Add Member</h3>
            <form method="POST" action="{{ route('admin.team.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="admin-label">Name <span class="text-red-400">*</span></label>
                    <input name="name" type="text" value="{{ old('name') }}"
                           class="admin-input @error('name') border-red-400 @enderror" required>
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="admin-label">Role / Title</label>
                    <input name="role" type="text" value="{{ old('role') }}"
                           class="admin-input" placeholder="Co-Founder & Lead Designer">
                </div>
                <div>
                    <label class="admin-label">Bio</label>
                    <textarea name="bio" rows="5" class="admin-textarea" placeholder="Short biography...">{{ old('bio') }}</textarea>
                </div>
                <div>
                    <label class="admin-label">Photo <span class="normal-case text-cb-gray-400">(JPG, PNG, WEBP)</span></label>
                    <input name="photo" type="file" accept="image/*"
                           class="block w-full text-sm text-cb-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:bg-cb-gray-100 file:text-cb-black hover:file:bg-cb-gray-200 cursor-pointer">
                </div>
                <div>
                    <label class="admin-label">Sort Order</label>
                    <input name="sort_order" type="number" value="{{ old('sort_order', $members->count() + 1) }}"
                           min="0" class="admin-input w-28">
                </div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input name="active" type="checkbox" value="1" {{ old('active', true) ? 'checked' : '' }}
                           class="w-4 h-4 rounded border-cb-gray-300 text-cb-black focus:ring-cb-black">
                    <span class="font-body text-sm text-cb-gray-700">Active</span>
                </label>
                <button type="submit" class="admin-btn-primary rounded-lg w-full justify-center">Add Member</button>
            </form>
        </div>
    </div>

    {{-- ── Members list ─────────────────────────────────────── --}}
    <div class="lg:col-span-3 admin-card">
        <div class="px-5 py-4 border-b border-cb-gray-100 flex items-center justify-between">
            <h2 class="font-body text-sm font-medium text-cb-black">{{ $members->count() }} Member(s)</h2>
            <p class="font-body text-xs text-cb-gray-400">Drag to reorder</p>
        </div>

        @if($members->isEmpty())
            <p class="px-5 py-10 text-center font-body text-sm text-cb-gray-400">No team members yet.</p>
        @else
            <table class="admin-table" data-sortable="{{ route('admin.team.reorder') }}">
                <thead>
                    <tr>
                        <th class="w-8"></th>
                        <th>Member</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                        <tr data-id="{{ $member->id }}">
                            <td><span class="drag-handle">⠿</span></td>
                            <td>
                                <div class="flex items-center gap-3">
                                    @if($member->photoUrl())
                                        <img src="{{ $member->photoUrl() }}" alt="{{ $member->name }}"
                                             class="w-10 h-10 rounded-full object-cover shrink-0 border border-cb-gray-200">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-cb-gray-100 flex items-center justify-center shrink-0">
                                            <span class="font-body text-sm font-medium text-cb-gray-400">{{ strtoupper(substr($member->name,0,1)) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-medium text-cb-black text-sm">{{ $member->name }}</p>
                                        @if($member->role)
                                            <p class="text-xs text-cb-gray-400">{{ $member->role }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($member->active)
                                    <span class="badge-green">Active</span>
                                @else
                                    <span class="badge-gray">Hidden</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button"
                                            class="admin-btn-outline text-xs rounded-lg px-3 py-1.5"
                                            @click="editing = {{ $member->id }};
                                                    name = '{{ addslashes($member->name) }}';
                                                    role = '{{ addslashes($member->role ?? '') }}';
                                                    bio  = '{{ addslashes($member->bio ?? '') }}';
                                                    sort_order = {{ $member->sort_order }};
                                                    active = {{ $member->active ? 'true' : 'false' }}">
                                        Edit
                                    </button>
                                    <form method="POST" action="{{ route('admin.team.destroy', $member) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="admin-btn-danger text-xs rounded-lg px-3 py-1.5"
                                                data-confirm="Delete '{{ $member->name }}'?">Delete</button>
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

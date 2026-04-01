@extends('layouts.admin')
@section('title', 'Process Steps')
@section('heading', 'Process Steps')

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

    {{-- Add / Edit form --}}
    <div class="lg:col-span-2" x-data="{ editing: null, title: '', description: '', step_number: '', active: true }">

        <div x-show="editing !== null" style="display:none" class="admin-card p-5 mb-4">
            <h3 class="font-body text-sm font-medium text-cb-black mb-4">Edit Step</h3>
            <form method="POST" :action="`/admin/process/${editing}`" class="space-y-4">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="admin-label">Step #</label>
                        <input name="step_number" type="number" x-model="step_number" min="1" class="admin-input" required>
                    </div>
                    <div class="col-span-2">
                        <label class="admin-label">Title <span class="text-red-400">*</span></label>
                        <input name="title" type="text" x-model="title" class="admin-input" required>
                    </div>
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
                <div class="flex gap-2">
                    <button type="submit" class="admin-btn-primary rounded-lg text-xs px-4 py-2">Save</button>
                    <button type="button" @click="editing = null" class="admin-btn-outline rounded-lg text-xs px-4 py-2">Cancel</button>
                </div>
            </form>
        </div>

        <div x-show="editing === null" class="admin-card p-5">
            <h3 class="font-body text-sm font-medium text-cb-black mb-4">Add Step</h3>
            <form method="POST" action="{{ route('admin.process.store') }}" class="space-y-4">
                @csrf
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="admin-label">Step #</label>
                        <input name="step_number" type="number" value="{{ old('step_number', $steps->count() + 1) }}"
                               min="1" class="admin-input @error('step_number') border-red-400 @enderror" required>
                    </div>
                    <div class="col-span-2">
                        <label class="admin-label">Title <span class="text-red-400">*</span></label>
                        <input name="title" type="text" value="{{ old('title') }}"
                               class="admin-input @error('title') border-red-400 @enderror" required>
                    </div>
                </div>
                <div>
                    <label class="admin-label">Description</label>
                    <textarea name="description" rows="3" class="admin-textarea" placeholder="Brief description of this step...">{{ old('description') }}</textarea>
                </div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input name="active" type="checkbox" value="1" {{ old('active', true) ? 'checked' : '' }}
                           class="w-4 h-4 rounded border-cb-gray-300 text-cb-black focus:ring-cb-black">
                    <span class="font-body text-sm text-cb-gray-700">Active</span>
                </label>
                <button type="submit" class="admin-btn-primary rounded-lg w-full justify-center">Add Step</button>
            </form>
        </div>
    </div>

    {{-- Steps list --}}
    <div class="lg:col-span-3 admin-card"
         @edit-step.window="editing = $event.detail.id; title = $event.detail.title; description = $event.detail.description; step_number = $event.detail.step_number; active = $event.detail.active"
         x-data="{}">
        <div class="px-5 py-4 border-b border-cb-gray-100 flex items-center justify-between">
            <h2 class="font-body text-sm font-medium text-cb-black">{{ $steps->count() }} Step(s)</h2>
            <p class="font-body text-xs text-cb-gray-400">Drag to reorder</p>
        </div>

        @if($steps->isEmpty())
            <p class="px-5 py-10 text-center font-body text-sm text-cb-gray-400">No steps yet.</p>
        @else
            <table class="admin-table" data-sortable="{{ route('admin.process.reorder') }}">
                <thead>
                    <tr>
                        <th class="w-8"></th>
                        <th>#</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($steps as $step)
                        <tr data-id="{{ $step->id }}">
                            <td><span class="drag-handle">⠿</span></td>
                            <td>
                                <span class="font-display text-lg font-light text-cb-gray-400">{{ str_pad($step->step_number, 2, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td>
                                <p class="font-medium text-cb-black">{{ $step->title }}</p>
                                @if($step->description)
                                    <p class="text-xs text-cb-gray-400 max-w-xs truncate">{{ $step->description }}</p>
                                @endif
                            </td>
                            <td>
                                @if($step->active)
                                    <span class="badge-green">Active</span>
                                @else
                                    <span class="badge-gray">Hidden</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button"
                                            class="admin-btn-outline text-xs rounded-lg px-3 py-1.5"
                                            @click="$dispatch('edit-step', {
                                                id: {{ $step->id }},
                                                title: '{{ addslashes($step->title) }}',
                                                description: '{{ addslashes($step->description ?? '') }}',
                                                step_number: {{ $step->step_number }},
                                                active: {{ $step->active ? 'true' : 'false' }}
                                            })">
                                        Edit
                                    </button>
                                    <form method="POST" action="{{ route('admin.process.destroy', $step) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="admin-btn-danger text-xs rounded-lg px-3 py-1.5"
                                                data-confirm="Delete step '{{ $step->title }}'?">Delete</button>
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

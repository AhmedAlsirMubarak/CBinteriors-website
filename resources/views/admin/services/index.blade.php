@extends('layouts.admin')
@section('title', 'Services')
@section('heading', 'Services')

@section('content')

<div class="flex items-center justify-between mb-5">
    <p class="font-body text-sm text-cb-gray-500">{{ $services->count() }} service(s). Drag rows to reorder.</p>
    <a href="{{ route('admin.services.create') }}" class="admin-btn-primary rounded-lg">+ Add Service</a>
</div>

<div class="admin-card">
    @if($services->isEmpty())
        <p class="px-5 py-12 text-center font-body text-sm text-cb-gray-400">No services yet. <a href="{{ route('admin.services.create') }}" class="underline">Add one</a>.</p>
    @else
        <div class="overflow-x-auto">
        <table class="admin-table" data-sortable="{{ route('admin.services.reorder') }}">
            <thead>
                <tr>
                    <th class="w-8"></th>
                    <th>Service</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr data-id="{{ $service->id }}">
                        <td><span class="drag-handle cursor-grab">⠿</span></td>
                        <td>
                            <div class="flex items-center gap-3">
                                @if($service->imageUrl())
                                    <img src="{{ $service->imageUrl() }}" alt=""
                                         class="w-10 h-10 rounded-lg object-cover shrink-0 border border-cb-gray-200">
                                @endif
                                <div>
                                    <p class="font-medium text-cb-black">{{ $service->title }}</p>
                                    @if($service->short_desc)
                                        <p class="text-xs text-cb-gray-400 truncate max-w-xs">{{ $service->short_desc }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($service->is_featured)
                                <span class="badge-green">Featured</span>
                            @else
                                <span class="badge-gray">No</span>
                            @endif
                        </td>
                        <td>
                            @if($service->active)
                                <span class="badge-green">Active</span>
                            @else
                                <span class="badge-red">Inactive</span>
                            @endif
                        </td>
                        <td class="text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.services.edit', $service) }}"
                                   class="admin-btn-outline text-xs rounded-lg px-3 py-1.5">Edit</a>
                                <form method="POST" action="{{ route('admin.services.destroy', $service) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="admin-btn-danger text-xs rounded-lg px-3 py-1.5"
                                            data-confirm="Delete '{{ $service->title }}'?">Delete</button>
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

@endsection

@extends('layouts.admin')
@section('title', 'Pages')
@section('heading', 'Pages')

@section('content')

<div class="admin-card">
    <div class="px-5 py-4 border-b border-cb-gray-100">
        <p class="font-body text-xs text-cb-gray-500">Edit hero images and metadata for each page.</p>
    </div>
    <div class="overflow-x-auto">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Page</th>
                <th>Slug</th>
                <th>Hero Image</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $page)
                <tr>
                    <td>
                        <p class="font-medium text-cb-black">{{ $page->title }}</p>
                        @if($page->subtitle)
                            <p class="text-cb-gray-400 text-xs mt-0.5 truncate max-w-xs">{{ $page->subtitle }}</p>
                        @endif
                    </td>
                    <td><code class="text-xs bg-cb-gray-100 px-1.5 py-0.5 rounded">{{ $page->slug }}</code></td>
                    <td>
                        @if($page->heroImageUrl())
                            <img src="{{ $page->heroImageUrl() }}" alt=""
                                 class="w-14 h-10 object-cover rounded border border-cb-gray-200">
                        @else
                            <span class="text-cb-gray-400 text-xs">None</span>
                        @endif
                    </td>
                    <td>
                        @if($page->active)
                            <span class="badge-green">Active</span>
                        @else
                            <span class="badge-gray">Hidden</span>
                        @endif
                    </td>
                    <td class="text-right">
                        <a href="{{ route('admin.pages.edit', $page->slug) }}"
                           class="admin-btn-outline text-xs rounded-lg px-3 py-1.5">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

@endsection

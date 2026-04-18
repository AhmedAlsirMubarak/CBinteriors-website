@extends('layouts.admin')
@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')

{{-- Stats grid --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    @foreach([
        ['label' => 'Products',        'value' => $stats['products'],         'route' => 'admin.products.index',  'color' => 'text-blue-600',   'bg' => 'bg-blue-50'],
        ['label' => 'Services',        'value' => $stats['services'],         'route' => 'admin.services.index',  'color' => 'text-purple-600', 'bg' => 'bg-purple-50'],
        ['label' => 'Inquiries',       'value' => $stats['inquiries'],        'route' => 'admin.inquiries.index', 'color' => 'text-green-600',  'bg' => 'bg-green-50'],
        ['label' => 'Unread',          'value' => $stats['unread_inquiries'], 'route' => 'admin.inquiries.index', 'color' => 'text-amber-600',  'bg' => 'bg-amber-50'],
    ] as $stat)
        <a href="{{ route($stat['route']) }}" class="stat-card hover:border-cb-gray-300 transition-colors">
            <div class="w-8 h-8 rounded-lg {{ $stat['bg'] }} flex items-center justify-center mb-3">
                <span class="font-display text-lg font-light {{ $stat['color'] }}">{{ $stat['value'] }}</span>
            </div>
            <p class="font-body text-2xl font-medium text-cb-black">{{ $stat['value'] }}</p>
            <p class="font-body text-xs text-cb-gray-400 tracking-wide uppercase">{{ $stat['label'] }}</p>
        </a>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Recent Inquiries --}}
    <div class="lg:col-span-2 admin-card">
        <div class="flex items-center justify-between px-5 py-4 border-b border-cb-gray-100">
            <h2 class="font-body text-sm font-medium text-cb-black">Recent Inquiries</h2>
            <a href="{{ route('admin.inquiries.index') }}" class="font-body text-xs text-cb-gray-400 hover:text-cb-black transition-colors">View all →</a>
        </div>
        @if($recentInquiries->isEmpty())
            <p class="px-5 py-10 text-center font-body text-sm text-cb-gray-400">No inquiries yet.</p>
        @else
            <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentInquiries as $inquiry)
                        <tr>
                            <td>
                                <a href="{{ route('admin.inquiries.show', $inquiry) }}"
                                   class="font-medium text-cb-black hover:underline">
                                    {{ $inquiry->name }}
                                </a>
                                <p class="text-cb-gray-400 text-xs">{{ $inquiry->email }}</p>
                            </td>
                            <td class="max-w-[180px] truncate">{{ $inquiry->subject ?: '—' }}</td>
                            <td class="whitespace-nowrap">{{ $inquiry->created_at->format('d M Y') }}</td>
                            <td>
                                @if($inquiry->isRead())
                                    <span class="badge-gray">Read</span>
                                @else
                                    <span class="badge-amber">Unread</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        @endif
    </div>

    {{-- Quick links --}}
    <div class="admin-card">
        <div class="px-5 py-4 border-b border-cb-gray-100">
            <h2 class="font-body text-sm font-medium text-cb-black">Quick Actions</h2>
        </div>
        <div class="p-4 flex flex-col gap-2">
            <a href="{{ route('admin.services.create') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg bg-cb-gray-50 hover:bg-cb-gray-100 transition-colors">
                <svg class="w-4 h-4 text-cb-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="font-body text-sm text-cb-gray-700">Add Service</span>
            </a>
            <a href="{{ route('admin.products.create') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg bg-cb-gray-50 hover:bg-cb-gray-100 transition-colors">
                <svg class="w-4 h-4 text-cb-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="font-body text-sm text-cb-gray-700">Add Product</span>
            </a>
            <a href="{{ route('admin.categories.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg bg-cb-gray-50 hover:bg-cb-gray-100 transition-colors">
                <svg class="w-4 h-4 text-cb-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="font-body text-sm text-cb-gray-700">Manage Categories</span>
            </a>
            <a href="{{ route('admin.pages.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg bg-cb-gray-50 hover:bg-cb-gray-100 transition-colors">
                <svg class="w-4 h-4 text-cb-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="font-body text-sm text-cb-gray-700">Edit Pages</span>
            </a>
            <a href="{{ route('admin.settings.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg bg-cb-gray-50 hover:bg-cb-gray-100 transition-colors">
                <svg class="w-4 h-4 text-cb-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="font-body text-sm text-cb-gray-700">Site Settings</span>
            </a>
        </div>
    </div>
</div>

@endsection

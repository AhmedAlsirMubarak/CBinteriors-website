@extends('layouts.admin')
@section('title', 'Inquiries')
@section('heading', 'Inquiries')

@section('content')

<div class="flex flex-wrap items-center justify-between gap-3 mb-5">
    <div class="flex gap-2">
        @foreach(['all' => 'All', 'unread' => 'Unread', 'read' => 'Read'] as $key => $label)
            <a href="{{ route('admin.inquiries.index', ['filter' => $key]) }}"
               class="px-3 py-1.5 rounded-lg text-xs font-body border transition-colors
                      {{ $filter === $key ? 'bg-cb-black text-white border-cb-black' : 'border-cb-gray-300 text-cb-gray-600 hover:border-cb-gray-400' }}">
                {{ $label }}
                @if($key === 'unread' && $unreadCount > 0)
                    <span class="ml-1 px-1.5 py-0.5 rounded-full bg-amber-100 text-amber-700 text-[10px]">{{ $unreadCount }}</span>
                @endif
            </a>
        @endforeach
    </div>
    <p class="font-body text-xs text-cb-gray-400">{{ $unreadCount }} unread</p>
</div>

<div class="admin-card">
    @if($inquiries->isEmpty())
        <p class="px-5 py-12 text-center font-body text-sm text-cb-gray-400">No inquiries found.</p>
    @else
        <table class="admin-table">
            <thead>
                <tr>
                    <th>From</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inquiries as $inquiry)
                    <tr class="{{ !$inquiry->isRead() ? 'bg-amber-50/40' : '' }}">
                        <td>
                            <p class="font-medium text-cb-black {{ !$inquiry->isRead() ? 'font-semibold' : '' }}">
                                {{ $inquiry->name }}
                            </p>
                            <p class="text-xs text-cb-gray-400">{{ $inquiry->email }}</p>
                            @if($inquiry->phone)
                                <p class="text-xs text-cb-gray-400">{{ $inquiry->phone }}</p>
                            @endif
                        </td>
                        <td class="max-w-[220px]">
                            <p class="truncate">{{ $inquiry->subject ?: '(no subject)' }}</p>
                            <p class="text-xs text-cb-gray-400 truncate">{{ Str::limit($inquiry->message, 60) }}</p>
                        </td>
                        <td class="whitespace-nowrap text-sm">{{ $inquiry->created_at->format('d M Y') }}</td>
                        <td>
                            @if($inquiry->isRead())
                                <span class="badge-gray">Read</span>
                            @else
                                <span class="badge-amber">Unread</span>
                            @endif
                        </td>
                        <td class="text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.inquiries.show', $inquiry) }}"
                                   class="admin-btn-outline text-xs rounded-lg px-3 py-1.5">View</a>
                                <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="admin-btn-danger text-xs rounded-lg px-3 py-1.5"
                                            data-confirm="Delete this inquiry?">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if($inquiries->hasPages())
            <div class="px-5 py-4 border-t border-cb-gray-100">
                {{ $inquiries->withQueryString()->links() }}
            </div>
        @endif
    @endif
</div>

@endsection

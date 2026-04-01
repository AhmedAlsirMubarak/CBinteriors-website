@extends('layouts.admin')
@section('title', 'Inquiry — ' . $contact->name)
@section('heading', 'Inquiry from ' . $contact->name)

@section('content')

<div class="max-w-2xl">
    <div class="admin-card p-6 mb-5">

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">
            <div>
                <p class="admin-label">Name</p>
                <p class="font-body text-sm text-cb-black font-medium">{{ $contact->name }}</p>
            </div>
            <div>
                <p class="admin-label">Email</p>
                <a href="mailto:{{ $contact->email }}"
                   class="font-body text-sm text-cb-black hover:underline">{{ $contact->email }}</a>
            </div>
            @if($contact->phone)
                <div>
                    <p class="admin-label">Phone</p>
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contact->phone) }}"
                       class="font-body text-sm text-cb-black hover:underline">{{ $contact->phone }}</a>
                </div>
            @endif
            @if($contact->subject)
                <div>
                    <p class="admin-label">Subject</p>
                    <p class="font-body text-sm text-cb-black">{{ $contact->subject }}</p>
                </div>
            @endif
            <div>
                <p class="admin-label">Received</p>
                <p class="font-body text-sm text-cb-black">{{ $contact->created_at->format('d M Y, H:i') }}</p>
            </div>
            <div>
                <p class="admin-label">Status</p>
                @if($contact->isRead())
                    <span class="badge-green">Read</span>
                @else
                    <span class="badge-amber">Unread</span>
                @endif
            </div>
        </div>

        <div class="border-t border-cb-gray-100 pt-5">
            <p class="admin-label mb-3">Message</p>
            <div class="bg-cb-gray-50 rounded-lg p-4">
                <p class="font-body text-sm text-cb-black leading-relaxed whitespace-pre-wrap">{{ $contact->message }}</p>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap items-center gap-3">
        <a href="mailto:{{ $contact->email }}" class="admin-btn-primary rounded-lg">
            Reply via Email
        </a>
        <a href="{{ route('admin.inquiries.index') }}" class="admin-btn-outline rounded-lg">
            ← Back to Inquiries
        </a>
        <form method="POST" action="{{ route('admin.inquiries.destroy', $contact) }}" class="ml-auto">
            @csrf @method('DELETE')
            <button type="submit" class="admin-btn-danger rounded-lg"
                    data-confirm="Permanently delete this inquiry?">Delete</button>
        </form>
    </div>
</div>

@endsection

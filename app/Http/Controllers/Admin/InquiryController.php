<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $filter   = $request->get('filter', 'all'); // all | unread | read
        $inquiries = Contact::latest()
            ->when($filter === 'unread', fn($q) => $q->unread())
            ->when($filter === 'read',   fn($q) => $q->read())
            ->paginate(20);

        $unreadCount = Contact::unread()->count();

        return view('admin.inquiries.index', compact('inquiries', 'unreadCount', 'filter'));
    }

    public function show(Contact $contact)
    {
        $contact->markAsRead();

        return view('admin.inquiries.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.inquiries.index')
            ->with('success', 'Inquiry deleted.');
    }
}
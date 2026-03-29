<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;

class ContactController extends Controller
{
    public function show()
    {
        $page = Page::findBySlug('contact');

        return view('pages.contact', compact('page'));
    }

    public function store(StoreContactRequest $request)
    {
        Contact::create($request->validated());

        return redirect()->route('contact')
            ->with('success', 'Thank you for reaching out. We will be in touch shortly.');
    }
}
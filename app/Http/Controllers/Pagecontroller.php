<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    /**
     * Generic handler for slug-based static pages: terms, privacy, etc.
     */
    public function show(string $slug)
    {
        $allowed = ['terms', 'privacy'];

        abort_unless(in_array($slug, $allowed), 404);

        $page = Page::findBySlug($slug);

        abort_if(! $page || ! $page->active, 404);

        return view('pages.static', compact('page'));
    }
}
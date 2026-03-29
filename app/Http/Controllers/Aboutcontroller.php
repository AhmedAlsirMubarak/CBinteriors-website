<?php

namespace App\Http\Controllers;

use App\Models\Page;

class AboutController extends Controller
{
    public function index()
    {
        $page = Page::findBySlug('about');

        return view('pages.about', compact('page'));
    }
}
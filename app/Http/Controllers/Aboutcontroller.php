<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\TeamMember;

class AboutController extends Controller
{
    public function index()
    {
        $page = Page::findBySlug('about');
        $team = TeamMember::active()->ordered()->get();

        return view('pages.about', compact('page', 'team'));
    }
}
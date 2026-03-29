<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $page     = Page::findBySlug('services');
        $services = Service::active()->ordered()->get();

        return view('pages.services', compact('page', 'services'));
    }

    public function show(string $slug)
    {
        $service = Service::where('slug', $slug)->where('active', true)->firstOrFail();

        return view('pages.service-detail', compact('service'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Page;

class PartnersController extends Controller
{
    public function index()
    {
        $page    = Page::findBySlug('partners');
        $clients = Client::active()->ordered()->get();
        return view('pages.partners', compact('page', 'clients'));
    }
}

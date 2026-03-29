<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Service;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $page     = Page::findBySlug('home');
        $services = Service::active()->featured()->ordered()->take(6)->get();
        $products = Product::active()->featured()->ordered()->take(8)->get();

        return view('pages.home', compact('page', 'services', 'products'));
    }
}
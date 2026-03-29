<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Service;
use App\Models\Page;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products'        => Product::count(),
            'services'        => Service::count(),
            'pages'           => Page::count(),
            'inquiries'       => Contact::count(),
            'unread_inquiries' => Contact::unread()->count(),
        ];

        $recentInquiries = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentInquiries'));
    }
}
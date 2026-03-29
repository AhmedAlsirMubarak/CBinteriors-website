<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $page       = Page::findBySlug('products');
        $categories = Category::active()->ordered()->get();

        $products = Product::active()
            ->ordered()
            ->with('category')
            ->when($request->category, fn($q) => $q->byCategory($request->category))
            ->when($request->search, fn($q, $s) => $q->where('name', 'like', "%{$s}%"))
            ->paginate(12)
            ->withQueryString();

        return view('pages.products', compact('page', 'products', 'categories'));
    }

    public function show(string $slug)
    {
        $product  = Product::where('slug', $slug)->where('active', true)->with('category')->firstOrFail();
        $related  = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->ordered()
            ->take(4)
            ->get();

        return view('pages.product-detail', compact('product', 'related'));
    }
}
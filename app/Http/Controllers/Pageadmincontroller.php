<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageAdminController extends Controller
{
    public function index()
    {
        $pages = Page::ordered()->get();

        return view('admin.pages.index', compact('pages'));
    }

    public function edit(string $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, string $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'subtitle'         => 'nullable|string|max:255',
            'body'             => 'nullable|string',
            'hero_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'active'           => 'nullable|boolean',
        ]);

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            // Delete old image
            if ($page->hero_image) {
                Storage::disk('public')->delete($page->hero_image);
            }
            $validated['hero_image'] = $request->file('hero_image')
                ->store('pages', 'public');
        }

        $validated['active'] = $request->boolean('active');

        $page->update($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', "Page \"{$page->title}\" updated successfully.");
    }

    /**
     * Remove hero image only (called via DELETE button in UI).
     */
    public function removeHeroImage(string $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        if ($page->hero_image) {
            Storage::disk('public')->delete($page->hero_image);
            $page->update(['hero_image' => null]);
        }

        return back()->with('success', 'Hero image removed.');
    }
}
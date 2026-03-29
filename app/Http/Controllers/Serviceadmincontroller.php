<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceAdminController extends Controller
{
    public function index()
    {
        $services = Service::ordered()->get();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateService($request);
        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['active']      = $request->boolean('active', true);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        // Default sort_order to next available
        $validated['sort_order'] = Service::max('sort_order') + 1;

        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $this->validateService($request, $service->id);
        $validated['slug']        = Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['active']      = $request->boolean('active');

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted.');
    }

    /**
     * PATCH /admin/services/reorder
     * Body: { ids: [3,1,2,4] } — ordered array of IDs from SortableJS
     */
    public function reorder(Request $request)
    {
        $request->validate(['ids' => 'required|array', 'ids.*' => 'integer']);

        foreach ($request->ids as $order => $id) {
            Service::where('id', $id)->update(['sort_order' => $order]);
        }

        return response()->json(['success' => true]);
    }

    private function validateService(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title'       => 'required|string|max:255',
            'short_desc'  => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_featured' => 'nullable|boolean',
            'active'      => 'nullable|boolean',
        ]);
    }
}
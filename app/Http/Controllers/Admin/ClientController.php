<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::ordered()->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'url'    => 'nullable|url|max:255',
            'logo'   => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'active' => 'nullable|boolean',
        ]);

        $validated['active']     = $request->boolean('active', true);
        $validated['sort_order'] = Client::max('sort_order') + 1;

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('clients', 'public');
        }

        Client::create($validated);

        return redirect()->route('admin.clients.index')->with('success', 'Client added.');
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'url'    => 'nullable|url|max:255',
            'logo'   => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'active' => 'nullable|boolean',
        ]);

        $validated['active'] = $request->boolean('active');

        if ($request->hasFile('logo')) {
            if ($client->logo) Storage::disk('public')->delete($client->logo);
            $validated['logo'] = $request->file('logo')->store('clients', 'public');
        }

        $client->update($validated);

        return redirect()->route('admin.clients.index')->with('success', 'Client updated.');
    }

    public function destroy(Client $client)
    {
        if ($client->logo) Storage::disk('public')->delete($client->logo);
        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Client deleted.');
    }

    public function reorder(Request $request)
    {
        $request->validate(['ids' => 'required|array', 'ids.*' => 'integer']);

        foreach ($request->ids as $order => $id) {
            Client::where('id', $id)->update(['sort_order' => $order]);
        }

        return response()->json(['success' => true]);
    }
}

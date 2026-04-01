<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::ordered()->get();
        return view('admin.team.index', compact('members'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'role'       => 'nullable|string|max:255',
            'bio'        => 'nullable|string',
            'photo'      => 'nullable|image|max:3072',
            'sort_order' => 'nullable|integer|min:0',
            'active'     => 'nullable|boolean',
        ]);

        $data['active']     = $request->boolean('active', true);
        $data['sort_order'] = $data['sort_order'] ?? TeamMember::max('sort_order') + 1;

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        TeamMember::create($data);

        return back()->with('success', 'Team member added.');
    }

    public function update(Request $request, TeamMember $team)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'role'       => 'nullable|string|max:255',
            'bio'        => 'nullable|string',
            'photo'      => 'nullable|image|max:3072',
            'sort_order' => 'nullable|integer|min:0',
            'active'     => 'nullable|boolean',
        ]);

        $data['active']     = $request->boolean('active', true);
        $data['sort_order'] = $data['sort_order'] ?? $team->sort_order;

        if ($request->hasFile('photo')) {
            if ($team->photo) Storage::disk('public')->delete($team->photo);
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        $team->update($data);

        return back()->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $team)
    {
        if ($team->photo) Storage::disk('public')->delete($team->photo);
        $team->delete();
        return back()->with('success', 'Team member deleted.');
    }

    public function reorder(Request $request)
    {
        foreach ($request->input('ids', []) as $i => $id) {
            TeamMember::where('id', $id)->update(['sort_order' => $i]);
        }
        return response()->json(['ok' => true]);
    }
}

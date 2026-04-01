<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProcessStep;
use Illuminate\Http\Request;

class ProcessStepController extends Controller
{
    public function index()
    {
        $steps = ProcessStep::ordered()->get();
        return view('admin.process.index', compact('steps'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'step_number' => 'required|integer|min:1',
            'active'      => 'nullable|boolean',
        ]);

        $validated['active']     = $request->boolean('active', true);
        $validated['sort_order'] = ProcessStep::max('sort_order') + 1;

        ProcessStep::create($validated);

        return redirect()->route('admin.process.index')->with('success', 'Step added.');
    }

    public function update(Request $request, ProcessStep $process)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'step_number' => 'required|integer|min:1',
            'active'      => 'nullable|boolean',
        ]);

        $validated['active'] = $request->boolean('active');
        $process->update($validated);

        return redirect()->route('admin.process.index')->with('success', 'Step updated.');
    }

    public function destroy(ProcessStep $process)
    {
        $process->delete();
        return redirect()->route('admin.process.index')->with('success', 'Step deleted.');
    }

    public function reorder(Request $request)
    {
        $request->validate(['ids' => 'required|array', 'ids.*' => 'integer']);

        foreach ($request->ids as $order => $id) {
            ProcessStep::where('id', $id)->update(['sort_order' => $order]);
        }

        return response()->json(['success' => true]);
    }
}

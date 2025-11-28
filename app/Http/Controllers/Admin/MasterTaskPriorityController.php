<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterTaskPriority;
use Illuminate\Http\Request;

class MasterTaskPriorityController extends Controller
{
    public function index()
    {
        $priorities = MasterTaskPriority::orderBy('weight')->get();
        return view('admin.master.priorities', compact('priorities'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|max:50|unique:master_task_priorities,code',
            'label' => 'required|string|max:100',
            'color' => 'nullable|string|max:20',
            'weight' => 'required|integer|min:0|max:255',
            'is_default' => 'boolean',
        ]);

        $data['is_default'] = $request->boolean('is_default');

        MasterTaskPriority::create($data);

        return back()->with('success', 'Prioritas berhasil ditambahkan.');
    }

    public function update(Request $request, MasterTaskPriority $priority)
    {
        $data = $request->validate([
            'label' => 'required|string|max:100',
            'color' => 'nullable|string|max:20',
            'weight' => 'required|integer|min:0|max:255',
            'is_default' => 'boolean',
        ]);

        $data['is_default'] = $request->boolean('is_default');

        $priority->update($data);

        return back()->with('success', 'Prioritas diperbarui.');
    }

    public function destroy(MasterTaskPriority $priority)
    {
        $priority->delete();
        return back()->with('success', 'Prioritas dihapus.');
    }
}

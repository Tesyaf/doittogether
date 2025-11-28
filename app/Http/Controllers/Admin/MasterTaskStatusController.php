<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterTaskStatus;
use Illuminate\Http\Request;

class MasterTaskStatusController extends Controller
{
    public function index()
    {
        $statuses = MasterTaskStatus::orderBy('weight', 'asc')->orderBy('id')->get();
        return view('admin.master.statuses', compact('statuses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|max:50|unique:master_task_statuses,code',
            'label' => 'required|string|max:100',
            'color' => 'nullable|string|max:20',
            'is_default' => 'boolean',
            'weight' => 'nullable|integer|min:0|max:255',
        ]);

        $data['is_default'] = $request->boolean('is_default');
        $data['weight'] = $data['weight'] ?? 0;

        MasterTaskStatus::create($data);

        return back()->with('success', 'Status berhasil ditambahkan.');
    }

    public function update(Request $request, MasterTaskStatus $status)
    {
        $data = $request->validate([
            'label' => 'required|string|max:100',
            'color' => 'nullable|string|max:20',
            'is_default' => 'boolean',
            'weight' => 'nullable|integer|min:0|max:255',
        ]);

        $data['is_default'] = $request->boolean('is_default');
        $data['weight'] = $data['weight'] ?? 0;

        $status->update($data);

        return back()->with('success', 'Status diperbarui.');
    }

    public function destroy(MasterTaskStatus $status)
    {
        $status->delete();
        return back()->with('success', 'Status dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function create(Team $team)
    {
        $this->ensureMember($team);

        return view('categories.create', compact('team'));
    }

    public function store(Request $request, Team $team)
    {
        $this->ensureMember($team);

        $data = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,NULL,id,team_id,' . $team->id,
        ]);

        Category::create([
            'team_id' => $team->id,
            'name' => $data['name'],
        ]);

        return redirect()->route('teams.dashboard', $team->id)
            ->with('success', 'Kategori berhasil dibuat!');
    }

    public function edit(Team $team, Category $category)
    {
        $this->ensureMember($team);
        abort_unless($category->team_id === $team->id, 403);

        return view('categories.edit', compact('team', 'category'));
    }

    public function update(Request $request, Team $team, Category $category)
    {
        $this->ensureMember($team);
        abort_unless($category->team_id === $team->id, 403);

        $data = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id . ',id,team_id,' . $team->id,
        ]);

        $category->update($data);

        return back()->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Team $team, Category $category)
    {
        $this->ensureMember($team);
        abort_unless($category->team_id === $team->id, 403);

        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus!');
    }

    private function ensureMember(Team $team)
    {
        abort_unless(
            $team->members()->where('user_id', Auth::id())->exists(),
            403
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Team $team)
    {
        $this->ensureOwner($team);

        $categoryList = $team->categories()
            ->withCount('tasks')
            ->orderBy('name')
            ->get();

        return view('categories.index', compact('team', 'categoryList'));
    }

    public function create(Team $team)
    {
        $this->ensureOwner($team);

        return view('categories.create', compact('team'));
    }

    public function store(Request $request, Team $team)
    {
        $this->ensureOwner($team);

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
        $this->ensureOwner($team);
        abort_unless($category->team_id === $team->id, 403);

        return view('categories.edit', compact('team', 'category'));
    }

    public function update(Request $request, Team $team, Category $category)
    {
        $this->ensureOwner($team);
        abort_unless($category->team_id === $team->id, 403);

        $data = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id . ',id,team_id,' . $team->id,
        ]);

        $category->update($data);

        return back()->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Team $team, Category $category)
    {
        $this->ensureOwner($team);
        abort_unless($category->team_id === $team->id, 403);

        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus!');
    }

    private function ensureOwner(Team $team)
    {
        $isOwner = $team->members()
            ->where('user_id', Auth::id())
            ->where('role', 'owner')
            ->exists();

        abort_unless($isOwner || Auth::user()?->is_admin, 403);
    }
}

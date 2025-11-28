<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TeamController extends Controller
{
    /**
     * Display all teams the user belongs to.
     */
    public function index()
    {
        $teams = Auth::user()->teams()->orderBy('name')->get();

        return view('teams.index', compact('teams'));
    }

    /**
     * Show create team page.
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a new team.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:500'],
            'icon_url' => ['nullable', 'string', 'max:1024'],
        ]);

        $user = Auth::user();

        // generate secure team code
        $teamCode = Str::uuid();

        // create team
        $team = Team::create([
            'name' => $validated['name'],
            'team_code' => $teamCode,
            'created_by' => $user->id,
        ]);

        // update icon or description if provided
        if (!empty($validated['icon_url'])) {
            $team->icon_url = $validated['icon_url'];
        }
        if (!empty($validated['description'])) {
            $team->description = $validated['description'];
        }
        $team->save();

        // register creator as OWNER in pivot table
        TeamMember::create([
            'id_member' => Str::uuid()->toString(),
            'team_id' => $team->id,
            'user_id' => $user->id,
            'role' => 'owner',
            'joined_at' => now(),
        ]);

        // set selected team in session
        session(['team_id' => $team->id]);

        return redirect()->route('dashboard')
                         ->with('success', 'Tim berhasil dibuat!');
    }

    /**
     * Switch active team.
     */
    public function switch($teamId)
    {
        $user = Auth::user();

        // verify user is member of the team
        $isMember = $user->teams()->where('teams.id', $teamId)->exists();

        if (! $isMember) {
            abort(403, 'Anda tidak terdaftar pada tim ini.');
        }

        session(['team_id' => $teamId]);

        return redirect()->route('dashboard')
                         ->with('success', 'Berhasil berpindah tim.');
    }

    /**
     * Edit team (owner only).
     */
    public function edit(Team $team)
    {
        $this->authorizeOwner($team);

        return view('teams.edit', compact('team'));
    }

    /**
     * Update team info.
     */
    public function update(Request $request, Team $team)
    {
        $this->authorizeOwner($team);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:500'],
            'icon_url' => ['nullable', 'string', 'max:1024'],
        ]);

        $team->update($validated);

        return redirect()->route('teams.edit', $team)
                         ->with('success', 'Data tim berhasil diperbarui.');
    }

    /**
     * Helper: ensure active user is owner of the team.
     */
    private function authorizeOwner(Team $team)
    {
        $user = Auth::user();

        $isOwner = $team->members()
            ->where('user_id', $user->id)
            ->where('role', 'owner')
            ->exists();

        abort_if(! $isOwner, 403, 'Hanya pemilik tim yang bisa melakukan tindakan ini.');
    }
}

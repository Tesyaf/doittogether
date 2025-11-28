<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Auth::user()->teams()->orderBy('name')->get();
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:150',
            'description' => 'nullable|max:500',
            'icon_url' => 'nullable|string|max:1024',
        ]);

        $user = Auth::user();

        $team = Team::create([
            'id' => Str::uuid(),
            'name' => $data['name'],
            'team_code' => Str::uuid(),
            'created_by' => $user->id,
        ]);

        TeamMember::create([
            'id_member' => Str::uuid(),
            'team_id' => $team->id,
            'user_id' => $user->id,
            'role' => 'owner',
            'joined_at' => now(),
        ]);

        session(['team_id' => $team->id]);

        return redirect()->route('teams.dashboard', $team->id)
                         ->with('success', 'Tim berhasil dibuat!');
    }

    public function switch($id)
    {
        $user = Auth::user();

        if (!$user->teams()->where('teams.id', $id)->exists()) {
            abort(403);
        }

        session(['team_id' => $id]);

        return redirect()->route('teams.dashboard', $id);
    }

    public function dashboard(Team $team)
    {
        $this->ensureMember($team);
        return view('teams.dashboard', compact('team'));
    }

    public function members(Team $team)
    {
        $this->ensureMember($team);
        $members = $team->members()->with('user')->get();
        return view('teams.members', compact('team', 'members'));
    }

    public function invite(Team $team)
    {
        $this->ensureOwner($team);
        return view('teams.invite', compact('team'));
    }

    public function pendingInvitations(Team $team)
    {
        $this->ensureOwner($team);
        $invitations = $team->invitations()->get();
        return view('teams.pending-invitations', compact('team', 'invitations'));
    }

    public function activityLog(Team $team)
    {
        $this->ensureMember($team);
        $logs = $team->members()->with('activityLogs')->get();
        return view('teams.activity-log', compact('team', 'logs'));
    }

    public function notifications(Team $team)
    {
        $this->ensureMember($team);
        return view('teams.notifications', compact('team'));
    }

    public function settings(Team $team)
    {
        $this->ensureOwner($team);
        return view('teams.settings', compact('team'));
    }

    public function updateSettings(Request $request, Team $team)
    {
        $this->ensureOwner($team);

        $data = $request->validate([
            'name' => 'required|max:150',
            'description' => 'nullable|max:500',
            'icon_url' => 'nullable|max:1024',
        ]);

        $team->update($data);

        return back()->with('success', 'Pengaturan tim diperbarui.');
    }

    private function ensureMember(Team $team)
    {
        abort_unless(
            $team->members()->where('user_id', Auth::id())->exists(),
            403
        );
    }

    private function ensureOwner(Team $team)
    {
        abort_unless(
            $team->members()->where('user_id', Auth::id())->where('role', 'owner')->exists(),
            403
        );
    }
}

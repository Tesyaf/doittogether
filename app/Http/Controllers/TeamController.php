<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamMember;
use App\Models\TeamInvitation;
use App\Models\ActivityLog;
use App\Mail\TeamInvitationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

        // Get recent tasks
        $recentTasks = $team->tasks()
            ->with(['category', 'creator', 'responsible'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get recent activity logs
        $activityLogs = ActivityLog::where(function ($query) use ($team) {
            $query->where('entity_type', 'task')
                ->orWhere('entity_type', 'team');
        })
            ->with('actor.user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Get team members with count
        $members = $team->members()->with('user')->limit(5)->get();
        $totalMembers = $team->members()->count();

        // Get task stats
        $taskStats = [
            'total' => $team->tasks()->count(),
            'done' => $team->tasks()->where('status', 'done')->count(),
            'in_progress' => $team->tasks()->where('status', 'in_progress')->count(),
            'todo' => $team->tasks()->where('status', 'todo')->count(),
        ];

        return view('teams.dashboard', compact('team', 'recentTasks', 'activityLogs', 'members', 'totalMembers', 'taskStats'));
    }

    public function members(Team $team)
    {
        $this->ensureOwnerOrAdmin($team);
        $members = $team->members()->with('user')->get();
        return view('teams.members', compact('team', 'members'));
    }

    public function invite(Team $team)
    {
        $this->ensureOwnerOrAdmin($team);
        $pendingInvitations = $team->invitations()
            ->where('status', 'pending')
            ->orderByDesc('created_at')
            ->get();

        return view('teams.invite', compact('team', 'pendingInvitations'));
    }

    public function sendInvite(Request $request, Team $team)
    {
        $this->ensureOwnerOrAdmin($team);

        $data = $request->validate([
            'email' => 'required|email',
            'role' => 'required|in:member,admin',
            'expires_at' => 'nullable|date|after:today',
        ]);

        $currentMember = $team->members()->where('user_id', Auth::id())->firstOrFail();

        // Cegah mengundang anggota yang sudah ada
        $alreadyMember = $team->members()
            ->whereRelation('user', 'email', $data['email'])
            ->exists();

        if ($alreadyMember) {
            return back()->withErrors(['email' => 'Email sudah tergabung dalam tim ini.'])->withInput();
        }

        // Cegah undangan duplikat (email terenkripsi, jadi filter di PHP)
        $existingPending = $team->invitations()
            ->where('status', 'pending')
            ->get()
            ->first(function ($invite) use ($data) {
                return strtolower($invite->email) === strtolower($data['email']);
            });

        if ($existingPending) {
            return back()->withErrors(['email' => 'Undangan untuk email ini masih pending.'])->withInput();
        }

        $invitation = $team->invitations()->create([
            'email' => strtolower($data['email']),
            'code' => Str::uuid(),
            'invited_by_member' => $currentMember->id_member,
            'role' => $data['role'],
            'expires_at' => $data['expires_at'],
            'created_at' => now(),
        ]);

        if ($invitation) {
            Mail::to($data['email'])->send(
                new TeamInvitationMail($team, $invitation, Auth::user()->name ?? 'Admin')
            );
        }

        return redirect()->route('teams.invite', $team->id)
            ->with('success', 'Undangan berhasil dikirim.');
    }

    public function pendingInvitations(Team $team)
    {
        $this->ensureOwnerOrAdmin($team);
        $invitations = $team->invitations()
            ->where('status', 'pending')
            ->orderByDesc('created_at')
            ->get();
        return view('teams.pending-invitations', compact('team', 'invitations'));
    }

    public function resendInvitation(Team $team, TeamInvitation $invitation)
    {
        $this->ensureOwnerOrAdmin($team);
        abort_unless($invitation->team_id === $team->id, 404);

        if ($invitation->status !== 'pending') {
            return back()->withErrors(['invite' => 'Undangan tidak bisa dikirim ulang.']);
        }

        $invitation->code = Str::uuid();
        $invitation->created_at = now();
        $invitation->save();

        Mail::to($invitation->email)->send(
            new TeamInvitationMail($team, $invitation, Auth::user()->name ?? 'Admin')
        );

        return back()->with('success', 'Undangan dikirim ulang.');
    }

    public function cancelInvitation(Team $team, TeamInvitation $invitation)
    {
        $this->ensureOwnerOrAdmin($team);
        abort_unless($invitation->team_id === $team->id, 404);

        if ($invitation->status !== 'pending') {
            return back()->withErrors(['invite' => 'Undangan sudah tidak aktif.']);
        }

        $invitation->status = 'revoked';
        $invitation->save();

        return back()->with('success', 'Undangan dibatalkan.');
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
        $this->ensureOwnerOrAdmin($team);
        return view('teams.settings', compact('team'));
    }

    public function updateSettings(Request $request, Team $team)
    {
        $this->ensureOwnerOrAdmin($team);

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

    private function ensureOwnerOrAdmin(Team $team)
    {
        abort_unless(
            $team->members()
                ->where('user_id', Auth::id())
                ->whereIn('role', ['owner', 'admin'])
                ->exists(),
            403
        );
    }
}

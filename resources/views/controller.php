<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Task;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // BOARD (KANBAN)
    public function board(Team $team)
    {
        $tasks = Task::where('team_id', $team->id)->get()->groupBy('status');

        return view('tasks.board', compact('team', 'tasks'));
    }

    // LIST VIEW
    public function index(Team $team)
    {
        $tasks = Task::where('team_id', $team->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('tasks.list', compact('team', 'tasks'));
    }

    // CALENDAR VIEW
    public function calendar(Team $team)
    {
        $tasks = Task::where('team_id', $team->id)
            ->whereNotNull('due_at')
            ->orderBy('due_at')
            ->get();

        return view('tasks.calendar', compact('team', 'tasks'));
    }

    // MY TASKS
    public function my(Team $team)
    {
        $member = TeamMember::where('team_id', $team->id)
            ->where('user_id', Auth::id())
            ->first();

        if (! $member) {
            abort(403, 'Kamu bukan anggota tim ini.');
        }

        $tasks = Task::where('team_id', $team->id)
            ->where(function ($q) use ($member) {
                $q->where('created_by_member_id', $member->id_member)
                  ->orWhere('responsible_member_id', $member->id_member);
            })
            ->orderBy('due_at')
            ->get();

        return view('tasks.my', compact('team', 'tasks'));
    }

    // DETAIL TASK
    public function show(Team $team, Task $task)
    {
        if ($task->team_id !== $team->id) {
            abort(404);
        }

        // nanti bisa load relasi: comments, attachments, assignees, dll
        return view('tasks.show', compact('team', 'task'));
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TeamJoinController extends Controller
{
    public function create()
    {
        return view('teams.join');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string'],
        ]);

        $team = Team::where('team_code', $request->code)->first();

        if (! $team) {
            return back()
                ->withErrors(['code' => 'Kode tim tidak ditemukan.'])
                ->withInput();
        }

        $alreadyMember = TeamMember::where('team_id', $team->id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($alreadyMember) {
            return redirect()
                ->route('dashboard')
                ->with('status', 'Kamu sudah tergabung di tim ini.');
        }

        TeamMember::create([
            'id_member' => Str::uuid(),
            'team_id' => $team->id,
            'user_id' => Auth::id(),
            'role' => 'member',
        ]);

        return redirect()
            ->route('dashboard')
            ->with('status', 'Berhasil bergabung ke tim.');
    }
}

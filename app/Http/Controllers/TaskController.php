<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Team;
use App\Models\Category;
use App\Models\TeamMember;
use App\Models\TaskComment;
use App\Models\TaskAttachment;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function index(Team $team, Request $request)
    {
        $this->ensureMember($team);

        $currentMember = $team->members()->where('user_id', Auth::id())->first();

        $query = $team->tasks()->with(['category', 'creator', 'responsible']);

        // Filter: Tugas Saya
        if ($request->boolean('assigned_to_me')) {
            $query->where(function ($q) use ($currentMember) {
                $q->where('responsible_member_id', $currentMember->id_member)
                    ->orWhereHas('assignees', function ($subQ) use ($currentMember) {
                        $subQ->where('member_id', $currentMember->id_member);
                    });
            });
        }

        // Filter: By Member
        if ($request->has('member_id') && $request->filled('member_id')) {
            $query->where('responsible_member_id', $request->member_id);
        }

        // Filter: By Category
        if ($request->has('category_id') && $request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter: By Status
        if ($request->has('status') && $request->filled('status')) {
            $query->where('status', $request->status);
        }

        $tasks = $query->orderBy('due_at')->paginate(15);
        $categories = $team->categories()->orderBy('name')->get();
        $team_members = $team->members()->with('user')->get();

        return view('tasks.index', compact('team', 'tasks', 'categories', 'team_members'));
    }

    public function create(Team $team)
    {
        $this->ensureMember($team);

        $categories = $team->categories()->orderBy('name')->get();
        $members = $team->members()->with('user')->orderBy('user_id')->get();

        return view('tasks.create', compact('team', 'categories', 'members'));
    }

    public function store(Request $request, Team $team)
    {
        $this->ensureMember($team);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'responsible_member_id' => 'nullable|exists:team_members,id_member',
            'due_at' => 'nullable|date',
            'status' => 'required|in:todo,in_progress,done',
        ]);

        $currentMember = $team->members()->where('user_id', Auth::id())->first();

        $task = Task::create([
            'id' => Str::uuid(),
            'team_id' => $team->id,
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'due_at' => $data['due_at'],
            'status' => $data['status'],
            'created_by_member_id' => $currentMember->id_member,
            'responsible_member_id' => $data['responsible_member_id'],
        ]);

        // Log activity
        ActivityLog::create([
            'actor_member_id' => $currentMember->id_member,
            'action' => 'created',
            'entity_type' => 'task',
            'entity_id' => $task->id,
            'meta' => json_encode(['title' => $task->title]),
        ]);

        return redirect()->route('tasks.show', ['team' => $team->id, 'task' => $task->id])
            ->with('success', 'Task berhasil dibuat!');
    }

    public function show(Team $team, Task $task)
    {
        $this->ensureMember($team);
        abort_unless($task->team_id === $team->id, 403);

        $task->load(['category', 'creator', 'responsible', 'comments.member.user', 'attachments.member.user', 'assignees.user']);
        $activityLogs = ActivityLog::where('entity_type', 'task')
            ->where('entity_id', $task->id)
            ->with('actor.user')
            ->orderBy('created_at', 'desc')
            ->get();

        $members = $team->members()->with('user')->orderBy('user_id')->get();

        return view('tasks.show', compact('team', 'task', 'activityLogs', 'members'));
    }

    public function edit(Team $team, Task $task)
    {
        $this->ensureMember($team);
        abort_unless($task->team_id === $team->id, 403);

        $categories = $team->categories()->orderBy('name')->get();
        $members = $team->members()->with('user')->orderBy('user_id')->get();

        return view('tasks.edit', compact('team', 'task', 'categories', 'members'));
    }

    public function update(Request $request, Team $team, Task $task)
    {
        $this->ensureMember($team);
        abort_unless($task->team_id === $team->id, 403);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'responsible_member_id' => 'nullable|exists:team_members,id_member',
            'due_at' => 'nullable|date',
            'status' => 'required|in:todo,in_progress,done',
        ]);

        $task->update($data);

        $currentMember = $team->members()->where('user_id', Auth::id())->first();

        // Log activity
        ActivityLog::create([
            'actor_member_id' => $currentMember->id_member,
            'action' => 'updated',
            'entity_type' => 'task',
            'entity_id' => $task->id,
            'meta' => json_encode(['changes' => array_keys($data)]),
        ]);

        return redirect()->route('tasks.show', ['team' => $team->id, 'task' => $task->id])
            ->with('success', 'Task berhasil diperbarui!');
    }

    public function destroy(Team $team, Task $task)
    {
        $this->ensureMember($team);
        abort_unless($task->team_id === $team->id, 403);

        $currentMember = $team->members()->where('user_id', Auth::id())->first();

        // Log activity
        ActivityLog::create([
            'actor_member_id' => $currentMember->id_member,
            'action' => 'deleted',
            'entity_type' => 'task',
            'entity_id' => $task->id,
            'meta' => json_encode(['title' => $task->title]),
        ]);

        $task->delete();

        return redirect()->route('tasks.index', $team->id)
            ->with('success', 'Task berhasil dihapus!');
    }

    private function ensureMember(Team $team)
    {
        abort_unless(
            $team->members()->where('user_id', Auth::id())->exists(),
            403
        );
    }
}

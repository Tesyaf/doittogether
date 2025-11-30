<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Team;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskAssigneeController extends Controller
{
    public function store(Request $request, Team $team, Task $task)
    {
        $this->ensureMember($team);
        abort_unless($task->team_id === $team->id, 403);

        $data = $request->validate([
            'member_id' => 'required|exists:team_members,id_member',
        ]);

        // Check if member is part of this team
        $member = $team->members()->where('id_member', $data['member_id'])->first();
        abort_unless($member, 403);

        // Add assignee if not already assigned
        if (!$task->assignees()->where('member_id', $data['member_id'])->exists()) {
            $task->assignees()->attach($data['member_id']);

            $currentMember = $team->members()->where('user_id', Auth::id())->first();

            // Log activity
            ActivityLog::create([
                'actor_member_id' => $currentMember->id_member,
                'action' => 'assigned',
                'entity_type' => 'task',
                'entity_id' => $task->id,
                'meta' => json_encode(['assigned_member' => $member->user->name]),
            ]);
        }

        return back()->with('success', 'Assignee berhasil ditambahkan!');
    }

    public function destroy(Team $team, Task $task, $memberId)
    {
        $this->ensureMember($team);
        abort_unless($task->team_id === $team->id, 403);

        $task->assignees()->detach($memberId);

        $currentMember = $team->members()->where('user_id', Auth::id())->first();
        $member = $team->members()->where('id_member', $memberId)->first();

        // Log activity
        ActivityLog::create([
            'actor_member_id' => $currentMember->id_member,
            'action' => 'unassigned',
            'entity_type' => 'task',
            'entity_id' => $task->id,
            'meta' => json_encode(['removed_member' => $member?->user->name]),
        ]);

        return back()->with('success', 'Assignee berhasil dihapus!');
    }

    private function ensureMember(Team $team)
    {
        abort_unless(
            $team->members()->where('user_id', Auth::id())->exists(),
            403
        );
    }
}

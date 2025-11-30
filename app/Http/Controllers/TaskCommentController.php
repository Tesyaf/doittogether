<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Team;
use App\Models\TaskComment;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TaskCommentController extends Controller
{
    public function store(Request $request, Team $team, Task $task)
    {
        $this->ensureMember($team);
        abort_unless($task->team_id === $team->id, 403);

        $data = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $currentMember = $team->members()->where('user_id', Auth::id())->first();

        $comment = TaskComment::create([
            'task_id' => $task->id,
            'member_id' => $currentMember->id_member,
            'body' => $data['body'],
        ]);

        // Log activity
        ActivityLog::create([
            'actor_member_id' => $currentMember->id_member,
            'action' => 'commented',
            'entity_type' => 'task',
            'entity_id' => $task->id,
            'meta' => json_encode(['comment' => $data['body']]),
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    private function ensureMember(Team $team)
    {
        abort_unless(
            $team->members()->where('user_id', Auth::id())->exists(),
            403
        );
    }
}

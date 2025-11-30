<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Team;
use App\Models\TaskAttachment;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TaskAttachmentController extends Controller
{
    public function store(Request $request, Team $team, Task $task)
    {
        $this->ensureMember($team);
        abort_unless($task->team_id === $team->id, 403);

        $data = $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
        ]);

        $currentMember = $team->members()->where('user_id', Auth::id())->first();

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store("tasks/{$task->id}", 'public');
        $fileUrl = Storage::url($filePath);

        $attachment = TaskAttachment::create([
            'id' => Str::uuid(),
            'task_id' => $task->id,
            'member_id' => $currentMember->id_member,
            'file_name' => $fileName,
            'file_url' => $fileUrl,
        ]);

        // Log activity
        ActivityLog::create([
            'actor_member_id' => $currentMember->id_member,
            'action' => 'uploaded',
            'entity_type' => 'task',
            'entity_id' => $task->id,
            'meta' => json_encode(['file' => $fileName]),
        ]);

        return back()->with('success', 'File berhasil diunggah!');
    }

    public function destroy(Team $team, Task $task, TaskAttachment $attachment)
    {
        $this->ensureMember($team);
        abort_unless($task->team_id === $team->id, 403);

        $currentMember = $team->members()->where('user_id', Auth::id())->first();

        // Delete file from storage
        Storage::delete(str_replace('/storage/', 'public/', $attachment->file_url));

        // Log activity
        ActivityLog::create([
            'actor_member_id' => $currentMember->id_member,
            'action' => 'deleted',
            'entity_type' => 'attachment',
            'entity_id' => $attachment->id,
            'meta' => json_encode(['file' => $attachment->file_name]),
        ]);

        $attachment->delete();

        return back()->with('success', 'File berhasil dihapus!');
    }

    private function ensureMember(Team $team)
    {
        abort_unless(
            $team->members()->where('user_id', Auth::id())->exists(),
            403
        );
    }
}

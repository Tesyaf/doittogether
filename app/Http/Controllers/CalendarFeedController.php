<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Response;

class CalendarFeedController extends Controller
{
    public function feed(string $token): Response
    {
        $user = User::where('calendar_token', $token)->firstOrFail();

        // Ambil semua task yang punya due_at dari tim yang diikuti user
        $teamIds = $user->teams()->pluck('teams.id');
        $tasks = Task::whereIn('team_id', $teamIds)
            ->whereNotNull('due_at')
            ->with('team')
            ->orderBy('due_at')
            ->get();

        $lines = [
            'BEGIN:VCALENDAR',
            'VERSION:2.0',
            'PRODID:-//DoItTogether//Team Tasks//EN',
            'CALSCALE:GREGORIAN',
            'METHOD:PUBLISH',
            'X-WR-CALNAME:DoItTogether Deadlines',
            'X-WR-TIMEZONE:UTC',
        ];

        foreach ($tasks as $task) {
            $start = $task->due_at->copy()->utc();
            $end = $task->due_at->copy()->addHour()->utc();
            $lines = array_merge($lines, [
                'BEGIN:VEVENT',
                'UID:' . $task->id . '@doittogether.local',
                'DTSTAMP:' . $start->format('Ymd\THis\Z'),
                'DTSTART:' . $start->format('Ymd\THis\Z'),
                'DTEND:' . $end->format('Ymd\THis\Z'),
                'SUMMARY:' . $this->escapeText($task->title),
                'DESCRIPTION:' . $this->escapeText($task->description ?? '') . '\\nTeam: ' . ($task->team->name ?? '-'),
                'END:VEVENT',
            ]);
        }

        $lines[] = 'END:VCALENDAR';
        $content = implode("\r\n", $lines);

        return response($content, 200, [
            'Content-Type' => 'text/calendar; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="doittogether.ics"',
        ]);
    }

    private function escapeText(string $text): string
    {
        $text = str_replace(["\r\n", "\r", "\n"], '\\n', $text);
        return addcslashes($text, ',;\\');
    }
}

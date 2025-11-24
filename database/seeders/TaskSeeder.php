<?php

namespace Database\Seeders;

use App\Models\{Task, Team, TeamMember, TaskComment};
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $teams = Team::all();

        foreach ($teams as $team) {
            $members = TeamMember::where('team_id', $team->id)->get();

            Task::factory(5)->create([
                'team_id' => $team->id,
                'created_by_member_id' => $members->first()->id_member,
                'responsible_member_id' => $members->random()->id_member,
            ])->each(function ($task) use ($members) {
                // Tambahkan 2 komentar random
                TaskComment::factory(2)->create([
                    'task_id' => $task->id,
                    'member_id' => $members->random()->id_member,
                ]);
            });
        }
    }
}

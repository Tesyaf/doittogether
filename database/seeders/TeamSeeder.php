<?php

namespace Database\Seeders;

use App\Models\{Team, TeamMember, User};
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $owner = $users->first();

        // Buat 2 tim contoh
        Team::factory(2)->create(['created_by' => $owner->id])
            ->each(function ($team) use ($users, $owner) {
                // Owner jadi anggota
                TeamMember::factory()->create([
                    'team_id' => $team->id,
                    'user_id' => $owner->id,
                    'role' => 'owner',
                ]);

                // Tambahkan 3 anggota lain
                $users->skip(1)->take(3)->each(function ($u) use ($team) {
                    TeamMember::factory()->create([
                        'team_id' => $team->id,
                        'user_id' => $u->id,
                        'role' => 'member',
                    ]);
                });
            });
    }
}
<?php

namespace Database\Seeders;

use App\Models\{Notification, User};
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        User::all()->each(function ($user) {
            Notification::factory(2)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
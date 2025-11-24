<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TeamMemberFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_member' => Str::uuid(),
            'role' => fake()->randomElement(['member']),
            'joined_at' => now(),
        ];
    }
}

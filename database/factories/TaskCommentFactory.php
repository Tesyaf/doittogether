<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskCommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'body' => fake()->sentence(10),
            'created_at' => now(),
        ];
    }
}

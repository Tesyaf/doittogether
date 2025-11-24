<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'message' => fake()->sentence(10),
            'is_read' => fake()->boolean(20), // 20% sudah dibaca
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

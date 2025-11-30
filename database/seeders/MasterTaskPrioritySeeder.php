<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterTaskPriority;

class MasterTaskPrioritySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['code' => 'low', 'label' => 'Low', 'color' => '#38bdf8', 'weight' => 1, 'is_default' => true],
            ['code' => 'medium', 'label' => 'Medium', 'color' => '#f59e0b', 'weight' => 2],
            ['code' => 'high', 'label' => 'High', 'color' => '#f97316', 'weight' => 3],
            ['code' => 'urgent', 'label' => 'Urgent', 'color' => '#ef4444', 'weight' => 4],
        ];

        foreach ($data as $item) {
            MasterTaskPriority::updateOrCreate(['code' => $item['code']], $item);
        }
    }
}

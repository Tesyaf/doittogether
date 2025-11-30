<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterTaskStatus;

class MasterTaskStatusSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['code' => 'todo', 'label' => 'To Do', 'color' => '#94a3b8', 'is_default' => true],
            ['code' => 'in_progress', 'label' => 'In Progress', 'color' => '#fbbf24'],
            ['code' => 'done', 'label' => 'Done', 'color' => '#34d399'],
        ];

        foreach ($data as $item) {
            MasterTaskStatus::updateOrCreate(['code' => $item['code']], $item);
        }
    }
}

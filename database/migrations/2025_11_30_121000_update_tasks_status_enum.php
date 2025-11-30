<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Drop old enum check then align statuses with current UI
        DB::statement('ALTER TABLE tasks DROP CONSTRAINT IF EXISTS tasks_status_check;');
        DB::statement("ALTER TABLE tasks ALTER COLUMN status TYPE VARCHAR(20);");

        // Map legacy value
        DB::statement("UPDATE tasks SET status = 'in_progress' WHERE status = 'ongoing';");

        DB::statement("ALTER TABLE tasks ADD CONSTRAINT tasks_status_check CHECK (status IN ('todo','in_progress','done','canceled','archived'));");
        DB::statement("ALTER TABLE tasks ALTER COLUMN status SET DEFAULT 'todo';");
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE tasks DROP CONSTRAINT IF EXISTS tasks_status_check;');

        // Revert mapped value
        DB::statement("UPDATE tasks SET status = 'ongoing' WHERE status = 'in_progress';");

        DB::statement("ALTER TABLE tasks ADD CONSTRAINT tasks_status_check CHECK (status IN ('ongoing','done','canceled','archived'));");
        DB::statement("ALTER TABLE tasks ALTER COLUMN status SET DEFAULT 'ongoing';");
    }
};

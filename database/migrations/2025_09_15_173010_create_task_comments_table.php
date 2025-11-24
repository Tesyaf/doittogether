<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('task_comments', function (Blueprint $table) {
            $table->id();

            // relasi ke tasks.id (UUID)
            $table->foreignUuid('task_id')
                  ->constrained('tasks')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            // relasi ke team_members.id_member (UUID, bukan id default)
            $table->foreignUuid('member_id')
                  ->references('id_member')->on('team_members')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            $table->text('body');
            $table->timestamps(); // lebih fleksibel daripada created_at saja

            $table->index(['task_id', 'member_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('task_comments');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('task_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('member_id');
            $table->text('body');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('member_id')
                  ->references('id_member')->on('team_members')
                  ->cascadeOnUpdate()->cascadeOnDelete();

            $table->index('task_id');
            $table->index('member_id');
        });
    }
    public function down(): void {
        Schema::dropIfExists('task_comments');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->cascadeOnUpdate()->nullOnDelete();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->timestamp('due_at')->nullable();
            $table->enum('status', ['ongoing','done','canceled','archived'])->default('ongoing');
            $table->timestamp('completed_at')->nullable();
            $table->unsignedBigInteger('created_by_member_id');
            $table->unsignedBigInteger('responsible_member_id')->nullable();
            $table->timestamps();

            $table->foreign('created_by_member_id')
                  ->references('id_member')->on('team_members')
                  ->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('responsible_member_id')
                  ->references('id_member')->on('team_members')
                  ->cascadeOnUpdate()->nullOnDelete();

            $table->index('team_id');
            $table->index('category_id');
            $table->index('status');
            $table->index('due_at');
            $table->index('created_by_member_id');
            $table->index('responsible_member_id');
        });
    }
    public function down(): void {
        Schema::dropIfExists('tasks');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            // UUID foreign key ke team_members.id_member
            $table->foreignUuid('actor_member_id')
                  ->references('id_member')
                  ->on('team_members')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->string('action', 80);
            $table->string('entity_type', 40);
            $table->uuid('entity_id'); // kalau entitas target (task/team) juga UUID
            $table->text('meta')->nullable();
            $table->timestamps();

            $table->index('actor_member_id');
            $table->index(['entity_type', 'entity_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('activity_logs');
    }
};

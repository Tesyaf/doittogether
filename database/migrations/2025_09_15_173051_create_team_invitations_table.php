<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('team_invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('email', 150);
            $table->string('code', 36)->unique();
            $table->unsignedBigInteger('invited_by_member');
            $table->enum('status', ['pending','accepted','revoked','expired'])->default('pending');
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('invited_by_member')
                  ->references('id_member')->on('team_members')
                  ->cascadeOnUpdate()->restrictOnDelete();

            $table->index('team_id');
            $table->index('email');
            $table->index('status');
        });
    }
    public function down(): void {
        Schema::dropIfExists('team_invitations');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('team_invitations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('team_id')->constrained('teams')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('email', 255); // akan terenkripsi di model
            $table->uuid('code')->unique();
            $table->foreignUuid('invited_by_member')->references('id_member')->on('team_members')->restrictOnDelete();
            $table->enum('status', ['pending','accepted','revoked','expired'])->default('pending');
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }
    public function down(): void {
        Schema::dropIfExists('team_invitations');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('team_members', function (Blueprint $table) {
            $table->uuid('id_member')->primary();
            $table->foreignUuid('team_id')->constrained('teams')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->enum('role', ['owner','admin','member'])->default('member');
            $table->timestamp('joined_at')->useCurrent();
            $table->unique(['team_id','user_id']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('team_members');
    }
};

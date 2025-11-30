<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('team_repositories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('team_id')->constrained('teams')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('provider', 30)->default('github');
            $table->string('repo_full_name', 150);
            $table->string('branch', 100)->nullable();
            $table->string('webhook_secret', 255);
            $table->timestamps();

            $table->unique('team_id');
            $table->unique(['provider', 'repo_full_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_repositories');
    }
};

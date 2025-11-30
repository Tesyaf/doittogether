<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('repository_commits', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('team_repository_id')->constrained('team_repositories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('sha', 100);
            $table->text('message');
            $table->string('author_name', 150)->nullable();
            $table->string('author_email', 150)->nullable();
            $table->string('branch', 120)->nullable();
            $table->timestamp('committed_at')->nullable();
            $table->string('html_url', 2048)->nullable();
            $table->json('payload')->nullable();
            $table->timestamps();

            $table->unique(['team_repository_id', 'sha']);
            $table->index(['team_repository_id', 'committed_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repository_commits');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name', 50);
            $table->timestamp('created_at')->useCurrent();
            $table->unique(['team_id','name']);
            $table->index('team_id');
        });
    }
    public function down(): void {
        Schema::dropIfExists('categories');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('title', 120);
            $table->text('message'); // pakai text karena terenkripsi
            $table->boolean('is_read')->default(false);
            $table->timestamps(); // ✅ tambahkan ini
        });

    }
    public function down(): void {
        Schema::dropIfExists('notifications');
    }
};

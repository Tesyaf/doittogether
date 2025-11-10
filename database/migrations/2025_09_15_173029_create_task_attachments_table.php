<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('task_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('member_id');
            $table->string('file_name', 255);
            $table->string('file_url', 512);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('member_id')
                  ->references('id_member')->on('team_members')
                  ->cascadeOnUpdate()->cascadeOnDelete();

            $table->index('task_id');
            $table->index('member_id');
        });
    }
    public function down(): void {
        Schema::dropIfExists('task_attachments');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('task_assignees', function (Blueprint $table) {
            $table->foreignId('task_id')->constrained('tasks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('member_id');
            $table->enum('role_on_task', ['responsible','contributor','reviewer'])->default('contributor');

            $table->foreign('member_id')
                  ->references('id_member')->on('team_members')
                  ->cascadeOnUpdate()->cascadeOnDelete();

            $table->primary(['task_id','member_id']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('task_assignees');
    }
};

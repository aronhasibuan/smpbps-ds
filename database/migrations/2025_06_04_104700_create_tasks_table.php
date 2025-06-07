<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained(
                table: 'activities',
                indexName: 'tasks_activities_id'
            );
            $table->foreignId('user_member_id')->constrained(
                table: 'users',
                indexName: 'tasks_users_id'
            );
            $table->foreignId('status_id')->constrained(
                table: 'statuses',
                indexName:'tasks_statuses_id'
            );
            $table->string('task_slug')->unique();
            $table->text('task_description');
            $table->integer('task_volume');
            $table->string('task_latest_progress')->default(0);
            $table->string('task_attachment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

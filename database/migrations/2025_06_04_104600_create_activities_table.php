<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_leader_id')->constrained(
                table: 'users',
                indexName: 'activities_users_id'
            );
            $table->string('activity_name');
            $table->string('activity_slug')->unique();
            $table->string('activity_unit');
            $table->date('activity_start');
            $table->date('activity_end');
            $table->boolean('activity_active_status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};

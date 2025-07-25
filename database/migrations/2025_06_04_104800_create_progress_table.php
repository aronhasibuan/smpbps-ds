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
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained(
                table:'tasks',
                indexName:'progress_tasks_id'
            );
            $table->date('progress_date');
            $table->string('progress_amount')->default(0);
            $table->text('progress_notes')->nullable();
            $table->string('progress_documentation')->nullable();
            $table->timestamps();
            $table->boolean('progress_acceptance')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};

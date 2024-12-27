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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('namakegiatan');
            $table->text('slug')->unique();
            $table->text('deskripsi');
            $table->integer('volume');
            $table->string('satuan');
            $table->date('tenggat');
            $table->foreignId('pemberitugas_id')->constrained(
                table: 'users',
                indexName: 'tasks_pemberitugas_id'
            );
            $table->foreignId('penerimatugas_id')->constrained(
                table: 'users',
                indexName: 'tasks_penerimatugas_id'
            );
            $table->string('progress')->default(0);
            $table->foreignId('importance_id')->constrained(
                table: 'importances',
                indexName: 'tasks_importance_id'
            );
            $table->string('attachment')->nullable();
            $table->string('status')->default('Sedang Berjalan');
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

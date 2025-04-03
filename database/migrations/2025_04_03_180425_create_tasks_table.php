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
            $table->string('namakegiatan');
            $table->string('slug')->unique();
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
            $table->string('latestprogress')->default(0);
            $table->string('attachment')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->foreignId('kegiatan_id')->constrained(
                table: 'kegiatan',
                indexName: 'tasks_kegiatan_id'
            );
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

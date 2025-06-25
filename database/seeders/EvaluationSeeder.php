<?php

namespace Database\Seeders;

use App\Models\Evaluation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Survei Perusahaan Perikanan
        Evaluation::create([
            'task_id' => 78,
            'evaluation_tidiness' => 'Tidak Rapi',
            'evaluation_comprehensiveness' => 'Cukup Lengkap',
        ]);
    }
}

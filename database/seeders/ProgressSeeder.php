<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Progress;

class ProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Progress::create([
            'task_id' => 1,
            'progress_date' => now()->subDays(3)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 1,
            'progress_date' => now()->format('Y-m-d'),
            'progress_amount' => 6,
            'progress_notes' => 'Tidak ada catatan',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 2,
            'progress_date' => now()->subDays(3)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 3,
            'progress_date' => now()->subDays(3)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 3,
            'progress_date' => now()->format('Y-m-d'),
            'progress_amount' => 1,
            'progress_notes' => 'Tidak ada catatan',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 4,
            'progress_date' => now()->subDays(3)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 5,
            'progress_date' => now()->subDays(7)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 6,
            'progress_date' => now()->subDays(7)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 6,
            'progress_date' => now()->format('Y-m-d'),
            'progress_amount' => 1,
            'progress_notes' => 'Tidak ada catatan',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 7,
            'progress_date' => now()->subDays(5)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 7,
            'progress_date' => now()->format('Y-m-d'),
            'progress_amount' => 4,
            'progress_notes' => 'Tidak ada catatan',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 8,
            'progress_date' => now()->subDays(5)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 9,
            'progress_date' => now()->subDays(5)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 9,
            'progress_date' => now()->format('Y-m-d'),
            'progress_amount' => 2,
            'progress_notes' => 'Tidak ada catatan',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 10,
            'progress_date' => now()->subDays(5)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 10,
            'progress_date' => now()->format('Y-m-d'),
            'progress_amount' => 3,
            'progress_notes' => 'Tidak ada catatan',
            'progress_documentation' => null,
        ]);
    }
}

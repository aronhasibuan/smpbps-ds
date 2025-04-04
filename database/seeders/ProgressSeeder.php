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
            'tanggal' => now()->format('Y-m-d'),
            'progress' => 0,
            'dokumentasi' => null,
        ]);

        Progress::create([
            'task_id' => 1,
            'tanggal' => now()->addDays(1)->format('Y-m-d'),
            'progress' => 10,
            'dokumentasi' => null,
        ]);

        Progress::create([
            'task_id' => 1,
            'tanggal' => now()->addDays(2)->format('Y-m-d'),
            'progress' => 20,
            'dokumentasi' => null,
        ]);
        
        Progress::create([
            'task_id' => 2,
            'tanggal' => now()->format('Y-m-d'),
            'progress' => 0,
            'dokumentasi' => null,
        ]);

        Progress::create([
            'task_id' => 2,
            'tanggal' => now()->addDays(1)->format('Y-m-d'),
            'progress' => 10,
            'dokumentasi' => null,
        ]);

        Progress::create([
            'task_id' => 3,
            'tanggal' => now()->format('Y-m-d'),
            'progress' => 0,
            'dokumentasi' => null,
        ]);

        Progress::create([
            'task_id' => 3,
            'tanggal' => now()->addDays(1)->format('Y-m-d'),
            'progress' => 10,
            'dokumentasi' => null,
        ]);

        Progress::create([
            'task_id' => 4,
            'tanggal' => now()->format('Y-m-d'),
            'progress' => 0,
            'dokumentasi' => null,
        ]);

        Progress::create([
            'task_id' => 4,
            'tanggal' => now()->addDays(1)->format('Y-m-d'),
            'progress' => 10,
            'dokumentasi' => null,
        ]);

        Progress::create([
            'task_id' => 5,
            'tanggal' => now()->format('Y-m-d'),
            'progress' => 0,
            'dokumentasi' => null,
        ]);

        Progress::create([
            'task_id' => 5,
            'tanggal' => now()->addDays(1)->format('Y-m-d'),
            'progress' => 10,
            'dokumentasi' => null,
        ]);

        Progress::create([
            'task_id' => 6,
            'tanggal' => now()->format('Y-m-d'),
            'progress' => 0,
            'dokumentasi' => null,
        ]);

        Progress::create([
            'task_id' => 6,
            'tanggal' => now()->addDays(1)->format('Y-m-d'),
            'progress' => 10,
            'dokumentasi' => null,
        ]);

        Progress::create([
            'task_id' => 7,
            'tanggal' => now()->format('Y-m-d'),
            'progress' => 0,
            'dokumentasi' => null,
        ]);

        Progress::create([
            'task_id' => 7,
            'tanggal' => now()->addDays(1)->format('Y-m-d'),
            'progress' => 10,
            'dokumentasi' => null,
        ]);

        Progress::create([
            'task_id' => 8,
            'tanggal' => now()->format('Y-m-d'),
            'progress' => 0,
            'dokumentasi' => null,
        ]);
        
        Progress::create([
            'task_id' => 8,
            'tanggal' => now()->addDays(1)->format('Y-m-d'),
            'progress' => 10,
            'dokumentasi' => null,
        ]);
    }
}

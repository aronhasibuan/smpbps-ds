<?php

namespace Database\Seeders;

use App\Models\Objection;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ObjectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        #1
        Objection::create([
            'task_id' => 80,
            'objection_reason' => 'Tugas bertabrakan dengan agenda lain',
            'objection_status' => 'tertunda',
        ]);

        #2
        Objection::create([
            'task_id' => 81,
            'objection_reason' => 'Sedang mengajukan permohonan cuti pada tanggal tersebut',
            'objection_status' => 'tertunda',
        ]);
    }
}

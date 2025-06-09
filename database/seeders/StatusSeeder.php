<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        #1
        Status::create([
            'status_description' => 'Task tidak aktif'
        ]);

        #2
        Status::create([
            'status_description' => 'Task aktif'
        ]);
        
        #3
        Status::create([
            'status_description' => 'Task belum dimulai, menunggu verifikasi dari ketua tim lain'
        ]);
        
        #4
        Status::create([
            'status_description' => 'Task menunggu verifikasi dari ketua tim bahwa task sudah selesai'
        ]);

        #5
        Status::create([
            'status_description' => 'Task dalam masa sanggah, menunggu persetujuan dari ketua tim'
        ]);
    }
}

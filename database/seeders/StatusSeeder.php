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
            'status_description' => 'Tugas Tidak Aktif'
        ]);

        #2
        Status::create([
            'status_description' => 'Tugas Aktif'
        ]);
        
        #3
        Status::create([
            'status_description' => 'Tugas Belum Dimulai, Menunggu Persetujuan Dari Ketua Tim Lain'
        ]);
        
        #4
        Status::create([
            'status_description' => 'Tugas Menunggu Persetujuan Dari Ketua Tim Bahwa Tugas Sudah Selesai'
        ]);

        #5
        Status::create([
            'status_description' => 'Tugas Dalam Masa Sanggah, Menunggu Persetujuan Dari Ketua Tim'
        ]);
    }
}

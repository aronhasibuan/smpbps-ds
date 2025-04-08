<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'namakegiatan' => 'Survei Sosial Ekonomi Nasional',
            'slug' => '1_aronhsb16',
            'kegiatan_id' => 1,
            'deskripsi' => 'Survei Sosial Ekonomi Nasional adalah survei yang dilakukan untuk mengumpulkan data sosial dan ekonomi masyarakat.',
            'volume' => 49,
            'satuan' => 'unit',
            'tenggat' => now()->addDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 4, 
            'penerimatugas_id' => 13,
            'latestprogress' => 20,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Sosial Ekonomi Nasional',
            'slug' => '2_novi.fahdilla',
            'kegiatan_id' => 1,
            'deskripsi' => 'Survei Sosial Ekonomi Nasional adalah survei yang dilakukan untuk mengumpulkan data sosial dan ekonomi masyarakat.',
            'volume' => 35,
            'satuan' => 'unit',
            'tenggat' => now()->addDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 4,
            'penerimatugas_id' => 8,
            'latestprogress' => 10,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Harga Produsen',
            'slug' => '3_aronhsb16',
            'kegiatan_id' => 2,
            'deskripsi' => 'Survei Harga Produsen adalah survei yang dilakukan untuk mengumpulkan data harga produsen.',
            'volume' => 35,
            'satuan' => 'unit',
            'tenggat' => now()->addDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'penerimatugas_id' => 13,
            'latestprogress' => 10,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Harga Produsen',
            'slug' => '4_juharmonang',
            'kegiatan_id' => 2,
            'deskripsi' => 'Survei Harga Produsen adalah survei yang dilakukan untuk mengumpulkan data harga produsen.',
            'volume' => 28,
            'satuan' => 'unit',
            'tenggat' => now()->addDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'penerimatugas_id' => 7,
            'latestprogress' => 10,
            'attachment' => null,
            'active' => 1,
        ]);


        Task::create([
            'namakegiatan' => 'Survei Harga Konsumen',
            'slug' => '5_aronhsb16',
            'kegiatan_id' => 3,
            'deskripsi' => 'Survei Harga Konsumen adalah survei yang dilakukan untuk mengumpulkan data harga konsumen.',
            'volume' => 28,
            'satuan' => 'unit',
            'tenggat' => now()->addDays(13)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'penerimatugas_id' => 13,
            'latestprogress' => 10,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Harga Konsumen',
            'slug' => '6_melati.simanjuntak',
            'kegiatan_id' => 3,
            'deskripsi' => 'Survei Harga Konsumen adalah survei yang dilakukan untuk mengumpulkan data harga konsumen.',
            'volume' => 14,
            'satuan' => 'unit',
            'tenggat' => now()->addDays(13)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 12,
            'latestprogress' => 10,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Angkatan Kerja Nasional',
            'slug' => '7_aronhsb16',
            'kegiatan_id' => 4,
            'deskripsi' => 'Survei Angkatan Kerja Nasional adalah survei yang dilakukan untuk mengumpulkan data angkatan kerja nasional.',
            'volume' => 14,
            'satuan' => 'unit',
            'tenggat' => now()->addDays(13)->format('Y-m-d'),
            'pemberitugas_id' => 4, 
            'penerimatugas_id' => 13,
            'latestprogress' => 10,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Angkatan Kerja Nasional',
            'slug' => '8_novi.fahdilla',
            'kegiatan_id' => 4,
            'deskripsi' => 'Survei Angkatan Kerja Nasional adalah survei yang dilakukan untuk mengumpulkan data angkatan kerja nasional.',
            'volume' => 14,
            'satuan' => 'unit',
            'tenggat' => now()->addDays(13)->format('Y-m-d'),
            'pemberitugas_id' => 4, 
            'penerimatugas_id' => 8,
            'latestprogress' => 10,
            'attachment' => null,
            'active' => 1,
        ]);

    }
}

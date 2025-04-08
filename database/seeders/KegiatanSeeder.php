<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kegiatan::create([
            'namakegiatan' => 'Survei Sosial Ekonomi Nasional',
            'slug' => '1_survei_sosial_ekonomi_nasional_'.now()->format('d-m-Y').'_'.now()->addDays(6)->format('d-m-Y'),
            'tenggat' => now()->addDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 4,
            'active' => 1,
        ]);

        Kegiatan::create([
            'namakegiatan' => 'Survei Harga Produsen',
            'slug' => '2_survei_harga_produsen_'.now()->format('d-m-Y').'_'.now()->addDays(6)->format('d-m-Y'),
            'tenggat' => now()->addDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'active' => 1,
        ]);
        
        Kegiatan::create([
            'namakegiatan' => 'Survei Harga Konsumen',
            'slug' => '3_survei_harga_konsumen_'.now()->format('d-m-Y').'_'.now()->addDays(13)->format('d-m-Y'),
            'tenggat' => now()->addDays(13)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'active' => 1,
        ]);

        Kegiatan::create([
            'namakegiatan' => 'Survei Angkatan Kerja Nasional',
            'slug' => '4_survei_angkatan_kerja_nasional_'.now()->format('d-m-Y').'_'.now()->addDays(13)->format('d-m-Y'),
            'tenggat' => now()->addDays(13)->format('Y-m-d'),
            'pemberitugas_id' => 4,
            'active' => 1,
        ]);
    }
}

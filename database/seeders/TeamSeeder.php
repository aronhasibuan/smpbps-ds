<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kepala BPS
        #1
        Team::create([
            'team_name' => 'Tidak Memiliki Tim',
            'team_description' => 'Daftar pengguna yang saat ini tidak atau belum memiliki tim.'
        ]);
        // Tim Statistik Produksi
        #2
        Team::create([
            'team_name' => 'Statistik Produksi',
            'team_description' => 'Tim ini memiliki tugas untuk melaksanakan kegiatan di statistik Produksi. Kegiatan Statistik Produksi dimaksud meliputi Statistik Pertanian; Statistik Industri Mikro dan Kecil; Statistik Industri Besar dan Sedang; dan Statistik Pertambangan, Energi, dan Konstruksi.'
        ]);
        
        // Tim Statistik Distribusi
        #3
        Team::create([
            'team_name' => 'Statistik Distribusi',
            'team_description' => 'Tim ini memiliki tugas untuk melaksanakan kegiatan di Statistik Distribusi. Kegiatan Statistik Distribusi meliputi Statistik Harga Konsumen dan Harga Perdagangan Besar; Statistik Keuangan dan Harga Produsen; dan Statistik Niaga dan Jasa.'
        ]);
        
        // Tim Statistik Sosial
        #4
        Team::create([
            'team_name' => 'Statistik Sosial',
            'team_description' => 'Tim ini memiliki tugas untuk melaksanakan kegiatan di Statistik Sosial. Kegiatan Statistik Sosial meliputi Statistik Kependudukan; Statistik kesejahteraan Rakyat; dan Statistik Ketahanan Sosial.'
        ]);
    }
}

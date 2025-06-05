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
            'team_name' => 'Kepala BPS',
            'team_description' => 'Kepala BPS adalah seseorang yang memiliki wewenang tertinggi dalam kantor BPS.'
        ]);
        // Tim Statistik Distribusi
        #2
        Team::create([
            'team_name' => 'Statistik Distribusi',
            'team_description' => 'Tim Statistik Distribusi adalah tim yang bertugas mengumpulkan, mengolah, dan menganalisis data terkait distribusi barang dan jasa di wilayah kerja BPS.'
        ]);

        // Tim Statistik Sosial
        #3
        Team::create([
            'team_name' => 'Statistik Sosial',
            'team_description' => 'Tim Statistik Sosial adalah tim yang bertugas mengumpulkan, mengolah, dan menganalisis data terkait kondisi sosial masyarakat di wilayah kerja BPS.'
        ]);
    }
}

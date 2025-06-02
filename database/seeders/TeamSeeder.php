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
        // Atasan
        #1
        Team::create([
            'nama_tim' => 'Atasan'
        ]);
        // Tim Statistik Distribusi
        #2
        Team::create([
            'nama_tim' => 'Statistik Distribusi'
        ]);

        // Tim Statistik Sosial
        #3
        Team::create([
            'nama_tim' => 'Statistik Sosial'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Importance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImportanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Importance::create([
            'name' => 'Tinggi',
            'color' => 'red'
        ]);

        Importance::create([
            'name' => 'Sedang',
            'color' => 'yellow'
        ]);

        Importance::create([
            'name' => 'Rendah',
            'color' => 'green'
        ]);
    }
}

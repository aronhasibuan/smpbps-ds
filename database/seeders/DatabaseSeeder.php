<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Activity;
use App\Models\Status;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([TeamSeeder::class]);
        $this->call([UserSeeder::class]);
        $this->call([ActivitySeeder::class]);
        $this->call([StatusSeeder::class]);
        $this->call([TaskSeeder::class]);
        $this->call([ProgressSeeder::class]);
        $this->call([EvaluationSeeder::class]);
        $this->call([ObjectionSeeder::class]);
    }
}

<?php

namespace Database\Factories;

use App\Models\Importance;
use App\Models\User;
use Illuminate\Support\Str;

use function Laravel\Prompts\text;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'namakegiatan' => fake()->sentence(4, false),
            'slug' => Str::slug(fake()->sentence(5, false)),
            'deskripsi' => fake()->text(),
            'volume' => fake()->randomDigit(),
            'satuan' => fake()->word(),
            'tenggat' => fake()->date(),
            'pemberitugas_id' => User::factory()->teamleader(),
            'penerimatugas_id' => User::factory()->notteamleader(),
        ];
    }
}

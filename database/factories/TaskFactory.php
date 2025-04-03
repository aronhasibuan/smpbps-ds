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
        return [];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        DB::table('services')->delete();

        return [
            'name' => fake()->name(),
            'status' => fake()->randomElement(['active', 'inactive']),
            'notes' => fake()->paragraph(50),
            'price' => fake()->numberBetween(100,300),
        ];
    }
}

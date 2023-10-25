<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        DB::table('doctors')->delete();

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'section_id'=>Section::all()->random()->id,
            'phone'=>fake()->phoneNumber(),
            //'days'=>fake()->randomElement([1,2,3,4,5,6,7]),
            'status'=>fake()->randomElement(['active','inactive']),
            'image'=>fake()->imageUrl(600,400),
            'identity'=>Str::random(9),
        ];
    }
}

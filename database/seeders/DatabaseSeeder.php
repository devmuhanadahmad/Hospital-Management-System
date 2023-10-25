<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Doctor;
use App\Models\Pattient;
use App\Models\Section;
use Database\Factories\DoctorFactory;
use Database\Factories\SectionFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([UserSeeder::class,AdminSeeder::class,ApointmentySeeder::class]);
        Section::factory(10)->create();
        Doctor::factory(10)->create();
        Pattient::factory(10)->create();
    }
}

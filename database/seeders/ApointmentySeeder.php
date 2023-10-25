<?php

namespace Database\Seeders;

use App\Models\Apointmenty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApointmentySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('apointmenties')->delete();

        $apointmenties = [
            [
                'name' => 'Saturday',
            ],
            [
                'name' => 'Sunday',
            ],
            [
                'name' => 'Monday',
            ],
            [
                'name' => 'Tuesday',
            ],
            [
                'name' => 'Wednesday',
            ],
            [
                'name' => 'Thursday',
            ],
            [
                'name' => 'Friday',
            ],

        ];

        foreach ($apointmenties as $apointmenty) {
            Apointmenty::create([
                'name' => $apointmenty['name'],
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Major::create([
            'name' => 'S2 TEKNIK ELEKTRO',
            'faculty_id' => 1,
        ]);

        Major::create([
            'name' => 'S1 TEKNIK ELEKTRO',
            'faculty_id' => 1,
        ]);

        Major::create([
            'name' => 'S1 TEKNIK SISTEM ENERGI',
            'faculty_id' => 1,
        ]);

        Major::create([
            'name' => 'S1 TEKNIK TELEKOMUNIKASI',
            'faculty_id' => 1,
        ]);

        Major::create([
            'name' => 'S1 TEKNIK TEKNOLOGI LISTRIK',
            'faculty_id' => 1,
        ]);

        Major::create([
            'name' => 'D3 TEKNOLOGI LISTRIK',
            'faculty_id' => 1,
        ]);

        Major::create([
            'name' => 'S1 TEKNIK INFORMATIKA',
            'faculty_id' => 2,
        ]);

        Major::create([
            'name' => 'S1 SISTEM INFORMASI',
            'faculty_id' => 2,
        ]);

        Major::create([
            'name' => 'S1 TEKNIK MESIN',
            'faculty_id' => 3,
        ]);

        Major::create([
            'name' => 'SI TEKNIK SIPIL',
            'faculty_id' => 4,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faculty::create([
            'name' => 'FAKULTAS KETENAGALISTRIKAN DAN ENERGI TERBARUKAN',
        ]);

        Faculty::create([
            'name' => 'FAKULTAS TELEMATIKA ENERGI',
        ]);

        Faculty::create([
            'name' => 'FAKULTAS TEKNOLOGI DAN BISNIS ENERGI',
        ]);

        Faculty::create([
            'name' => 'FAKULTAS TEKNOLOGI INFRASTRUKTUR DAN KEWILAYAHAN',
        ]);
    }
}

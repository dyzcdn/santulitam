<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Theme::create([
            'name' => 'KAIZEN',
            'year' => 2022,
        ]);

        Theme::create([
            'name' => 'RENAISANS',
            'year' => 2023,
        ]);

        Theme::create([
            'name' => 'SANTULITAM',
            'year' => 2024,
        ]);
    }
}

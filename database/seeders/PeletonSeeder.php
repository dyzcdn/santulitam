<?php

namespace Database\Seeders;

use App\Models\Peleton;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PeletonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Peleton::create([
            'name' => 'Abhaya',
            'cofasilitator_id' => 1,
        ]);

        Peleton::create([
            'name' => 'Lakshya',
            'cofasilitator_id' => 2,
        ]);

        Peleton::create([
            'name' => 'Sanjaya',
            'cofasilitator_id' => 3,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Cofasilitator;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CofasilitatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cofasilitator::create([
            'name'  => 'Budi Santosa',
            'nim'   => '202200221',
            'email' => 'budi@gmail.com',
            'phone' => '08123456789',
        ]);

        Cofasilitator::create([
            'name'  => 'Citra Bayanti',
            'nim'   => '202299013',
            'email' => 'lala@gmail.com',
            'phone' => '08123456789',
        ]);

        Cofasilitator::create([
            'name'  => 'Monalika',
            'nim'   => '202221095',
            'email' => 'monalika@gmail.com',
            'phone' => '08123456789',
        ]);
    }
}

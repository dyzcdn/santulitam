<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserRole::create([
            'name' => 'Super Admin',
        ]);

        UserRole::create([
            'name' => 'Admin',
        ]);

        UserRole::create([
            'name' => 'Mentor',
        ]);

        UserRole::create([
            'name' => 'Peserta',
        ]);
    }
}

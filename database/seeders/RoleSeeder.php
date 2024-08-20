<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'superadmin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'cofasilitator',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'cofas',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'student',
            'guard_name' => 'web'
        ]);

    }
}

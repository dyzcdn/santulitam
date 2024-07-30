<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserRoleSeeder::class,
        ]);

        User::create([
            'name' => 'Super Admin',
            'username' => 'admin',
            'email' => 'admin@m.co',
            'user_role_id' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        $this->call([
            CofasilitatorSeeder::class,
            PeletonSeeder::class,
            FacultySeeder::class,
            MajorSeeder::class,
            StudentSeeder::class,
            ThemeSeeder::class,
            AttendanceSeeder::class,
        ]);
    }
}

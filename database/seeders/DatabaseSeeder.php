<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // $this->call([
        //     RoleSeeder::class
        // ]);

        $user1 = User::create([
            'name' => 'Super Admin',
            'username' => 'sadmin',
            'email' => 'sadmin@s.id',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        $user2 = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@s.id',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        $user3 = User::create([
            'name' => 'Cofasilitator',
            'username' => 'cofasilitator',
            'email' => 'cofasilitator@s.id',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        $user4 = User::create([
            'name' => 'Cofas',
            'username' => 'cofas',
            'email' => 'cofas@s.id',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        $role1 = Role::create(['name' => 'Super Admin']);
        $role2 = Role::create(['name' => 'Admin']);
        $role3 = Role::create(['name' => 'Cofas']);
        $role4 = Role::create(['name' => 'Cofas Mobile']);
        $user1->assignRole($role1);
        $user2->assignRole($role2);
        $user3->assignRole($role3);
        $user4->assignRole($role4);


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

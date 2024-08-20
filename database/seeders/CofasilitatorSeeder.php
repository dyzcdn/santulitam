<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cofasilitator;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CofasilitatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'name'      => 'Budi Santosa',
            'username'  => 'budi',
            'email'     => 'budi@gmail.com',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        Cofasilitator::create([
            'name'  => 'Budi Santosa',
            'nim'   => '202200221',
            'email' => 'budi@gmail.com',
            'phone' => '08123456789',
            'user_id' => $user1->id,
        ]);

        $user2 = User::create([
            'name'      => 'Citra Bayanti',
            'username'  => 'tata',
            'email'     => 'tata@gmail.com',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        Cofasilitator::create([
            'name'  => 'Citra Bayanti',
            'nim'   => '202299013',
            'email' => 'tata@gmail.com',
            'phone' => '08123456789',
            'user_id' => $user2->id,
        ]);

        $user3 = User::create([
            'name'      => 'Monalika',
            'username'  => 'monalika',
            'email'     => 'monalika@gmail.com',
            'password'  => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        Cofasilitator::create([
            'name'  => 'Monalika',
            'nim'   => '202221095',
            'email' => 'monalika@gmail.com',
            'phone' => '08123456789',
            'user_id' => $user3->id,
        ]);

        $role = ['name' => 'Cofas'];
        $user1->assignRole($role);
        $user2->assignRole($role);
        $user3->assignRole($role);
    }
}

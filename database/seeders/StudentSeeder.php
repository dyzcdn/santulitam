<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'name'          => 'Rayyanza Malik Ahmad',
            'nim'           => '202411023',
            'image'         => 'default.jpg',
            'major_id'    => 2,
            'email'         => 'rayyanza@gmail.com',
            'phone'         => '08123456789',
            'peleton_id'   => 1
        ]);

        Student::create([
            'name'          => 'Muhammad Rizky Akbar',
            'nim'           => '202431091',
            'image'         => 'default.jpg',
            'major_id'    => 7,
            'email'         => 'rizky@gmail.com',
            'phone'         => '08123456789',
            'peleton_id'   => 2
        ]);

        Student::Create([
            'name'          => 'Mazaya Amania',
            'nim'           => '202432092',
            'image'         => 'default.jpg',
            'major_id'    => 8,
            'email'         => 'mazaya@gmail.com',
            'phone'         => '08123456789',
            'peleton_id'   => 3
        ]);
    }
}

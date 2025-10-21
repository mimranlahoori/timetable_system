<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            ['name' => 'Ali Raza', 'email' => 'ali@example.com', 'phone' => '03001234567'],
            ['name' => 'Sara Ahmed', 'email' => 'sara@example.com', 'phone' => '03007654321'],
            ['name' => 'Bilal Khan', 'email' => 'bilal@example.com', 'phone' => '03111222333'],
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = Classroom::all();
        $teachers = Teacher::all();


        foreach ($classes as $class) {
            $subjects = [
                ['name' => 'Mathematics', 'code' => 'MATH'],
                ['name' => 'English', 'code' => 'ENG'],
                ['name' => 'Science', 'code' => 'SCI'],
                ['name' => 'Urdu', 'code' => 'URD'],
                ['name' => 'Islamiyat', 'code' => 'ISL'],
            ];

            foreach ($subjects as $subject) {
                Subject::create([
                    'classroom_id' => $class->id,
                    'teacher_id' => $teachers->random()->id,
                    'name' => $subject['name'],
                    'code' => $subject['code'],
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TimeSlot;
use App\Models\Timetable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimetableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $classes = Classroom::all();
        $slots = TimeSlot::all();

        foreach ($classes as $class) {
            // Get subjects that belong to this class
            $classSubjects = Subject::where('classroom_id', $class->id)->get();

            if ($classSubjects->isEmpty()) {
                continue; // Skip if no subjects assigned to the class
            }

            foreach ($days as $day) {
                foreach ($slots as $slot) {
                    $subject = $classSubjects->random();

                    Timetable::updateOrCreate(
                        [
                            'classroom_id' => $class->id,
                            'day_of_week' => $day,
                            'time_slot_id' => $slot->id,
                        ],
                        [
                            'subject_id' => $subject->id,
                            'teacher_id' => $subject->teacher_id,
                            'room_no' => 'R-' . rand(1, 10),
                        ]
                    );
                }
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\TimeSlot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeSlotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                $slots = [
            ['start_time' => '08:00:00', 'end_time' => '08:45:00'],
            ['start_time' => '08:50:00', 'end_time' => '09:35:00'],
            ['start_time' => '09:40:00', 'end_time' => '10:25:00'],
            ['start_time' => '10:30:00', 'end_time' => '11:15:00'],
            ['start_time' => '11:20:00', 'end_time' => '12:05:00'],
        ];

        foreach ($slots as $slot) {
            TimeSlot::create($slot);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\TimeSlot;
use App\Models\Timetable;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClasses = Classroom::count();
        $totalTeachers = Teacher::count();
        $totalSubjects = Subject::count();
        $totalSlots = TimeSlot::count();

        $today = Carbon::now()->format('l'); // Monday, Tuesday, etc.

        $todayTimetables = Timetable::with(['classroom', 'teacher', 'subject', 'timeSlot'])
            ->where('day_of_week', $today)
            ->orderBy('time_slot_id')
            ->get();

        return view('dashboard', compact(
            'totalClasses',
            'totalTeachers',
            'totalSubjects',
            'totalSlots',
            'today',
            'todayTimetables'
        ));
    }
}

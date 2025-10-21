<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TimeSlot;
use App\Models\Timetable;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TimetableController extends Controller
{
    /**
     * Display the timetable listing for a specific classroom.
     */
    public function index(Classroom $classroom)
    {
        // Fetch timetable entries, ordered by day and time slot ID (proxy for time order)
        $timetables = $classroom->timetables()
            ->with(['subject', 'timeSlot', 'teacher']) // Eager load relationships for the view
            ->orderByRaw("FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday')")
            ->orderBy('time_slot_id') // Ordering by time_slot_id assumes lower IDs mean earlier times
            ->get();

        return view('timetables.index', compact('classroom', 'timetables'));
    }

    /**
     * Show the form for creating a new timetable entry.
     */
    public function create(Classroom $classroom)
    {
        // Data required for form dropdowns
        $subjects = Subject::with('teachers')->where('classroom_id', $classroom->id)->get();
        // Assuming TimeSlot and Teacher models exist and have 'start_time'/'name'
        $timeSlots = TimeSlot::orderBy('start_time')->get();
        $teachers = Teacher::orderBy('name')->get();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        return view('timetables.create', compact('classroom', 'subjects', 'timeSlots', 'teachers', 'days'));
    }

    /**
     * Store a newly created timetable entry.
     */
    public function store(Request $request, Classroom $classroom)
    {
        // New validation based on the updated schema
        $validatedData = $request->validate([
            'subject_id' => [
                'required',
                'exists:subjects,id',
            ],
            'teacher_id' => 'required|exists:teachers,id',
            'time_slot_id' => 'required|exists:time_slots,id',
            'day_of_week' => ['required', Rule::in(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'])],
            'room_no' => 'nullable|string|max:255',
        ]);

        // Add the classroom_id and create the entry
        $classroom->timetables()->create($validatedData);

        return redirect()->route('classrooms.timetable.index', $classroom)
                         ->with('success', 'Timetable entry added successfully.');
    }

    /**
     * Display the specified timetable entry.
     */
    public function show(Timetable $timetable)
    {
        // Eager load relationships for the show view
        $timetable->load(['classroom', 'subject', 'timeSlot', 'teacher']);
        return view('timetables.show', compact('timetable'));
    }

    /**
     * Show the form for editing the specified timetable entry.
     */
    public function edit(Timetable $timetable, Classroom $classroom)
    {
        // Data required for form dropdowns
        $subjects = Subject::with('teachers')->where('classroom_id', $timetable->classroom->id)->get();
        $timeSlots = TimeSlot::orderBy('start_time')->get();
        $teachers = Teacher::orderBy('name')->get();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        
        return view('timetables.edit', compact('timetable', 'subjects', 'timeSlots', 'teachers', 'days'));
    }

    /**
     * Update the specified timetable entry in storage.
     */
    public function update(Request $request, Timetable $timetable)
    {
        // New validation based on the updated schema
        $validatedData = $request->validate([
            'subject_id' => [
                'required',
                'exists:subjects,id',
            ],
            'teacher_id' => 'required|exists:teachers,id',
            'time_slot_id' => 'required|exists:time_slots,id',
            'day_of_week' => ['required', Rule::in(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'])],
            'room_no' => 'nullable|string|max:255',
        ]);

        $timetable->update($validatedData);

        return redirect()->route('classrooms.timetable.index', $timetable->classroom)
                         ->with('success', 'Timetable entry updated successfully.');
    }

    /**
     * Remove the specified timetable entry from storage.
     */
    public function destroy(Timetable $timetable)
    {
        $classroom = $timetable->classroom;
        $timetable->delete();

        return redirect()->route('classrooms.timetable.index', $classroom)
                         ->with('success', 'Timetable entry deleted successfully.');
    }
}

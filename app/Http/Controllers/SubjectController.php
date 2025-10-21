<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // Index: Lists all subjects for a specific classroom
    public function index(Classroom $classroom)
    {
        $subjects = Subject::with('teachers')->where('classroom_id', $classroom->id)->get();

        return view('subjects.index', compact('classroom', 'subjects'));
    }

    // Create: Show form to create a new subject for the given classroom
    public function create(Classroom $classroom)
    {

        $teachers = Teacher::all();
        return view('subjects.create', compact('classroom', 'teachers'));
    }

    // Store: Validates and saves the new subject
    public function store(Request $request, Classroom $classroom)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        // First, create subject without classroom_id in fillable
        $subject = new Subject([
            'name' => $validatedData['name'],
            'code' => $validatedData['code'],
            'teacher_id' => $validatedData['teacher_id'],
        ]);

        $subject->classroom()->associate($classroom);
        $subject->save();

        return redirect()->route('classrooms.subjects.index', $classroom)
            ->with('success', 'Subject created successfully.');
    }



    // Show: Displays a single subject
    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }

    // Edit: Show form to edit an existing subject
    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    // Update: Validates and updates the subject
    public function update(Request $request, Subject $subject)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:255',
        ]);

        $subject->update($validatedData);

        // Redirect back to the index for the parent classroom
        return redirect()->route('classrooms.subjects.index', $subject->classroom)
            ->with('success', 'Subject updated successfully.');
    }

    // Destroy: Deletes the subject
    public function destroy(Subject $subject)
    {
        $classroom = $subject->classroom; // Get the parent classroom for redirect
        $subject->delete();

        return redirect()->route('classrooms.subjects.index', $classroom)
            ->with('success', 'Subject deleted successfully.');
    }
}

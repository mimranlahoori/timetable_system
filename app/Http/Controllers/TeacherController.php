<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // Basic validation rules reusable across store and update
    private function validateTeacher(Request $request, $ignoreId = null)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            // Unique email validation, ignoring the current record ID if updating
            'email' => 'required|email|unique:teachers,email,' . $ignoreId,
            'phone' => 'nullable|string|max:20',
            'subject_specialization' => 'nullable|string|max:100',
        ]);
    }

    /**
     * Display a listing of the resource (READ).
     */
    public function index()
    {
        $teachers = Teacher::orderBy('name')->get();
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource (CREATE).
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validateTeacher($request);
        Teacher::create($validated);

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher profile created successfully.');
    }

    /**
     * Display the specified resource. (Skipped show view, redirecting to index for simplicity)
     * We will use the index page to display the list.
     */
    public function show(Teacher $teacher) { 
        return view('teachers.show', compact('teacher'));
     }

    /**
     * Show the form for editing the specified resource (UPDATE).
     */
    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $this->validateTeacher($request, $teacher->id);
        $teacher->update($validated);

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage (DELETE).
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher profile deleted successfully.');
    }
}

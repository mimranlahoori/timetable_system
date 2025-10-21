<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource (READ - Index).
     */
    public function index()
    {
        // Fetch all classrooms from the database
        $classrooms = Classroom::all();

        // Pass them to the 'index' view
        return view('classrooms.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource (CREATE - Form).
     */
    public function create()
    {
        return view('classrooms.create');
    }

    /**
     * Store a newly created resource in storage (CREATE - Store).
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'section' => 'nullable|string|max:255',
        ]);

        // 2. Create and save the new record
        Classroom::create($validatedData);

        // 3. Redirect with a success message
        return redirect()->route('classrooms.index')
                         ->with('success', 'Classroom created successfully.');
    }

    /**
     * Display the specified resource (READ - Show).
     */
    public function show(Classroom $classroom)
    {
        return view('classrooms.show', compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource (UPDATE - Form).
     */
    public function edit(Classroom $classroom)
    {
        return view('classrooms.edit', compact('classroom'));
    }

    /**
     * Update the specified resource in storage (UPDATE - Update).
     */
    public function update(Request $request, Classroom $classroom)
    {
        // 1. Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'section' => 'nullable|string|max:255',
        ]);

        // 2. Update the record
        $classroom->update($validatedData);

        // 3. Redirect with a success message
        return redirect()->route('classrooms.index')
                         ->with('success', 'Classroom updated successfully.');
    }

    /**
     * Remove the specified resource from storage (DELETE - Destroy).
     */
    public function destroy(Classroom $classroom)
    {
        // Delete the record
        $classroom->delete();

        // Redirect with a success message
        return redirect()->route('classrooms.index')
                         ->with('success', 'Classroom deleted successfully.');
    }
}

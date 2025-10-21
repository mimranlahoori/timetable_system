<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TimetableController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Route::resource('timetables', TimetableController::class);
    Route::resource('classrooms', ClassroomController::class);
    // Nested Resource route for Subjects
// The URI will be /classrooms/{classroom}/subjects
Route::resource('classrooms.subjects', SubjectController::class)->shallow();
Route::resource('classrooms.timetable', TimetableController::class)->shallow();
    Route::resource('teachers', TeacherController::class);

});

require __DIR__ . '/auth.php';

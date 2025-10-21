<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    /** @use HasFactory<\Database\Factories\ClassroomFactory> */
    use HasFactory;

    protected $fillable = ['name', 'section'];

    public function timetables()
    {
        return $this->hasMany(Timetable::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'class_subject_teacher')
                    ->withPivot('teacher_id')
                    ->withTimestamps();
    }



}

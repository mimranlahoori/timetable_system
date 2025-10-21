<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone'];

    public function timetables()
    {
        return $this->hasMany(Timetable::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'class_subject_teacher')
                    ->withPivot('classroom_id')
                    ->withTimestamps();
    }

}

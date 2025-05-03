<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory , SoftDeletes;
    protected $fillable = [
        'user_id' ,'status'

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function course(){
        //if named courses_student(pivot table) not as naming Convention and name the forign key differnt
        // return $this->belongsToMany(Course::class , 'courses_students' , 'course_ref' , 'student_ref');


        return $this->belongsToMany(Course::class , 'course_student')
        ->withPivot('status' , 'course_status' ,'course_location')
        ->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'category_id' , 'trainer_id' , 'title' , 'code' , 'small_desc' , 'desc' ,
        'price' , 'image' , 'duration' , 'start_date' , 'end_date'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function trainer(){
        return $this->belongsTo(Trainer::class);
    }

    public function student(){
                //if named courses_student(pivot table) not as naming Convention and name the forign key differnt
        // return $this->belongsToMany(Student::class , 'courses_students' , 'course_ref' , 'student_ref');
        return $this->belongsToMany(Student::class , 'course_student')
        ->withPivot('status' , 'course_status' , 'course_location')
        ->withTimestamps();
    }
}

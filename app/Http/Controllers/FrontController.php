<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Trainer;
use App\Models\Category;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    //dashboard
    public function dashboard()
    {
        $user_id = Auth::id();
        $user = User::with('student', 'student.course', 'trainer')->where('id', $user_id)->first();
        return view('dashboard', compact('user'));
    }

    //main page or index page with all category in main page
    public function index()
    {
        $cat_count = Category::count();
        $c_count = Course::count();
        // $s_count = User::where('role' , 'student')->count();
        $s_count = Student::count();
        $t_count = Trainer::count();
        // $u_count = User::count();
        $categories = Category::all();
        return view('front.index', compact('categories', 'cat_count', 'c_count', 't_count', 's_count'));
    }

    //Category
    //ShowCategory
    public function ShowCategory($id)
    {
        $category = Category::with('course')->findorfail($id);
        return view('front.category.showcategory', compact('category'));
    }


    //category course
    public function ShowCategoryCourses($id)
    {
        $category = Category::findorfail($id);
        $courses = Course::where('category_id', $category->id)->paginate(6);
        return view('front.category.categorycourses', compact('courses', 'category'));
    }


    //courses
    //show all courses in rondom
    public function AllCourses()
    {
        $courses = Course::Paginate(6);
        return view('front.courses.allcourses', compact('courses'));
    }

    //show specific course
    public function ShowCourse($id)
    {
        $course = Course::with('student')->findorfail($id);
        return view('front.courses.showcourse', compact('course'));
    }

    //my courses with user id (authenticated)
    public function mycourses()
    {
        $user_id = Auth::id();
        $student = Student::where('user_id', $user_id)->first();
        $courses = $student ? $student->course()->with('trainer')->get() : collect();

        return view('front.courses.mycourses', compact('courses'));
    }

    //enrolled the course
    public function enrolled($id)
    {
        $user_id = Auth::id();
        $course = Course::findorfail($id);
        $student =  Student::where('user_id', $user_id)->first();

        if($student->course()->where('course_id' , $course->id)->exists()){
            return redirect()->back()->with('info', 'You are already enrolled in this course.');
        }
        $student->course()->attach($course->id , [
            'status'=>'active',
            'course_location' => 'online',
            'course_status'=>'in_progress',
        ]);

        return redirect()->back()->with('enrolled' , 'Enrolled Success');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Trainer;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    //dashboard
    public function dashboard(){
        $user_id = Auth::id();
        $user = User::with('student','student.course', 'trainer')->where('id' , $user_id)->first();
        return view('dashboard' , compact('user'));
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
        return view('front.category.showcategory' , compact('category'));
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
        $course = Course::findorfail($id);
        return view('front.courses.showcourse', compact('course'));
    }
}

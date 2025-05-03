<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Rules\Password;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Trainer;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

//This Controller Class will Mange all page from admin aspect
class AdminController extends Controller
{
    //Redirct to Main Admin Dashboard
    public function index()
    {
        $cat_count = Category::count();
        $c_count = Course::count();
        // $s_count = User::where('role' , 'student')->count();
        $s_count = Student::count();
        $t_count = Trainer::count();
        $u_count = User::count();
        $a_count = User::where('role', 'admin')->count();
        $c_count_deleted = Course::onlyTrashed()->count();
        $u_count_deleted = User::onlyTrashed()->count();
        return view('admin.index', compact('cat_count', 'c_count', 's_count', 't_count', 'u_count', 'a_count', 'c_count_deleted', 'u_count_deleted'));
    }
    ##****************Start Manage Members****************************#

    //Show All Members
    public function AllMembers()
    {
        $users = User::with('trainer.user', 'student.user')->paginate(10);
        return view('admin.members.allmembers', compact('users'));
    }

    // show Specific Member
    public function show($id)
    {
        $user = User::with(['trainer.course', 'student.course' => function ($s) {
            $s->withPivot('created_at');
        }], 'trainer')->findOrFail($id);

        return view('admin.members.showmember', compact('user'));
    }

    //add new member with its role
    public function AddMember()
    {
        return view('admin.members.AddMember');
    }

    public function store(Request $request)
    {
        //validate Requsts form inputs
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:' . User::class],
            'role' => ['required', 'string', 'exists:users,role'],
            'phone' => ['required', 'string', 'unique:' . User::class],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        //If validation good create the member
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'New Member has been added successfully.');
    }

    //edit member
    public function EditForm($id)
    {
        $user = User::with(['trainer', 'student.course' => function ($s) {
            $s->withPivot('created_at');
        }])->findOrFail($id);
        return view('admin.members.editmember', compact('user'));
    }

    public function EditMember(Request $request, $id)
    {
        //data form database
        $user = User::findOrfail($id);
        //Old data for user
        $name = $user->name;
        $email = $user->email;
        $phone = $user->phone;
        $address = $user->address;
        // $role = $user->role;
        $password = $user->password;

        // This good for if not edit or delete form and enter submit , will take old values
        //if edit form empty will take old value
        if ($request->has('name') && $request->name != null) {
            $request->validate(['name' => 'required|string|max:255']);
            $name = $request->name;
        }
        if ($request->has('email') && $request->email != null) {
            $request->validate(["email'=>'required|string|email|unique:users,email,$user->id"]);
            $email = $request->email;
        }
        if ($request->has('phone') && $request->phone != null) {
            $request->validate(['phone' => "required|string|unique:users,phone,$user->id"]);
            $phone = $request->phone;
        }
        if ($request->has('address') && $request->address != null) {
            $request->validate(['address' => 'required|string|max:255']);
            $address = $request->address;
        }
        // if ($request->has('role') && $request->role != null) {
        //     $request->validate(['role' => 'required|string|exists:users,role']);
        //     $role = $request->role;
        // }
        if ($request->password != null) {
            $request->validate(['password' => 'required|min:8|confirmed']);
            $password = $request->password;
            $password = bcrypt($password);
        }

        if ($request->has('hidden_role') && $request->hidden_role == 'student') {
            $student = Student::where('user_id', $user->id)->first();


            if ($request->has('status') && $request->status != null) {
                $request->validate(['status' => 'required|string|exists:students,status']);
                $status = $request->status;
            }

            //will accept all
            $courselocations = $request->input('course_location');
            $courseStatuses = $request->input('course_status');
            foreach ($courselocations as $courseId => $course_location) {
                $course_status = $courseStatuses[$courseId];
                //cause we not use the model for this
                // we will deal with db directly
                $request->validate([
                    'course_status.*'=>['required' , 'string' , "in:not_started,completed,in_progress"],
                    'course_location.*'=>['required' , 'string' , 'in:online,offline'],
                ]);

                DB::table('course_student')
                    ->where('course_id', $courseId)
                    ->where('student_id', $student->id)
                    ->update([
                        'course_location' => $course_location,
                        'course_status' => $course_status
                    ]);
            }

            $student->update(['status' => $status]);
        } elseif ($request->has('hidden_role') && $request->hidden_role == 'trainer') {

            $trainer = Trainer::where('user_id', $user->id)->first();
            $status = $trainer->status;
            if ($request->has('spec') && $request->spec != null) {
                $request->validate(['spec' => 'required|string']);
                $spec = $request->spec;
            }
            if ($request->has('desc') && $request->desc != null) {
                $request->validate(['desc' => 'required|string']);
                $desc = $request->desc;
            }
            if ($request->has('salary') && $request->salary != null) {
                $request->validate(['salary' => 'required|numeric']);
                $salary = $request->salary;
            }
            if ($request->has('exp') && $request->exp != null) {
                $request->validate(['exp' => 'required|numeric']);
                $experience = $request->exp;
            }
            if ($request->has('status') && $request->status != null) {
                $request->validate(['status' => 'required']);
                $status = $request->status;
            }

            $trainer->update([
                'spec' => $spec,
                'desc' => $desc,
                'salary' => $salary,
                'experience' => $experience,
                'status' => $status,
            ]);
        }

        $user->update([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            // 'role' => $role,
            'password'=>$password,
        ]);


        // dd($request->all());
        return redirect(url("admin/show/member/$user->id"))->with('success', 'member updated  Successfully');
    }

    public function DeleteMember($id)
    {
        $member = User::findorfail($id);

        // dd($member);
        $member->delete();

        return redirect(url('admin/allmembers'))->with('success', 'Member deleted Successfully');
    }

    //show trashed
    public function TrashedMembers()
    {
        $users = User::onlyTrashed()->paginate(6);
        return view('admin.members.trashedmembers', compact('users'));
    }

    //restore member
    public function RestoreMember($id)
    {
        $member = User::onlyTrashed()->findOrFail($id);
        $member->restore();
        return redirect(url("admin/show/member/$member->id"))->with('success', 'Member Restored Successfully');
    }


    //delete forever
    public function PDeleteMember($id)
    {
        $user = User::onlyTrashed()->findorFail($id);
        $user->forceDelete();
        return redirect()->back()->with('success', 'Member Deleted Forever Successfully');
    }

    ##****************End Manage Members****************************#


    ##****************Start Manage students****************************#
    //show all students
    public function AllStudents()
    {
        $students = User::where('role', 'student')->paginate(10);
        return view('admin.members.allstudetns', compact('students'));
    }

    //show all trainers
    public function AllTrainers()
    {
        $trainers = User::with('trainer')->where('role', 'trainer')->paginate(10);
        return view('admin.members.alltrainers', compact('trainers'));
    }

    ##****************End Manage students****************************#



    ##****************Start Manage Category****************************#

    //Categories
    public function AllCategories()
    {
        $categories = Category::paginate(6);
        return view('admin.category.allcategories', compact('categories'));
    }

    public function ShowCategory($id)
    {
        $category = Category::with(['course' => function ($f) {
            $f->withcount('student');
        }])->findorfail($id);
        return view('admin.category.showcategory', compact('category'));
    }

    public function AddCategoryForm()
    {
        return view('admin.category.addcategory');
    }

    public function StoreCategory(Request $request)
    {
        $category = $request->validate([
            'title' => 'required|string|max:255',
            'small_desc' => 'required|string|max:150',
            'desc' => 'required|string',
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);

        $category['image'] = Storage::putFile('Category', $category['image']);

        Category::create($category);

        return redirect()->back()->with('success', 'Category Saved Successfully');
    }


    //edit category
    public function EditCategoryForm($id)
    {
        $category = Category::findorfail($id);
        return view('admin.category.editcategory', compact('category'));
    }

    public function UpdateCategory(Request $request, $id)
    {
        $category = Category::findorfail($id);

        // old date
        $title = $category->title;
        $small_desc = $category->small_desc;
        $desc = $category->desc;
        $image = $category->image;

        if ($request->has('title') && $request->title != null) {
            $request->validate(['title' => 'required|string|max:255']);
            $title = $request->title;
        }
        if ($request->has('small_desc') && $request->small_desc != null) {
            $request->validate(['small_desc' => 'required|string|max:150']);
            $small_desc = $request->small_desc;
        }
        if ($request->has('desc') && $request->desc != null) {
            $request->validate(['desc' => 'required|string']);
            $desc = $request->desc;
        }
        if ($request->has('image') && $request->title != null) {
            $request->validate(['image' => 'required|mimes:png,jpg,jpeg']);
            Storage::delete($category->image);
            $image = Storage::putFile('Category', $request->image);
        }



        $category->update([
            'title' => $title,
            'small_desc' => $small_desc,
            'desc' => $desc,
            'image' => $image,
        ]);

        return redirect(url("admin/show/category/$category->id"))->with('success', 'Category Updated Successfully');
    }

    //delete category
    public function DeleteCategory($id)
    {
        $category = Category::findorfail($id);
        $category->delete();
        return redirect(url('admin/allcategories'))->with('success', 'Category Removed Successfully');
    }

    //show courses related to category
    public function ShowCategoryCourses($id)
    {
        $category = Category::findorfail($id);
        $courses = Course::where('category_id', $category->id)->get();
        return view('admin.category.categorycourses', compact('courses'));
    }

    //show deleted category (softdeleted)
    public function TrashedCategories()
    {
        $categories = Category::onlyTrashed()->paginate(6);
        return view('admin.category.trashedcategories', compact('categories'));
    }

    //restore categroy
    public function RestoreCategory($id)
    {
        $category = Category::onlyTrashed()->findorfail($id);
        $category->restore();
        return redirect(url("admin/show/category/$category->id"))->With('success', 'Category Restores Succssfully ');
    }

    // //delete for ever
    public function PDeleteCategory($id)
    {
        $category = Category::withTrashed()->findorfail($id);
        $category->forceDelete();
        return redirect()->back()->with('success', 'Category Deleted For Ever');
    }


    ##****************End Manage Category****************************#









    ##****************Start Manage Courses ****************************#

    //Courses
    //show
    public function AllCourses()
    {
        $courses = Course::paginate(6);
        return view('admin.courses.allcourses', compact('courses'));
    }

    public function ShowCourse($id)
    {
        $course = Course::with('student')->findorfail($id);
        return view('admin.courses.showcourse', compact('course'));
    }

    //add
    public function AddCourseForm()
    {
        $trainers = Trainer::all();
        $categories = Category::all();
        return view('admin.courses.addcourse', compact('trainers', 'categories'));
    }
    public function StoreCourse(Request $request)
    {
        $data  = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'trainer_id' => 'required|exists:trainers,id',
            'title' => 'required|string|max:100',
            'code' => 'required|unique:courses,code|regex:/^[A-Za-z]{2}[0-9]{3}$/',
            'small_desc' => 'required|string|max:100',
            'desc' => 'required|string',
            'price' => 'required|numeric|between:1000,15000',
            'duration' => 'required|numeric|between:30,270',
            'start_date' => 'required|date|after:tomorrow',
            // 'end_date'=>'required|date',
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);

        //we nee to make the end date is add dynamically
        $start_date = Carbon::parse($data['start_date']);
        // echo $start_date;
        //we convert it to int , cause the data come from form is string
        $duration = (int)$request->duration;
        $end_date = $start_date->copy()->addDays($duration);

        // //rename and store in public
        $image = Storage::putFile('Course', $data['image']);

        $newcourse = Course::create([
            'category_id' => $request->category_id,
            'trainer_id' => $request->trainer_id,
            'title' => $request->title,
            'code' => $request->code,
            'small_desc' => $request->small_desc,
            'desc' => $request->desc,
            'price' => $request->price,
            'duration' => $request->duration,
            'start_date' => $request->start_date,
            'end_date' => $end_date,
            'image' => $image,
        ]);


        return redirect(url('admin/allcourses'))->with('success', 'The New Course Add Successfully');
    }

    //edit

    public function EditCourseForm($id)
    {
        $course = Course::with('category', 'trainer')->findOrfail($id);
        $categories = Category::all();
        $trainers = Trainer::all();
        return view('admin.courses.editcourse', compact('course', 'categories', 'trainers'));
    }


    public function UpdateCourse($id, Request $request)
    {
        $course = Course::findOrfail($id);
        //take old date
        $title = $course->title;
        $code = $course->code;
        $category_id = $course->category_id;
        $trainer_id = $course->trainer_id;
        $price = $course->price;
        $duration = $course->duration;
        $start_date = $course->start_date;
        $end_date = $course->end_date;
        $small_desc = $course->small_desc;
        $desc = $course->desc;
        $image = $course->image;
        if ($request->has('title') && $request->title != null) {
            $request->validate(['title' => 'required|string|max:100']);
            $title = $request->title;
        }
        if ($request->has('code') && $request->code != null) {
            $request->validate(['code' => "required|unique:courses,code,$course->id|regex:/^[A-Za-z]{2}[0-9]{3}$/ "]);
            $code = $request->code;
        }
        if ($request->has('category_id') && $request->category_id != null) {
            $request->validate(['category_id' => 'required|numeric|exists:categories,id']);
            $category_id = $request->category_id;
        }
        if ($request->has('trainer_id') && $request->trainer_id != null) {
            $request->validate(['trainer_id' => 'required|exists:trainers,id']);
            $trainer_id = $request->trainer_id;
        }
        if ($request->has('price') && $request->price != null) {
            $request->validate(['price' => 'required|numeric|between:1000,15000']);
            $price = $request->price;
        }
        if ($request->has('small_desc') && $request->small_desc != null) {
            $request->validate(['small_desc' => 'required|string|max:150']);
            $small_desc = $request->small_desc;
        }
        if ($request->has('desc') && $request->desc != null) {
            $request->validate(['desc' => 'required|string']);
            $desc = $request->desc;
        }
        if ($request->has('duration') && $request->duration != null) {
            $request->validate(['duration' => 'required|numeric|between:30,270']);
            $duration = $request->duration;
        }
        if ($request->has('start_date') && $request->start_date != null) {
            $request->validate(['start_date' => 'required|date|after:tomorrow']);
            $start_date = $request->start_date;
            //update the end_date
            $s_date = Carbon::parse($start_date);
            $end_date = $s_date->copy()->addDays((int)$duration);
        }
        if ($request->has('image') && $request->image != null) {
            $request->validate(['image' => 'required|mimes:jpg,png,jpeg']);
            Storage::delete($course->image);
            $image = Storage::putFile('Course', $request->image);
        }

        $course->update([
            'category_id' => $category_id,
            'trainer_id' => $trainer_id,
            'title' => $title,
            'code' => $code,
            'small_desc' => $small_desc,
            'desc' => $desc,
            'price' => $price,
            'duration' => $duration,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'image' => $image,
        ]);

        return redirect(url("admin/show/course/$course->id"))->with('success', 'Course Updated Successfully');
    }

    //delete Course
    public function DeleteCourse($id)
    {
        $course = Course::findorfail($id);
        $course->delete();
        return redirect(url('admin/allcourses'))->with('success', 'Course Removed Successfully');
    }


    //show deleted Courses (softdeleted)
    public function TrashedCourses()
    {
        $courses = Course::onlyTrashed()->paginate(6);
        return view('admin.courses.trashedcourses', compact('courses'));
    }

    //restore coures
    public function RestoreCourse($id)
    {
        $course = Course::onlyTrashed()->findorfail($id);
        $course->restore();
        return redirect(url("admin/show/course/$course->id"))->With('success', 'Courses Restores Succssfully ');
    }

    //delete for ever
    public function ForceDeleteCourse($id)
    {
        $course = Course::withTrashed()->findorfail($id);
        $course->forceDelete();
        return redirect()->back()->with('success', 'Course Deleted For Ever');
    }
    ##****************Start Manage Courses ****************************#

}

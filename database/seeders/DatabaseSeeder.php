<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use App\Models\Student;
use App\Models\Trainer;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = Category::factory(5)->create();


        ## to create trainer and create user on one stage
        // $trainers = Trainer::factory(10)->create()->each(function($trainer){
        //     $trainer->user()->save(
        //         User::factory()->make(['role'=>'trainer'])
        //     );
        // });

        // $students = Student::factory(50)->create()->each(function($student){
        //     $student->user()->save(
        //         User::factory()->make(['role'=>'student'])
        //     );
        // });

        ## create all users then create trainers with role then student (more efficiect ) we will use where
        $users = User::factory(60)->create();
        //trainers
        $trainerUsers = User::where('role' , 'trainer')->get();
        $trainerUsers->each(function($user){
            Trainer::factory()->create(['user_id' => $user->id]);
        });
        $trainers = Trainer::all(); //get all trainers

        //students
        $studentUsers = User::where('role' , 'student')->get();
        $studentUsers->each(function($user){
            Student::factory()->create(['user_id' => $user->id]);
        });
        $students = Student::all();


        // $courses = Course::factory(20)->create()->each(function($course) use ($categories ,$trainers){
        //     //we used associate to link course with random category
        //     $course->category()->associate($categories->random());
        //     //we used associate to link course with  random trainer
        //     $course->trainer()->associate($trainers->random());
        //     //to create in date in DB
        //     $course->save();
        // });

        $courses = Course::factory(20)->make()->each(function($course) use ($categories, $trainers) {
            $course->category()->associate($categories->random());
            $course->trainer()->associate($trainers->random());
            $course->save();
        });
        /// very important releted to pivot table
        $students->each(function($student) use($courses){
            //we used attach to add data to pivot table
            $student->course()->attach(
                $courses->random(rand(1,3))->pluck('id')->toArray(),[
                    'status'=> 'active',
                    'course_status' => fake()->randomElement(['not_started' , 'in_progress' , 'completed']),
                    'course_location' =>fake()->randomElement(['online' , 'offline']),

                ]
            );
        });


    }

}


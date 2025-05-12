<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsStudent;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('front.index');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [FrontController::class, 'dashboard'])->middleware(['auth', IsStudent::class, 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//social icons

Route::controller(UserController::class)->group(function () {

    // for google
    Route::get('login/google', 'redirectGoogle')->name('login.google');
    Route::get('login/google/callback', 'redirectGoogleCallback');

    //for facebook
    Route::get('login/facebook', 'redirectFacebook')->name('login.facebook');
    Route::get('login/facebook/callback', 'redirectFacebookCallback');
});



Route::controller(FrontController::class)->group(function () {
    //main page with main category
    Route::get('/', 'index');

    //category
    Route::get('front/show/category/{id}', 'ShowCategory');
    Route::get('front/all/courses/category/{id}', 'ShowCategoryCourses');


    //Courses section
    //show all courses random
    Route::get('front/all/courses', 'AllCourses');

    Route::middleware('auth')->group(function () {
        Route::get('front/show/course/{id}', 'ShowCourse');

        //show my courses
        Route::get('front/show/mycourses', 'mycourses')->middleware(IsStudent::class);

        //enrolled in course
        Route::post('front/enrolled/course/{id}', 'enrolled')->name('enrolleCourse')->middleware(IsStudent::class);
    });
});



require __DIR__ . '/auth.php';

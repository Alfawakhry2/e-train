<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('front.index');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [FrontController::class , 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});


Route::controller(FrontController::class)->group(function(){
    //main page with main category
    Route::get('/' , 'index');

    //category
    Route::get('front/show/category/{id}' , 'ShowCategory');
    Route::get('front/all/courses/category/{id}' , 'ShowCategoryCourses');


    //Courses section
    //show all courses random
    Route::get('front/all/courses' , 'AllCourses');
    Route::get('front/show/course/{id}' , 'ShowCourse');


});



require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;


Route::controller(AdminController::class)->group(function () {
    //Main Page
    Route::get('admin/dashboard', 'index');

    ##****************Start Manage Members****************************#
    //Show Members
    Route::get('admin/allmembers', 'AllMembers');
    Route::get('admin/show/member/{id}', 'show');


    //Add new member
    Route::get('admin/AddMember', 'AddMember');
    Route::post('admin/addMember', 'store')->name('store');


    //edit Member
    Route::get('admin/edit/member/{id}', 'EditForm');
    Route::put('admin/edit/member/{id}', 'EditMember')->name('UpdateMember');

    //delete member
    Route::delete('admin/delete/member/{id}', 'DeleteMember')->name('DeleteMember');

    //show trashed member
    Route::get('admin/all/trashed/members', 'TrashedMembers');

    //restore member
    Route::get('admin/restore/member/{id}', 'RestoreMember')->name('RestoreMember');
    //permenent delete member

    Route::delete('admin/pdelete/member/{id}', 'PDeleteMember')->name('PDeleteMember');
    ##****************End Manage Members****************************#
    /***************************************************************/


    ##**************** Start Manage Student****************************#

    //Show Students
    Route::get('admin/allstudents', 'AllStudents');




    ##**************** End Manage Student****************************#
    /***************************************************************/


    ##**************** Start Manage Trainer ****************************#
    //Show Trainer
    Route::get('admin/alltrainers', 'AllTrainers');


    ##**************** End Manage Trainer ****************************#
    /***************************************************************/



    ##**************** Start Manage Categories****************************#
    //show Categories
    Route::get('admin/allcategories', 'AllCategories');
    Route::get('admin/show/category/{id}', 'ShowCategory');

    //add Category
    Route::get('admin/add/category', 'AddCategoryForm');
    Route::post('admin/add/category', 'StoreCategory')->name('StoreCategory');


    //edit category
    Route::get('admin/edit/category/{id}', 'EditCategoryForm');
    Route::put('admin/edit/category/{id}', 'UpdateCategory')->name('UpdateCategory');

    //courses related to category
    Route::get('admin/show/category/courses/{id}', 'ShowCategoryCourses');

    Route::delete('admin/delete/category/{id}', 'DeleteCategory')->name('DeleteCategory');

    //show deleted Categories
    Route::get('admin/all/trashed/categories', 'TrashedCategories');

    //restore trashed course
    Route::get('admin/restore/category/{id}', 'RestoreCategory')->name('RestoreCategory');

    //Permenent Delete
    Route::delete('admin/pdelete/category/{id}', 'PDeleteCategory')->name('PDeleteCategory');
    ##**************** End Manage Categories****************************#
    /***************************************************************/


    ##**************** Start Manage Courses****************************#
    //Courses
    //show
    Route::get('admin/allcourses', 'AllCourses');
    Route::get('admin/show/course/{id}', 'ShowCourse');

    //add
    Route::get('admin/add/course', 'AddCourseForm');
    Route::post('admin/add/course', 'StoreCourse')->name('StoreCourse');


    //edit
    Route::get('admin/edit/course/{id}', 'EditCourseForm');
    Route::put('admin/edit/course/{id}', 'UpdateCourse')->name('UpdateCourse');

    //delete
    Route::delete('admin/delete/course/{id}', 'DeleteCourse')->name('DeleteCourse');

    //show deleted course
    Route::get('admin/all/trashed/courses', 'TrashedCourses');

    //restore trashed course
    Route::get('admin/restore/course/{id}', 'RestoreCourse')->name('RestoreCourse');

    //Permenent Delete
    Route::get('admin/pdelete/course/{id}', 'ForceDeleteCourse')->name('ForceDeleteCourse');

    ##**************** End Manage Courses****************************#
    /***************************************************************/
});

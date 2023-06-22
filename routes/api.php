<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {

    Route::post('register', [Controllers\Api\v1\AuthController::class, 'createUser']);
    Route::post('login',    [Controllers\Api\v1\AuthController::class, 'loginUser']);

    Route::resource('institutions', Controllers\Api\v1\InstitutionController::class)->middleware('auth:sanctum')->only(['index', 'store', 'show', 'update', 'update']);
    Route::resource('roles', Controllers\Api\v1\UserRoleController::class)->middleware('auth:sanctum')->only(['index', 'store', 'show', 'update', 'update']);
    Route::resource('institutions.classrooms', Controllers\Api\v1\ClassroomController::class)->middleware('auth:sanctum')->only(['index', 'store', 'show', 'update', 'update']);
    Route::resource('institutions.classrooms.students', Controllers\Api\v1\StudentController::class)->shallow()->middleware('auth:sanctum')->only(['index', 'store', 'show', 'update', 'update']);
});

// Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');

/*

---------------------------------------- FOR API ----------------------------------------

common route : https://owlsms.com/api/v1/

    Account types : super-admin( only creators ), admin( teacher or principle/institute_owner ), user( student or parent )

    v1/register -   only principle/institute_owner, teacher, parent, student
    v1/login    -   only principle/institute_owner, teacher, parent, student

    Once you loged in - you will be directly assigned with a school. therefore the school-name wont be required to assign to the route.

    Here all the below are accesible by the super admin,

    Classes : 

        For Principles, Approved Teachers, for Head of the institute ( Admins ) :

        Access types : all, selected-id's in a json array

        GET    -   classes                  -   index   -   classes.index
        GET    -   classes/create           -   create  -   classes.create  :- only for super-admin
        POST   -   classes                  -   store   -   classes.store
        GET	   -   classes/{class-id}       -   show    - 	classes.show
        GET	   -   classes/{class-id}/edit	-   edit	-   classes.edit    :- only for super-admin
        PUT    -   classes/{class-id}	    -   update	-   classes.update
        DELETE -   classes/{class-id}	    -   destroy	-   classes.destroy

    Students : 

        For Teachers, Students, Parents ( Principles, Approved Teachers, for Head of the institute are also can ) :

        GET    -   classes/{class-id}/students                   -   index   -   students.index
        GET    -   classes/{class-id}/students/create            -   create  -   students.create
        POST   -   classes/{class-id}/students                   -   store   -   students.store
        GET	   -   classes/{class-id}/students/{student-id}      -   show    -   students.show      :- also for students, parents
        GET	   -   classes/{class-id}/students/{student-id}/edit -   edit	 -   students.edit      :- also for parents ( not students )
        PUT    -   classes/{class-id}/students/{student-id}	     -   update  -   students.update    :- also for parents ( not students )
        DELETE -   classes/{class-id}/students/{student-id}	     -   destroy -   students.destroy

---------------------------------------- FOR Web App ----------------------------------------

    Profile : 

        GET    -   profile                  -   index   =>   profile.show
        GET	   -   profile/edit	            -   edit	=>   profile.edit   :students data is not changed
        PUT    -   profile/{profile-id}	    -   update	=>   profile.update :students data is not changed
        DELETE -   profile/{profile-id}	    -   destroy	=>   profile.destroy

        // here if someone deleted the profile then that user don't have a profile unless its a student.

        // If some one removed the data of the student then that record of data won't be visible further for the student.

*/
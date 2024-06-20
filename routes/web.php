<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewsController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\StudentsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('Login');
});

Route::get('/inicio',[ViewsController::class,'inicioView']);
Route::get('/contacto',[ViewsController::class,'contactView']);

// Route::get('/teacher/{id}',[ViewsController::class, 'getOneTeacher']);
// Route::get('/teachers', [ViewsController::class, 'getAllTeachers']);
// Route::get('/students', [ViewsController::class, 'getAllStudents']);
// Route::get('/groups', [ViewsController::class, 'getAllGroups']);
// Route::get('/subjects', [ViewsController::class, 'getAllSubjects']);
// Route::get('/groups-with-students', [ViewsController::class, 'getGroupsWithStudents']);
// Route::get('/teachers-with-subjects', [ViewsController::class, 'getTeachersWithSubjects']);

Route::get('/dashboard',[ViewsController::class,'dashboard'])->name('dashboard');

Route::get('/view/teachers',[TeachersController::class, "view"])->name('teachers');
Route::get('/get/teachers',[TeachersController::class, "index"]);
Route::get('/get/teacher/{id}',[TeachersController::class, "show"]);
Route::post('/insert/teacher',[TeachersController::class, "store"]);
Route::put('/update/teacher/{id}',[TeachersController::class, "update"]);
Route::delete('/delete/teacher/{id}',[TeachersController::class, "destroy"]);

Route::get('/view/groups',[GroupsController::class, "view"])->name('groups');
Route::get('/get/groups',[GroupsController::class, "index"]);
Route::get('/get/group/{id}',[GroupsController::class, "show"]);
Route::post('/insert/group',[GroupsController::class, "store"]);
Route::put('/update/group/{id}',[GroupsController::class, "update"]);
Route::delete('/delete/group/{id}',[GroupsController::class, "destroy"]);

Route::get('/view/students',[StudentsController::class, "view"])->name('students');
Route::get('/get/students',[StudentsController::class, "index"]);
Route::get('/get/student/{id}',[StudentsController::class, "show"]);
Route::post('/insert/student',[StudentsController::class, "store"]);
Route::put('/update/student/{id}',[StudentsController::class, "update"]);
Route::delete('/delete/student/{id}',[StudentsController::class, "destroy"]);

Route::get('/view/subjects',[SubjectsController::class, "view"])->name('subjects');
Route::get('/get/subjects',[SubjectsController::class, "index"]);
Route::get('/get/subject/{id}',[SubjectsController::class, "show"]);
Route::post('/insert/subject',[SubjectsController::class, "store"]);
Route::put('/update/subject/{id}',[SubjectsController::class, "update"]);
Route::delete('/delete/subject/{id}',[SubjectsController::class, "destroy"]);

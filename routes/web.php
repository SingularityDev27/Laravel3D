<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('Login');
});

Route::get('/inicio',[ViewsController::class,'inicioView']);
Route::get('/contacto',[ViewsController::class,'contactView']);

Route::get('/teacher/{id}',[ViewsController::class, 'getOneTeacher']);
Route::get('/teachers', [ViewsController::class, 'getAllTeachers']);
Route::get('/students', [ViewsController::class, 'getAllStudents']);
Route::get('/groups', [ViewsController::class, 'getAllGroups']);
Route::get('/subjects', [ViewsController::class, 'getAllSubjects']);
Route::get('/groups-with-students', [ViewsController::class, 'getGroupsWithStudents']);
Route::get('/teachers-with-subjects', [ViewsController::class, 'getTeachersWithSubjects']);

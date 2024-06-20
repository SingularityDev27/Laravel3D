<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Group;
use App\Models\Subject;

class ViewsController extends Controller
{
    public function inicioView(){
        return view('inicio');
    }

    public function dashboard(){
        return view('templates.crud');
    }

    public function contactView(){
        return view('contact');
    }

    public function getOneTeacher(string $id){
        $teacher = Teacher::find($id);

        return response()->json($teacher);
    }

    public function getAllTeachers()
    {
        $teachers = Teacher::all();
        return response()->json($teachers);
    }

    public function getAllStudents()
    {
        $students = Student::all();
        return response()->json($students);
    }

    public function getAllGroups()
    {
        $groups = Group::all();
        return response()->json($groups);
    }

    public function getAllSubjects()
    {
        $subjects = Subject::all();
        return response()->json($subjects);
    }

    public function getGroupsWithStudents()
    {
        $groups = Group::with('students')->get();
        return response()->json($groups);
    }

    public function getTeachersWithSubjects()
    {
        $teachers = Teacher::with('subjects')->get();
        return response()->json($teachers);
    }
}

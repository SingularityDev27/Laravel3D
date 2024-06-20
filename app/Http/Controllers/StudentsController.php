<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;


class StudentsController extends Controller
{
    public function view(){
        return view('cruds.students');
    }

    public function index()
    {
        return response()->json(Student::with('group')->get(), 200);
    }

    public function show($id)
    {
        return response()->json(Student::find($id), 200);
    }

    public function store(Request $request)
    {
        $student = Student::create($request->all());
        return response()->json($student, 201);
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->all());
        return response()->json($student, 200);
    }

    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}

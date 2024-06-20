<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeachersController extends Controller
{
    public function view(){
        return view('cruds.teachers');
    }

    public function index()
    {
        return response()->json(Teacher::all(), 200);
    }

    public function show($id)
    {
        return response()->json(Teacher::find($id), 200);
    }

    public function store(Request $request)
    {
        $teacher = Teacher::create($request->all());
        return response()->json($teacher, 201);
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->update($request->all());
        return response()->json($teacher, 200);
    }

    public function destroy($id)
    {
        Teacher::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}

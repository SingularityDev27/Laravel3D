<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectsController extends Controller
{
    public function view(){
        return view('cruds.subjects');
    }

    public function index()
    {
        return response()->json(Subject::all(), 200);
    }

    public function show($id)
    {
        return response()->json(Subject::find($id), 200);
    }

    public function store(Request $request)
    {
        $subject = Subject::create($request->all());
        return response()->json($subject, 201);
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->update($request->all());
        return response()->json($subject, 200);
    }

    public function destroy($id)
    {
        Subject::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}

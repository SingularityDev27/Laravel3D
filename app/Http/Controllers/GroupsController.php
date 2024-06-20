<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;

class GroupsController extends Controller
{
    public function view(){
        return view('cruds.groups');
    }

    public function index()
    {
        return response()->json(Group::all(), 200);
    }

    public function show($id)
    {
        return response()->json(Group::find($id), 200);
    }

    public function store(Request $request)
    {
        $group = Group::create($request->all());
        return response()->json($group, 201);
    }

    public function update(Request $request, $id)
    {
        $group = Group::findOrFail($id);
        $group->update($request->all());
        return response()->json($group, 200);
    }

    public function destroy($id)
    {
        Group::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}

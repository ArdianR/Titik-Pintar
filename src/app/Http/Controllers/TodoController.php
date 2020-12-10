<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{
    # section is task = 0
    # status 1 = todo & 2 = done
    public function show($id)
    {
        $success['todo'] = Todo::findOrFail($id);
        return response()->json(['success' => $success], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'section' => 'required|integer',
            'task' => 'required|integer',
            'status' => 'required|integer',
        ]);

        $success['todo'] = Todo::create([
            'name' => $request->name,
            'section' => $request->section,
            'task' => $request->task,
            'status' => $request->status
        ]);

        return response()->json(['success' => $success], 200);
    }

    public function read()
    {
        $success['todo'] = Todo::all();
        return response()->json(['success' => $success], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'section' => 'required|integer',
            'task' => 'required|integer',
            'status' => 'required|integer',
        ]);

        $todo = Todo::findOrFail($id);
        $todo->update([
            'name' => $request->name,
            'section' => $request->section,
            'task' => $request->task,
            'status' => $request->status
        ]);
        $success['todo'] = $todo;
        return response()->json(['success' => $success], 200);
    }

    public function delete($id)
    {
        Todo::findOrFail($id)->delete();
        $success['todo'] = 'Delete Todo Successfully';
        return response()->json(['success' => $success], 200);
    }
}

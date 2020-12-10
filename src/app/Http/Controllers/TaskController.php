<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    # section is task = 0
    # status 1 = todo & 2 = done

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'section' => 'required|integer',
            'task' => 'required|integer',
            'status' => 'required|integer',
        ]);

        $success['task'] = Todo::create([
            'name' => $request->name,
            'section' => $request->section,
            'task' => $request->task,
            'status' => $request->status
        ]);

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

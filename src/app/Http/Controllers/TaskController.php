<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    # section = 0
    # task = 0
    # status 1 = todo & 2 = done

    public function show($id)
    {
        $success['task'] = Todo::findOrFail($id);
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

    public function change_state(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|integer',
        ]);

        $todo = Todo::findOrFail($id);
        $todo->update([
            'status' => $request->status
        ]);
        $success['todo'] = $todo;
        return response()->json(['success' => $success], 200);
    }

    public function filter_state($state)
    {
        $this->validate($request, [
            'status' => 'required|integer',
        ]);

        $success['todo'] = Todo::where('status', $state)->get();
        return response()->json(['success' => $success], 200);
    }

    public function search($task)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $success['todo'] = Todo::whereLike('name', $task)->get();
        return response()->json(['success' => $success], 200);
    }

    public function newest()
    {
        $success['todo'] = Todo::orderBy('created_at', 'DESC')->get();;
        return response()->json(['success' => $success], 200);
    }

    public function timestamp()
    {
        $todo = Todo::findOrFail(1);
        $diff = date_diff(date_create($todo->created_at), date("Y-m-d h:i:sa", $d));
        $success['todo'] = $diff->format("%h% hour ago");
        return response()->json(['success' => $success], 200);
    }

    public function accessible($access, $id)
    {
        if ($access == "sections") {
            $success['todo'] = Todo::where([
                'section' => 0,
                'id' => $id
            ])->get();
        } else {
            $success['todo'] = Todo::where([
                'task' => 0,
                'id' => $id
            ])->get();
        }
        return response()->json(['success' => $success], 200);
    }
}

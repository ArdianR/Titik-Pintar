<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

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
            'status' => 'required|integer',
        ]);

        $success['todo'] = Todo::create([
            'name' => $request->name,
            'section' => $request->section,
            'task' => 0,
            'status' => $request->status
        ]);

        return response()->json(['success' => $success], 200);
    }

    public function read()
    {
        $success['todo'] = Todo::where('task', 0)->get();
        return response()->json(['success' => $success], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'section' => 'required|integer',
            'status' => 'required|integer',
        ]);

        $todo = Todo::where([
            'id' => $id,
            'task' => 0
        ]);
        $todo->update([
            'name' => $request->name,
            'section' => $request->section,
            'status' => $request->status
        ]);
        $success['todo'] = $todo;
        return response()->json(['success' => $success], 200);
    }

    public function delete($id)
    {
        Todo::where([
            'id' => $id,
            'task' => 0
        ])->delete();
        $success['todo'] = 'Delete Todo Successfully';
        return response()->json(['success' => $success], 200);
    }

    public function caching()
    {
        Cache::put('key', 'value', $seconds = 10);
    }
}

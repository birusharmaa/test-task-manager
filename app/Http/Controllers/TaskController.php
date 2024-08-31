<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::where('is_completed', 0)->get();
        // dd($tasks);
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task' => 'required|unique:tasks,task'
        ]);

        $task = Task::create([
            'task' => $validated['task']
        ]);

        return response()->json($task);
    }

    public function update(Request $request, Task $task)
    {
        $task->update([
            'is_completed' => $request->is_completed
        ]);

        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }

    public function showAll()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

}

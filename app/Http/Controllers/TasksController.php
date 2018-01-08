<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $task = Task::latest()->get();

        return response()->json($task);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body'  => 'sometimes|max:500',
        ]);

        $task = Task::create($request->all());

        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Task         $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Task $task)
    {
        $this->validate($request, [
            'title'     => 'required|max:255',
            'body'      => 'sometimes|max:500',
            'completed' => 'sometimes|boolean',
        ]);

        $task->update($request->all());

        return response()->json($task->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $taskId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($taskId)
    {
        $task = Task::findOrFail($taskId);

        $task->delete();

        return response()->json(['success' => true], 204);
    }
}

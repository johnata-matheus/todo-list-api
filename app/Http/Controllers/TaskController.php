<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\{StoreTaskRequest, UpdateTaskRequest};
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())->get();

        return TaskResource::collection($tasks);
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        $this->authorize('view', $task);

        return TaskResource::make($task);
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create([
            'title'       => $request->title,
            'description' => $request->description,
            'status'      => $request->status,
            'user_id'     => auth()->id(),
        ]);

        return TaskResource::make($task);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        $task->update($request->validated());

        return TaskResource::make($task);
    }

    public function destroy($id)
    {
        // Logic to delete a task
    }
}

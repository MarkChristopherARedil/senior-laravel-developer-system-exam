<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $this->authorizeProject($project);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'status' => 'required|in:todo,in_progress,done',
            'due_date' => 'nullable|date',
        ]);

        $validated['project_id'] = $project->id;
        Task::create($validated);

        return back()->with('success', 'Task added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Task $task)
    {
        $this->authorizeProject($project);
        $validated = $request->validate([
            'status' => 'required|in:todo,in_progress,done'
        ]);
        $task->update($validated);
        return back()->with('success', 'Task updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Task $task)
    {
        $this->authorizeProject($project);
        $task->delete();
        return back()->with('success', 'Task deleted.');
    }

    /**
     * Auhorization Security Function
     */
    protected function authorizeProject(Project $project)
    {
        if (auth()->user()->role !== 'admin' && $project->user_id !== auth()->id()) {
            abort(403);
        }
    }
}

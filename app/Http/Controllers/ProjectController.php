<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $query = Project::query()->with('tasks');

        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        $projects = $query->orderBy('created_at', 'desc')->get();

        return view('pages.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        Project::create($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $this->authorizeView($project);
        $project->load('tasks.assignedTo');

        return view('pages.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('pages.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->authorizeView($project);
        $project->update($request->validated());

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->authorizeView($project);
        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project deleted successfully!');
    }

    /**
     * Autorize View function.
     */
    protected function authorizeView(Project $project)
    {
        if (auth()->user()->role !== 'admin' && $project->user_id !== auth()->id()) {
            abort(403);
        }
    }
}

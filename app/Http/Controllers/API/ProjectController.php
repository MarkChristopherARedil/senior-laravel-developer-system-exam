<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Project::query()->with(['user', 'tasks.assignedTo']);

        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        $projects = $query->latest()->paginate(15);
        $data = ProjectResource::collection($projects);

        return response()->json([
            "message" => "Success!",
            "data" => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;
        $project = Project::create($validated);
        $data = new ProjectResource($project->load('user'));

        return response()->json([
            "message" => "Project created successfully!",
            "data" => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load(['user', 'tasks.assignedTo']);
        $data = new ProjectResource($project);

        return response()->json([
            "message" => "Project retrieved successfully!",
            "data" => $data
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->validated());
        $data = new ProjectResource($project->load(['user', 'tasks.assignedTo']));

        return response()->json([
            "message" => "Project updated successfully!",
            "data" => $data
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json([
            "message" => "Project deleted successfully!"
        ], 200);
    }
}

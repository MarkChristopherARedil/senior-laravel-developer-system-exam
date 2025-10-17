@extends('layouts.app')
@section('title', 'Projects')

@section('custom_css')
<link type="text/css" rel="stylesheet" href="{{asset('./assets/css/dataTables.bootstrap5.css')}}?{{time()}}" />
<link type="text/css" rel="stylesheet" href="{{asset('./assets/css/nprogress.css')}}?{{time()}}" />
@endsection

@section('header')
	@include('layouts.header-layout.header', ['active_page' => 'projects'])
@endsection

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">{{ $project->title }}</h4>
            <div>
                <a href="{{ route('projects.index') }}" class="btn btn-sm btn-secondary text-capitalize me-2">Back</a>
                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-primary text-capitalize shadow-none">Edit</a>
            </div>
        </div>
        <div class="card-body">
            <p><strong>Description:</strong></p>
            <p>{{ $project->description ?: 'No description provided.' }}</p>

            <p><strong>Deadline:</strong> {{ $project->deadline ? \Carbon\Carbon::parse($project->deadline)->format('M d, Y') : 'None' }}</p>

            <hr>

            <h5>Task Progress</h5>
            @php
                $totalTasks = $project->tasks->count();
                $doneTasks = $project->tasks->where('status', 'done')->count();
                $progress = $totalTasks ? round(($doneTasks / $totalTasks) * 100) : 0;
            @endphp

            <div class="progress mb-3" style="height: 20px;">
                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar"
                     style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}"
                     aria-valuemin="0" aria-valuemax="100">
                    {{ $progress }}%
                </div>
            </div>

            <h5>Tasks</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Assigned To</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($project->tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>
                                <span class="badge bg-{{ $task->status === 'done' ? 'success' : ($task->status === 'in_progress' ? 'info' : 'secondary') }}">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                            </td>
                            <td>{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : '-' }}</td>
                            <td>
                                @if ($task->assignedTo)
                                    {{ $task->assignedTo->name }}
                                @else
                                    <span class="text-muted">Unassigned</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No tasks found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('title', 'Projects')

@section('header')
	@include('layouts.header-layout.header', ['active_page' => 'projects'])
@endsection

@section('content')

    <div class="container mt-3">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" data-mdb-dismiss="alert">
                <i class="fas fa-check-circle me-1"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Projects ({{ $projects->count() }})</h4>
            <a href="{{ route('projects.create') }}" class="btn btn-success text-capitalize">
                <i class="fas fa-plus me-1"></i>
                <span>New Project</span>
            </a>
        </div>

        @if ($projects->count())
            @foreach($projects as $project)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title mb-0">
                                <a href="{{ route('projects.show', $project) }}" class="text-decoration-none text-primary">
                                    {{ $project->title }}
                                </a>
                            </h5>
                            <p class="mb-0 text-muted small">
                                <strong>Deadline:</strong> {{ $project->deadline ?? 'N/A' }}
                            </p>
                        </div>
                        <p class="card-text">{{ $project->description }}</p>
                        <div class="mb-4">
                            <span class="fw-bold text-muted d-block mb-1">Progress:</span>
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-successs progress-bar-striped progress-bar-animated"
                                    role="progressbar"
                                    style="width: {{ $project->progressPercentage() }}%;"
                                    aria-valuenow="{{ $project->progressPercentage() }}"
                                    aria-valuemin="0"
                                    aria-valuemax="100">
                                    {{ $project->progressPercentage() }}%
                                </div>
                            </div>
                        </div>

                        <div class="text-start">
                            <a href="{{ route('projects.show', $project) }}" class="btn btn-info btn-sm shadow-none text-capitalize me-1">
                                <i class="fas fa-eye me-1"></i>
                                <span>Show</span>
                            </a>
                            <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning shadow-none text-capitalize btn-sm me-1">
                                <i class="fas fa-edit me-1"></i>
                                <span>Edit</span>
                            </a>
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger shadow-none text-capitalize btn-sm" onclick="return confirm('Are you sure you want to delete this project?')">
                                    <i class="fas fa-trash me-1"></i>
                                    <span>Delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No projects found.</p>
        @endif
    </div>
@endsection

@section('custom_js')
<script type="text/javascript">
    document.querySelectorAll('.alert .btn-close').forEach((btn) => {
        btn.addEventListener('click', () => {
            const alert = btn.closest('.alert');
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 300);
        });
    });
</script>
@endsection

@extends('layouts.app')
@section('title','Create Project')

@section('header')
	@include('layouts.header-layout.header', ['active_page' => 'projects'])
@endsection

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h4 class="mb-0">Create New Project</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Project Title <span class="text-danger">*</span></label>
                    <div class="form-outline" data-mdb-input-init>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror">
                    </div>
                    @error('title')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Description <span class="text-danger">*</span></label>
                    <div class="form-outline" data-mdb-input-init>
                        <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    </div>
                    @error('description')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label for="deadline" class="form-label fw-semibold">Deadline</label>
                    <div class="form-outline" data-mdb-input-init>
                        <input type="date" name="deadline" id="deadline" value="{{ old('deadline') }}" class="form-control @error('deadline') is-invalid @enderror">
                    </div>
                    @error('deadline')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('projects.index') }}" class="btn btn-secondary text-capitalize me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary text-capitalize shadow-none">Create Project</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

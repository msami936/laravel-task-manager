@extends('layouts.app')

@section('title', 'Create Task')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-plus me-2"></i>Create New Task
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Task Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="project_id" class="form-label">Project</label>
                        <select class="form-select @error('project_id') is-invalid @enderror" 
                                id="project_id" name="project_id" required>
                            <option value="">Select a project</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('project_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Back to Tasks
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Create Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 
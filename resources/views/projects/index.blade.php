@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-project-diagram me-2"></i>Projects</h1>
            <a href="{{ route('projects.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Add Project
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>
                    Projects ({{ $projects->count() }})
                </h5>
            </div>
            <div class="card-body">
                @if($projects->count() > 0)
                    <div class="row">
                        @foreach($projects as $project)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <h6 class="card-title mb-0">{{ $project->name }}</h6>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-sm btn-outline-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this project? This will also delete all associated tasks.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <p class="card-text">
                                            <i class="fas fa-tasks me-1"></i>
                                            {{ $project->tasks_count ?? 0 }} tasks
                                        </p>
                                        <div class="mt-auto">
                                            <a href="{{ route('tasks.index', ['project_id' => $project->id]) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye me-1"></i>View Tasks
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-project-diagram fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No projects found</h5>
                        <p class="text-muted">Create your first project to get started!</p>
                        <a href="{{ route('projects.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Create Project
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 
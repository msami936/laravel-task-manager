@extends('layouts.app')

@section('title', 'Project Details')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-eye me-2"></i>Project Details
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted">Project Information</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td>{{ $project->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>ID:</strong></td>
                                <td>{{ $project->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Created:</strong></td>
                                <td>{{ $project->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Updated:</strong></td>
                                <td>{{ $project->updated_at->format('M d, Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Statistics</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Total Tasks:</strong></td>
                                <td>{{ $project->tasks->count() }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('projects.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Back to Projects
                    </a>
                    <div>
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-primary me-2">
                            <i class="fas fa-edit me-1"></i>Edit Project
                        </a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this project? This will also delete all associated tasks.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-1"></i>Delete Project
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Project Tasks -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-tasks me-2"></i>
                    Project Tasks ({{ $project->tasks->count() }})
                </h5>
            </div>
            <div class="card-body">
                @if($project->tasks->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Priority</th>
                                    <th>Task Name</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($project->tasks->sortBy('priority') as $task)
                                    <tr>
                                        <td>
                                            <span class="badge bg-primary">{{ $task->priority }}</span>
                                        </td>
                                        <td>{{ $task->name }}</td>
                                        <td>{{ $task->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-outline-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-clipboard-list fa-2x text-muted mb-3"></i>
                        <h6 class="text-muted">No tasks in this project</h6>
                        <p class="text-muted">Create tasks to get started!</p>
                        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Create Task
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 
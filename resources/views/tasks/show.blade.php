@extends('layouts.app')

@section('title', 'Task Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-eye me-2"></i>Task Details
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted">Task Information</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td>{{ $task->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Priority:</strong></td>
                                <td>
                                    <span class="badge bg-primary">{{ $task->priority }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Created:</strong></td>
                                <td>{{ $task->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Updated:</strong></td>
                                <td>{{ $task->updated_at->format('M d, Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Project Information</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Project:</strong></td>
                                <td>{{ $task->project->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Project ID:</strong></td>
                                <td>{{ $task->project->id }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Back to Tasks
                    </a>
                    <div>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary me-2">
                            <i class="fas fa-edit me-1"></i>Edit Task
                        </a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this task?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-1"></i>Delete Task
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
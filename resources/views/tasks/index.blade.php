@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-tasks me-2"></i>Tasks</h1>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Add Task
            </a>
        </div>

        <!-- Project Filter -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('tasks.index') }}" class="row g-3">
                    <div class="col-md-6">
                        <label for="project_id" class="form-label">Filter by Project</label>
                        <select name="project_id" id="project_id" class="form-select" onchange="this.form.submit()">
                            <option value="">All Projects</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }} ({{ $project->tasks_count ?? 0 }} tasks)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i>Clear Filter
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tasks List -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>
                    Tasks ({{ $tasks->count() }})
                    <small class="text-muted">Drag and drop to reorder</small>
                </h5>
            </div>
            <div class="card-body">
                @if($tasks->count() > 0)
                    <div id="tasks-container">
                        @foreach($tasks as $task)
                            <div class="task-item card mb-3" data-task-id="{{ $task->id }}" data-priority="{{ $task->priority }}">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-grip-vertical text-muted me-3"></i>
                                            <div>
                                                <h6 class="mb-1">{{ $task->name }}</h6>
                                                <small class="text-muted">
                                                    <i class="fas fa-project-diagram me-1"></i>
                                                    {{ $task->project->name }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this task?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No tasks found</h5>
                        <p class="text-muted">Create your first task to get started!</p>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tasksContainer = document.getElementById('tasks-container');
    
    if (tasksContainer) {
        new Sortable(tasksContainer, {
            animation: 150,
            ghostClass: 'dragging',
            onEnd: function(evt) {
                const tasks = [];
                const taskItems = tasksContainer.querySelectorAll('.task-item');
                
                taskItems.forEach((item, index) => {
                    tasks.push({
                        id: item.dataset.taskId,
                        priority: index + 1
                    });
                });
                
                // Send the new order to the server
                fetch('{{ route("tasks.reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ tasks: tasks })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Tasks reordered successfully');
                })
                .catch(error => {
                    console.error('Error reordering tasks:', error);
                });
            }
        });
    }
});
</script>
@endpush 
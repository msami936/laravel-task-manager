@extends('layouts.app')

@section('title', 'Create Project')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-plus me-2"></i>Create New Project
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Project Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('projects.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Back to Projects
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Create Project
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 
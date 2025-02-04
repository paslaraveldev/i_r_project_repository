@extends('layouts.adminconstant')

@section('content')
<div class="container">
    <h1>Edit Project Type</h1>

    <form action="{{ route('project_types.update', $projectType->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="project_type_name">Project Type Name:</label>
            <input type="text" id="project_type_name" name="project_type_name" class="form-control" value="{{ $projectType->project_type_name }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control">{{ $projectType->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection

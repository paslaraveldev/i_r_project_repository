@extends('layouts.adminconstant')

@section('content')
<div class="container">
    <h1>Create New Project Type</h1>

    <form action="{{ route('project_types.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="project_type_name">Project Type Name:</label>
            <input type="text" id="project_type_name" name="project_type_name" class="form-control" required placeholder="Enter project type name">
        </div>

        <div class="form-group mt-3">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control" placeholder="Enter description"></textarea>
        </div>

        <button type="submit" class="btn btn-success mt-3">Save</button>
    </form>
</div>
@endsection

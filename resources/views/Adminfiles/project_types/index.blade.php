@extends('layouts.adminconstant')

@section('content')
<div class="container">
    <h1>Project Types</h1>
    
    <a href="{{ route('project_types.create') }}" class="btn btn-primary">Create New Project Type</a>

    <section class="section mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Project Type Details</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projectTypes as $projectType)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $projectType->project_type_name }}</td>
                                        <td>{{ $projectType->description }}</td>
                                        <td>
                                            <a href="{{ route('project_types.show', $projectType->id) }}" class="btn btn-info">View</a>
                                            <a href="{{ route('project_types.edit', $projectType->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('project_types.destroy', $projectType->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@extends('layouts.adminconstant')

@section('content')
    <div class="container">
        <h1>Departments</h1>
        <a href="{{ route('departments.create') }}" class="btn btn-success">Add Department</a>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Head of Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $department)
                    <tr>
                        <td>{{ $department->name }}</td>
                        <td>{{ $department->head->name ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('departments.edit', $department) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('departments.destroy', $department) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

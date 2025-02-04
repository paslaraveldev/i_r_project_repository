@extends('layouts.adminconstant')

@section('content')
    <div class="container">
        <h1>Edit Department</h1>
        <form action="{{ route('departments.update', $department) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Department Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $department->name }}" required>
            </div>
            <div class="form-group">
                <label for="head_of_department">Head of Department</label>
                <select id="head_of_department" name="head_of_department" class="form-control" required>
                    @foreach ($supervisors as $supervisor)
                        <option value="{{ $supervisor->id }}" {{ $department->head_of_department == $supervisor->id ? 'selected' : '' }}>
                            {{ $supervisor->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection

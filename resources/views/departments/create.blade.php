@extends('layouts.adminconstant')

@section('content')
    <div class="container">
        <h1>Create Department</h1>
        <form action="{{ route('departments.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Department Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="head_of_department">Head of Department</label>
                <select id="head_of_department" name="head_of_department" class="form-control" required>
                    <option value="" disabled selected>Select a head</option>
                    @foreach ($supervisors as $supervisor)
                        <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection

@extends('layouts.adminconstant')

@section('content')
<div class="container">
    <h1>Create New Course</h1>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <section class="section mt-4">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Course Details</h5>

                        <form action="{{ route('courses.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Course Name</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="department_id" class="form-label">Department</label>
                                <select id="department_id" name="department_id" class="form-select" required>
                                    <option value="" disabled selected>Select a department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Course</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

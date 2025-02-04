@extends('layouts.app')

@section('content')
    <h1>Create New User</h1>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="image">Image (URL)</label>
            <input type="text" id="image" name="image" value="{{ old('image') }}">
            @error('image')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            @error('password')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="role">Role</label>
            <select id="role" name="role">
                <option value="">Select Role</option>
                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                <option value="supervisor" {{ old('role') == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                <option value="project_coordinator" {{ old('role') == 'project_coordinator' ? 'selected' : '' }}>Project Coordinator</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="registration_number">Registration Number</label>
            <input type="text" id="registration_number" name="registration_number" value="{{ old('registration_number') }}">
            @error('registration_number')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="job_id_number">Job ID Number</label>
            <input type="text" id="job_id_number" name="job_id_number" value="{{ old('job_id_number') }}">
            @error('job_id_number')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="year_of_entry">Year of Entry</label>
            <input type="number" id="year_of_entry" name="year_of_entry" value="{{ old('year_of_entry') }}">
            @error('year_of_entry')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="course_id">Course</label>
            <select id="course_id" name="course_id">
                <option value="">Select Course</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
            @error('course_id')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="department_id">Department</label>
            <select id="department_id" name="department_id">
                <option value="">Select Department</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
            @error('department_id')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Create User</button>
    </form>
@endsection

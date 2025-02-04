@extends('layouts.adminconstant')

@section('content')
<div class="container">
    <h1>User Registration</h1>
    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif
    @if($errors->any())
        <ul class="error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('register.user') }}"  enctype="multipart/form-data">
        @csrf
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" placeholder="Enter full name" required>
 <div class="mb-3">
        <label for="image">Profile Picture (Optional, Max: 8 MB):</label>
    <input type="file" name="image" id="image" accept="image/*">
        </div>

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter email address" required>

        <label for="role">Role</label>
        <select id="role" name="role" required>
            <option value="" disabled selected>Select a role</option>
            <option value="student">Student</option>
            <option value="supervisor">Supervisor</option>
            <option value="project_coordinator">Project Coordinator</option>
            <option value="admin">Admin</option>
        </select>

        <div id="studentFields" style="display: none;">
            <label for="registration_number">Registration Number</label>
            <input type="text" id="registration_number" name="registration_number" placeholder="Enter registration number">
            <label for="course_id">Select Course</label>
            <select id="course_id" name="course_id">
                <option value="" disabled selected>Select a course</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
            <label for="year_of_entry">Entry Year</label>
            <input type="number" id="year_of_entry" name="year_of_entry" placeholder="Enter entry year" min="2000" max="{{ date('Y') }}">
        </div>

        <div id="staffFields" style="display: none;">
            <label for="job_id_number">Job ID Number</label>
            <input type="text" id="job_id_number" name="job_id_number" placeholder="Enter job ID number">
        </div>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter password" required>

        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required>

        <button type="submit">Register</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roleDropdown = document.getElementById('role');
            roleDropdown.addEventListener('change', toggleFields);
            toggleFields(); // Adjust fields on page load
        });

        function toggleFields() {
            const role = document.getElementById('role').value;

            document.getElementById('studentFields').style.display = 'none';
            document.getElementById('staffFields').style.display = 'none';

            if (role === 'student') {
                document.getElementById('studentFields').style.display = 'block';
            } else if (role === 'supervisor' || role === 'project_coordinator') {
                document.getElementById('staffFields').style.display = 'block';
            }
        }
    </script>
</div>
@endsection

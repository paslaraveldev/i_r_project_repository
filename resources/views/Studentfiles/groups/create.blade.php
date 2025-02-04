@extends('layout.studentconstant')


@section('content')
<div class="container">
    <h1>Create a New Group</h1>

    <!-- Display Validation Errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Group Creation Form -->
    <form action="{{ route('studentgroups.store') }}" method="POST">
        @csrf

        <!-- Group Name Input -->
        <div class="row mb-5">
            <label for="group_name" class="col-sm-2 col-form-label">Group Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter Group Name">
                @error('group_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Student Selection Table -->
        <div class="row mb-5">
            <label class="col-sm-2 col-form-label">Select Students</label>
            <div class="col-sm-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Select</th>
                            <th scope="col">Registration Number</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Group Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>
                                    <input type="checkbox" name="student_ids[]" value="{{ $student->id }}">
                                </td>
                                <td>{{ $student->registration_number }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>
                                    @if($student->groups()->exists())
                                        <span class="text-success">In a Group</span>
                                    @else
                                        <span class="text-danger">Not in a Group</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @error('student_ids')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Group</button>
    </form>
</div>
@endsection

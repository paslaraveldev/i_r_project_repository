@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Group</h1>

    <form method="POST" action="{{ route('groups.store') }}">
        @csrf

        <div class="form-group">
            <label>Select Students (Max: 3)</label>
            <select name="student_ids[]" class="form-control" multiple required>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">
                        {{ $student->name }} ({{ $student->registration_number }})
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-2">Create Group</button>
    </form>
</div>
@endsection

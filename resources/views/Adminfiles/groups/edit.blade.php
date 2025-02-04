@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Assign Supervisor to Group {{ $group->name }}</h1>
    <form action="{{ route('groups.update', $group->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="supervisor_id" class="form-label">Select Supervisor</label>
            <select name="supervisor_id" id="supervisor_id" class="form-select">
                <option value="">Unassign</option>
                @foreach($supervisors as $supervisor)
                    <option value="{{ $supervisor->id }}" {{ $group->supervisor_id == $supervisor->id ? 'selected' : '' }}>
                        {{ $supervisor->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Assign Supervisor</button>
    </form>
</div>
@endsection

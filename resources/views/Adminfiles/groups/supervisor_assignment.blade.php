@extends('layouts.adminconstant')

@section('content')
<div class="container">
    <h1>Assign Supervisor to {{ $group->name }}</h1>

    <form action="{{ route('groups.assign-supervisor.store', $group->id) }}" method="POST">
    @csrf
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Supervisor Name</th>
                <th>Select</th>
            </tr>
        </thead>
        <tbody>
            @foreach($supervisors as $supervisor)
                <tr>
                    <td>{{ $supervisor->name }}</td>
                    <td>
                        <input type="radio" name="supervisor_id" value="{{ $supervisor->id }}" 
                        {{ $group->supervisor && $group->supervisor->id == $supervisor->id ? 'checked' : '' }}>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary">Assign Supervisor</button>
</form>
</div>
@endsection

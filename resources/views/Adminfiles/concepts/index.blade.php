@extends('layouts.adminconstant')

@section('content')
<div class="container">
    <h1>All Concepts</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Group</th>
                <th>Supervisor</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($concepts as $concept)
            <tr>
                <td>{{ $concept->title }}</td>
                <td>{{ $concept->group->name }}</td>
                <td>{{ $concept->group->supervisor->name ?? 'N/A' }}</td>
                <td>{{ $concept->status }}</td>
                <td>
                    <a href="{{ route('admin.concepts.byGroup', $concept->group->id) }}">View Concepts</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

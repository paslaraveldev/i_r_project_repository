@extends('layouts.adminconstant')

@section('content')
<div class="container">
    <h1>Groups</h1>

    <a href="{{ route('groups.create') }}" class="btn btn-primary">Create New Group</a>

    <section class="section mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Group Details</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Group Name</th>
                                    <th>Students</th>
                                    <th>Supervisor</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($groups as $group)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $group->name }}</td>
                                        <td>
                                            @foreach($group->students as $student)
                                                {{ $student->name }} ({{ $student->registration_number }})<br>
                                            @endforeach
                                        </td>
                                        <td>{{ $group->supervisor->name ?? 'Not Assigned' }}</td>
                                        <td>
                                            <a href="{{ route('groups.assign-supervisor', $group->id) }}" class="btn btn-primary">Assign Supervisor</a>
                                            <a href="{{ route('groups.show', $group->id) }}" class="btn btn-info">View Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

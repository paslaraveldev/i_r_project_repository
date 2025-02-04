@extends('layouts.supervisorconstant')

@section('content')
<div class="container mt-5">
    <h1 class="text-center text-primary mb-4">Proposals by Groups</h1>

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if (isset($message))
        <p class="alert alert-warning text-center">{{ $message }}</p>
    @else
        @forelse ($groups as $group)
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <h4>Group: {{ $group->name }}</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($group->proposals as $proposal)
                                <tr>
                                    <td>{{ $proposal->title }}</td>
                                    <td>{{ $proposal->description }}</td>
                                    <td>{{ $proposal->status }}</td>
                                    <td>
                                        <a href="{{ route('supervisor.proposals.show', $proposal->id) }}" class="btn btn-primary">Review</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No proposals submitted yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <p class="alert alert-warning text-center">You are not assigned to any group.</p>
        @endforelse
    @endif
</div>
@endsection
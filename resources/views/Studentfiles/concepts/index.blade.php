@extends('layout.studentconstant')

@section('content')
@if($userGroup && $userGroup->students->isNotEmpty())
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Group: {{ $userGroup->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Group Members</h6>

                    <!-- Group Members Table -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Member Name</th>
                                <th scope="col">Position</th>
                                <th scope="col">Assigned Supervisor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userGroup->students as $index => $member)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->position }}</td>
                                    <td>
                                        {{ $userGroup->supervisor->name ?? 'No supervisor assigned' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-warning">No members found in this group.</div>
@endif

<!-- Display Group Concepts -->
@if(isset($userGroup) && $userGroup->concepts->isNotEmpty())
    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Group Concepts</h5>

                    <!-- Group Concepts Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Concept Title</th>
                                <th scope="col">Submitted By</th>
                                <th scope="col">Submission Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userGroup->concepts->sortBy('created_at') as $index => $concept)
                                @php
                                    $submittedBy = $userGroup->students->firstWhere('id', $concept->submitted_by);
                                @endphp
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td><a href="{{ route('concepts.show', $concept->id) }}">{{ $concept->title }}</a></td>
                                    <td>{{ $submittedBy->name ?? 'Unknown Member' }}</td>
                                    <td>{{ $concept->created_at->format('d M Y, h:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@else
    <p>No concepts submitted by your group yet.</p>
@endif

<!-- Button to create a new concept if no concepts exist -->
@if($userGroup && $userGroup->students->count() > 2 && $userGroup->concepts->isEmpty())
    <a href="{{ route('concepts.create') }}" class="btn btn-primary mt-4">Create a Concept</a>
@elseif($userGroup && $userGroup->concepts->where('status', '!=', 'Rejected')->count() < 3)
    <a href="{{ route('concepts.create') }}" class="btn btn-primary mt-4">Submit New Concept</a>
@else
    <div class="alert alert-warning mt-4">
        @if(!$userGroup)
            You are not assigned to any group.
        @elseif($userGroup->students->count() <= 2)
            Your group must have more than 2 members to submit concepts.
        @else
            Your group has already submitted the maximum of 3 concepts.
        @endif
    </div>
@endif

@endsection

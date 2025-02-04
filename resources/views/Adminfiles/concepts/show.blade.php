@extends('layouts.adminconstant')

@section('content')
<div class="container">
    <h1>Concepts for {{ $group->name }}</h1>

    <section class="section mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Concept Details</h5>

                        @foreach($concepts as $concept)
                        <div class="mb-4">
                            <p><strong>Title:</strong> {{ $concept->title ?? 'No Title Available' }}</p>
                            <p><strong>Objective:</strong> {{ $concept->main_objective ?? 'No Objective Provided' }}</p>
                            <p><strong>Other Objectives:</strong> {{ $concept->other_objectives ?? 'Not Provided' }}</p>
                            <p><strong>Description:</strong> {{ $concept->description ?? 'Not Provided' }}</p>
                            <p><strong>Significance:</strong> {{ $concept->significance ?? 'Not Provided' }}</p>
                            <p><strong>Status:</strong> {{ $concept->status ?? 'Not Provided' }}</p>

                            <!-- Accept Button -->
                            <form action="{{ route('admin.concepts.accept', $concept->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-success">Accept</button>
                            </form>

                            <!-- Reject Button -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $concept->id }}">
                                Reject
                            </button>

                            <!-- Reject Modal -->
                            <div class="modal fade" id="rejectModal{{ $concept->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $concept->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="rejectModalLabel{{ $concept->id }}">Reject Concept</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.concepts.reject', $concept->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="rejectionReason{{ $concept->id }}" class="form-label">Rejection Reason</label>
                                                    <textarea name="rejection_reason" id="rejectionReason{{ $concept->id }}" class="form-control" rows="3" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Reject</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

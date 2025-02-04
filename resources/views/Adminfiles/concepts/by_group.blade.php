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
                                <H2><strong>Title: {{ $concept->title }}</strong></h2>
                                <p><strong>Objective:</strong> {{ $concept->main_objective }}</p>
                                <p><strong>Other Objectives:</strong> {{ $concept->other_objectives }}</p>
                                <p><strong>Description:</strong> {{ $concept->description }}</p>
                                <p><strong>Significance:</strong> {{ $concept->significance }}</p>
                                <p><strong>Status:</strong> {{ $concept->status }}</p>

                                <!-- Single button to toggle between Accept and Reject -->
                                @if($concept->status == 'Accepted')
                                    <!-- Reject Form -->
                                    <form action="{{ route('admin.concepts.reject', ['id' => $concept->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <div class="form-group">
                                            <textarea name="rejection_reason" class="form-control mt-2" placeholder="Rejection reason" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-danger mt-2">Reject</button>
                                    </form>
                                @elseif($concept->status == 'Rejected')
                                    <!-- Accept Form -->
                                    <form action="{{ route('admin.concepts.accept', ['id' => $concept->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Accept</button>
                                    </form>
                                @else
                                    <!-- Accept Form or Reject Form -->
                                    <form action="{{ route('admin.concepts.accept', ['id' => $concept->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Accept</button>
                                    </form>
                                    <form action="{{ route('admin.concepts.reject', ['id' => $concept->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <div class="form-group">
                                            <textarea name="rejection_reason" class="form-control mt-2" placeholder="Rejection reason" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-danger mt-2">Reject</button>
                                    </form>
                                @endif
                            </div>
                        @endforeach

                        <!-- Prompt for admin to enter reason for final rejection if all concepts are rejected -->
                        @if($allRejected)
                            <form action="{{ route('admin.concepts.finalizeRejections') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <textarea name="final_rejection_reason" class="form-control mt-2" placeholder="Final rejection reason" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-warning mt-2">Finalize Rejections</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

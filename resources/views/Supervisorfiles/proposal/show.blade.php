@extends('layouts.supervisorconstant')

@section('content')
<div class="container mt-5">
    <h1 class="text-center text-primary mb-4">Review Proposal</h1>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-info text-white">
            <h4>Group: {{ $proposal->group->name }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Title:</strong> {{ $proposal->title }}</p>
            <p><strong>Description:</strong> {{ $proposal->description }}</p>

            <div class="mb-4">
                <strong>PDF:</strong>
                <a href="{{ route('supervisor.proposals.download', $proposal->id) }}" class="btn btn-success">Download</a>
            </div>

            <form action="{{ route('supervisor.proposals.upload', $proposal->id) }}" method="POST" enctype="multipart/form-data" class="mt-3">
                @csrf
                <div class="mb-3">
                    <label for="pdf" class="form-label">Upload Updated PDF</label>
                    <input type="file" name="pdf" id="pdf" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-warning">Upload</button>
            </form>

            <form action="{{ route('supervisor.proposals.review', $proposal->id) }}" method="POST" class="mt-3">
                @csrf
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="Needs Revision" {{ old('status', $proposal->status) == 'Needs Revision' ? 'selected' : '' }}>Needs Revision</option>
                        <option value="Approved" {{ old('status', $proposal->status) == 'Approved' ? 'selected' : '' }}>Approved</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="supervisor_comments" class="form-label">Supervisor Comments</label>
                    <textarea name="supervisor_comments" id="supervisor_comments" rows="4" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Review</button>
            </form>

            <!-- Display Previous Comments -->
            <div class="mt-4">
                <h5>Previous Comments</h5>
                @forelse($proposal->comments as $comment)
                    <div class="card mb-2">
                        <div class="card-body">
                            <p><strong>{{ $comment->supervisor->name }}:</strong></p>
                            <p>{{ $comment->comment }}</p>
                            <small><em>Reviewed on: {{ $comment->created_at->format('Y-m-d H:i:s') }}</em></small>
                        </div>
                    </div>
                @empty
                    <p>No comments have been made yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
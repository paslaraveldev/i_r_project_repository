@extends('layout.studentconstant')

@section('content')
<div class="container">
    <h2>Submit a Proposal</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('proposals.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Proposal Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="concept_id" class="form-label">Select Concept</label>
            <select name="concept_id" class="form-control" required>
                @foreach($concepts as $concept)
                    <option value="{{ $concept->id }}">{{ $concept->title }}</option>
                @endforeach
            </select>
        </div>

       <div class="mb-3">
    <label for="proposal_file" class="form-label">Upload Proposal (PDF only)</label>
    <input type="file" name="pdf" class="form-control" accept=".pdf" required>
</div>


        <button type="submit" class="btn btn-primary">Submit Proposal</button>
    </form>
</div>
@endsection

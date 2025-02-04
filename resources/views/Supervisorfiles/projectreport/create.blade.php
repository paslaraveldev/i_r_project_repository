@extends('layouts.supervisorconstant')

@section('content')
<div class="container">
    <h2>Submit Report</h2>
    <form action="{{ route('student.reports.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Abstract</label>
            <textarea name="abstract" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Description (Optional)</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Video Link (Optional)</label>
            <input type="url" name="video_link" class="form-control">
        </div>
        <div class="mb-3">
            <label>PDF Report</label>
            <input type="file" name="pdf_file" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Image (Optional)</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit Report</button>
    </form>
</div>
@endsection

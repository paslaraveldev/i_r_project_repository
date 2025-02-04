@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Report</h2>
    <form action="{{ route('studentreports.update', $report->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $report->title }}" required>
        </div>
        <div class="mb-3">
            <label for="abstract" class="form-label">Abstract</label>
            <textarea name="abstract" class="form-control">{{ $report->abstract }}</textarea>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $report->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Report</button>
    </form>
</div>
@endsection

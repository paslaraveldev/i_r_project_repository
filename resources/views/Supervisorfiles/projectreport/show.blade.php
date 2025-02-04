@extends('layouts.supervisorconstant')

@section('content')
<h1>Report: {{ $report->title }}</h1>

<p>Status: {{ $report->status }}</p>
<p>Group: {{ $report->group->name }}</p>

@if($report->uploaded_pdf)
<p><a href="{{ Storage::url($report->uploaded_pdf) }}" target="_blank">Download Uploaded PDF</a></p>
@endif

<h3>Supervisor Comments</h3>
@if($report->comments->isEmpty())
    <p>No comments yet.</p>
@else
    <ul>
        @foreach($report->comments as $comment)
            <li><strong>{{ $comment->supervisor->name }}:</strong> 
                {{ $comment->comment }} 
                ({{ $comment->created_at->format('d M Y, H:i') }})
            </li>
        @endforeach
    </ul>
@endif

  <a href="{{ route('supervisor.reports.download', $report->id) }}" class="btn btn-success">Download</a>

<form action="{{ route('supervisor.reports.review', $report->id) }}" method="POST">
    @csrf
    <label for="supervisor_comments">Add Comment:</label>
    <textarea name="supervisor_comments" required></textarea>
    
    <label for="status">Change Status:</label>
    <select name="status">
        <option value="Draft" {{ $report->status == 'Draft' ? 'selected' : '' }}>Draft</option>
        <option value="Ready for Submission" {{ $report->status == 'Ready for Submission' ? 'selected' : '' }}>Ready for Submission</option>
    </select>

    <button type="submit">Submit Review</button>
</form>
@endsection

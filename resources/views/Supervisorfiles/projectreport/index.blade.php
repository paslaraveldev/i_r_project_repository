@extends('layouts.supervisorconstant')

@section('content')
<div class="container">
    <h2 class="mb-4">Assigned Project Reports</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($reports->isEmpty())
        <p>No project reports assigned to you.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Project Title</th>
                    <th>Group</th>
                    <th>Status</th>
                    <th>Supervisor Comments</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>{{ $report->title }}</td>
                        <td>{{ $report->group->name }}</td>
                        <td>{{ $report->status }}</td>
                        <td>
                            @foreach($report->comments as $comment)
                                <strong>{{ $comment->supervisor->name }}:</strong> {{ $comment->comment }} <br>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('supervisor.reports.show', $report->id) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('supervisor.reports.download', $report->id) }}" class="btn btn-success">Download</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

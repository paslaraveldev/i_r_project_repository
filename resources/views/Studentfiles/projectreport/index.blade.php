@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Reports</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Submitted On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
            <tr>
                <td>{{ $report->title }}</td>
                <td>{{ $report->status }}</td>
                <td>{{ $report->submission_date }}</td>
                <td>
                    
                    <a href="{{ route('studentreports.download', $report->id) }}" class="btn btn-success">Download</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
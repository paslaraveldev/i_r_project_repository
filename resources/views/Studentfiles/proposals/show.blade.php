@extends('layout.studentconstant')

@section('content')
<div class="container">
    <h2>{{ $proposal->title }}</h2>
    <p><strong>Description:</strong> {{ $proposal->description }}</p>
    <p><strong>Status:</strong> {{ $proposal->status }}</p>

    <a href="{{ route('proposals.download', $proposal->id) }}" class="btn btn-primary">Download Proposal</a>
    <a href="{{ route('proposals.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection

@extends('layouts.supervisorconstant')

@section('title', 'Supervisor Dashboard - Proposals')

@section('header', 'Supervisor Dashboard')

@section('content')
    <!-- Proposals Card -->
    <div class="card">
        <h3>Upcoming Proposals</h3>
        <p>Review and approve the proposals submitted by students.</p>
        <a href="{{ route('supervisor.proposals.index') }}">
            <button>View Proposals</button>
        </a>
    </div>

 
@endsection

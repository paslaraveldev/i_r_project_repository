@extends('layout.studentconstant')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>All Groups</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item">Groups</li>
                <li class="breadcrumb-item active">All Groups</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Groups</h5>

                        <!-- Success Message -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Error Messages -->
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Display Groups -->
                        @if($groups->isEmpty())
                            <p>No groups have been created yet.</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Group Name</th>
                                        <th scope="col">Registration Number</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($groups as $group)
                                        @foreach($group->students as $student)
                                            <tr class="student-row">
                                                <td>{{ $group->name }}</td>
                                                <td>{{ $student->registration_number }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>
                                                    <a href="{{ route('studentgroups.show', $group->id) }}" class="btn btn-primary btn-sm">View</a>
                                                    <a href="{{ route('studentgroups.edit', $group->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('studentgroups.destroy', $group->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this group?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <!-- Separator Row for Groups -->
                                        <tr><td colspan="4" class="group-separator"></td></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        <!-- Create Group Button -->
                        <a href="{{ route('studentgroups.create') }}" class="btn btn-success">Create Group</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

<style>
    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        border: 1px solid #dee2e6;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 0.75rem;
        vertical-align: middle;
        border: 1px solid #dee2e6;
        text-align: left;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .group-separator {
        border-top: 3px solid #000;
        height: 2px;
        background-color: #f8f9fa;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        padding: 10px;
        margin-bottom: 15px;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
        padding: 10px;
        margin-bottom: 15px;
    }

    .btn {
        margin: 2px;
    }

    .breadcrumb-item a {
        text-decoration: none;
    }
</style>

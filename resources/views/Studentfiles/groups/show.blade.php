@extends('layout.studentconstant')


@section('content')
    <div class="container">
        <h1>Group: {{ $group->name }}</h1>

        <h3>Members:</h3>
        <ul>
            @foreach($group->students as $student)
                <li> <p> NAME: {{ $student->name }} <br>
                 EMAIL: {{ $student->email }}<br>
                 REGISTRATION NUMBER:{{$student->registration_number}}</li></p>
            @endforeach
        </ul>

        <a href="{{ route('studentgroups.index') }}" class="btn btn-secondary">Back to Groups</a>
    </div>
@endsection

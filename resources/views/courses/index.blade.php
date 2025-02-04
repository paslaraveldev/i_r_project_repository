@extends('layouts.adminconstant')

@section('content')
<div class="container">
    <h1>Courses</h1>

    <a href="{{ route('courses.create') }}" class="btn btn-primary">Add New Course</a>

    <section class="section mt-4">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Courses</h5>

                        <!-- Courses Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Course Name</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $course->name }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning me-2">Edit</a>
                                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Courses Table -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
@endsection

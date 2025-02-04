@extends('layout.studentconstant')

@section('content')
<div class="pagetitle">
    <h1>Submit New Concept</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Concepts</li>
            <li class="breadcrumb-item active">Submit Concept</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <!-- Display Success and Error Messages -->
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Concept Form -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Submit New Concept</h5>

                    <form method="POST" action="{{ route('concepts.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="main_objective" class="form-label">Main Objective</label>
                            <textarea class="form-control" id="main_objective" name="main_objective" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="other_objectives" class="form-label">Other Objectives</label>
                            <textarea class="form-control" id="other_objectives" name="other_objectives"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="significance" class="form-label">Significance</label>
                            <textarea class="form-control" id="significance" name="significance" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="confidentiality_level" class="form-label">Confidentiality Level</label>
                            <select class="form-control" id="confidentiality_level" name="confidentiality_level" required>
                                <option value="Public">Public</option>
                                <option value="Restricted">Restricted</option>
                                <option value="Confidential">Confidential</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Concept</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var quillMainObjective = new Quill('#main_objective', {
            theme: 'snow',
            modules: {
                toolbar: [['bold', 'italic', 'underline'], [{ 'list': 'ordered' }, { 'list': 'bullet' }], [{ 'align': [] }], ['link']]
            }
        });
    });
</script>
@endsection

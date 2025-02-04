@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Create Project Report</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('studentreports.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label for="concept_id" class="form-label">Select Concept</label>
            <select name="concept_id" id="concept_id" class="form-control" required>
                <option value="">-- Choose Concept --</option>
                @foreach($concepts as $concept)
                    <option value="{{ $concept->id }}">{{ $concept->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="project_type_id" class="form-label">Select Project Type</label>
            <select name="project_type_id" id="project_type_id" class="form-control" required>
                <option value="">-- Choose Project Type --</option>
                @foreach($projectTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->project_type_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Project Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="abstract" class="form-label">Abstract</label>
            <textarea name="abstract" id="abstract" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Upload Image (optional)</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="video_link" class="form-label">Video Link (optional)</label>
            <input type="url" name="video_link" id="video_link" class="form-control">
        </div>

        <div class="mb-3">
            <label for="pdf_file" class="form-label">Upload Report (PDF)</label>
            <input type="file" name="pdf_file" id="pdf_file" class="form-control" accept="application/pdf" required>
        </div>

        <div class="mb-3">
            <label for="confidentiality_level" class="form-label">Confidentiality Level</label>
            <select name="confidentiality_level" id="confidentiality_level" class="form-control" required>
                <option value="Public">Public</option>
                <option value="Restricted">Restricted</option>
                <option value="Confidential">Confidential</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit Report</button>
    </form>
</div>
@endsection
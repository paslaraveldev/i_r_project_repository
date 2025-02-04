<?php

namespace App\Http\Controllers;

use App\Models\ProjectType;
use Illuminate\Http\Request;

class ProjectTypeController extends Controller
{
    public function index()
    {
        $projectTypes = ProjectType::all();
        return view('Adminfiles.project_types.index', compact('projectTypes'));
    }

    public function create()
    {
        return view('Adminfiles.project_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_type_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        ProjectType::create($request->all());
        return redirect()->route('project_types.index')->with('success', 'Project Type created successfully.');
    }

    public function show(ProjectType $projectType)
    {
        return view('Adminfiles.project_types.show', compact('projectType'));
    }

    public function edit(ProjectType $projectType)
    {
        return view('Adminfiles.project_types.edit', compact('projectType'));
    }

    public function update(Request $request, ProjectType $projectType)
    {
        $request->validate([
            'project_type_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $projectType->update($request->all());
        return redirect()->route('project_types.index')->with('success', 'Project Type updated successfully.');
    }

    public function destroy(ProjectType $projectType)
    {
        $projectType->delete();
        return redirect()->route('project_types.index')->with('success', 'Project Type deleted successfully.');
    }
}

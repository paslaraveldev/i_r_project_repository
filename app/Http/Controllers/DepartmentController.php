<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;

class DepartmentController extends Controller
{
   public function index()
    {
        $departments = Department::with('head')->get();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        $supervisors = User::whereIn('role', ['supervisor', 'project_coordinator'])->get();
        return view('departments.create', compact('supervisors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'head_of_department' => 'required|exists:users,id',
        ]);

        Department::create($request->all());
        return redirect()->route('departments.index')->with('success', 'Department created successfully!');
    }

    public function edit(Department $department)
    {
        $supervisors = User::whereIn('role', ['supervisor', 'project_coordinator'])->get();
        return view('departments.edit', compact('department', 'supervisors'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'head_of_department' => 'required|exists:users,id',
        ]);

        $department->update($request->all());
        return redirect()->route('departments.index')->with('success', 'Department updated successfully!');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully!');
    }
}

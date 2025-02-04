<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Department;



class CourseController extends Controller
{
    public function index()
    {
        // Display all courses
        $courses = Course::all();
        $departments = Department::all();

        return view('courses.index', compact('courses','departments'));
    }


    public function create()
    {
    $departments = Department::all();
    return view('courses.create', compact('departments'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'department_id' => 'required|exists:departments,id', // Validate department_id
    ]);

    Course::create($request->only(['name', 'department_id']));

    return redirect()->route('courses.index')->with('success', 'Course created successfully');
    }
     public function edit($id)
    {
        $course = Course::findOrFail($id);
        $departments = Department::all();
        return view('courses.edit', compact('course', 'departments'));
    }

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'department_id' => 'required|exists:departments,id', // Validate department_id
    ]);

    $course = Course::findOrFail($id);
    $course->update($request->only(['name', 'department_id']));

    return redirect()->route('courses.index')->with('success', 'Course updated successfully');
}
    public function destroy($id)
    {
        // Delete the course
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully');
    }
}

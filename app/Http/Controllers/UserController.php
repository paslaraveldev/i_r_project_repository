<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Import the User model
use App\Models\Department;
use App\Models\Course;


class UserController extends Controller
{
    public function create()
    {
        // Fetch courses to display in the dropdown
        $courses = Course::all();
        return view('auth.registration', compact('courses'));
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'registration_number' => 'required|string|unique:users',
            'role' => 'required|in:student,supervisor,project_coordinator,admin',
            'course_id' => 'required|exists:courses,id',
            'year_of_entry' => 'required|integer|min:2000|max:' . date('Y'),
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create the user
        User::create($validatedData);

        // Redirect with a success message
        return redirect()->route('users.index')->with('success', 'User registered successfully!');
    }

}

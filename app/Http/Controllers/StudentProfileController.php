<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StudentProfileController extends Controller
{
    /**
     * Show the profile of the logged-in student.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        // Fetch the logged-in user (student)
        $student = Auth::user();

        // Pass the student data to the view
        return view('profile', compact('student'));
    }

    /**
     * Show the account settings page.
     *
     * @return \Illuminate\View\View
     */
    public function settings()
    {
        // Fetch the logged-in user (student)
        $student = Auth::user();

        // Pass the student data to the settings page
        return view('profile.settings', compact('student'));
    }

    /**
     * Update the student's profile information.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validate the updated profile information
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'image' => 'nullable|image|max:8192', // Allow images up to 8MB
        ]);

        // Get the logged-in student
        $student = Auth::user();

        // Update the student's profile data
        $student->name = $request->name;
        $student->email = $request->email;

        // Handle image upload
        if ($request->hasFile('image')) {
            $filename = 'student_image_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('assets/images/myimages'), $filename);
            $student->image = $filename;
        }

        $student->save();

        // Redirect to the profile page with a success message
        return redirect()->route('studentprofile.show')->with('success', 'Profile updated successfully');
    }
}

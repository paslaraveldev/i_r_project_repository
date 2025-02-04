<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserProfileController extends Controller
{
    
    // Display the profile of the currently logged-in user
    public function index()
    {
        $user = Auth::user(); // Get the currently logged-in user
        return view('profile.show', compact('user')); // Display the profile view
    }

    // Update the profile of the currently logged-in user
    public function update(Request $request)
    {
        $user = Auth::user(); // Get the currently logged-in user

        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'image' => 'nullable|image|max:8192', // Valid image up to 8MB
        ]);

        // Handle image upload if a file is provided
        if ($request->hasFile('image')) {
            // Generate a unique name for the image and store it
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images/users'), $imageName);
            $validatedData['image'] = $imageName;
        }

        // Update the user profile with validated data
        $user->update($validatedData);

        // Redirect back to the profile with a success message
        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }
}

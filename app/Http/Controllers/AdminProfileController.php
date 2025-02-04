<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminProfileController extends Controller
{
    public function index()
    {
        $admin = Auth::user(); // Get the currently logged-in admin
        return view('admin.profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
            'image' => 'nullable|image|max:8192', // Valid image up to 8MB
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images/users'), $imageName);
            $validatedData['image'] = $imageName;
        }

        $admin->update($validatedData);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}

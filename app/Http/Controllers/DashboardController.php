<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import the User model
use Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Course; // Assuming you have a Course model


class DashboardController extends Controller
{

   public function dashboard()
    {
        $user = Auth::user(); // Get the logged-in user

        if ($user->role == 'admin') {
            return view('admin.dashboard');
        } elseif ($user->role == 'student') {
            // Fetch courses and notifications specific to the student
            $courses = Course::where('id', $user->id)->get(); // Adjust as per your database schema
            

            return view('Studentfiles.studenthomepage', compact('user', 'courses'));
        } elseif ($user->role == 'supervisor') {
            return view('Supervisorfiles.dashboard');
        } else {
            return view('guestpage');
        }
    }

        }

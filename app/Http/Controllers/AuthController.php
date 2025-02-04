<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import the User model
use App\Models\Course; // Import the Course model
use App\Models\Department; 

use Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Mail\ForgotPasswordMail;
use Mail;


class AuthController extends Controller
{
    public function register()
    {
        $courses = Course::all();
        return view('auth.registration', compact('courses'));
    }

    public function storeRegister(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:student,supervisor,project_coordinator,admin',
            'image' => 'nullable|image|max:8192', // Valid image up to 8MB
        ]);

        if ($request->role === 'student') {
            $validatedData = array_merge($validatedData, $request->validate([
                'registration_number' => 'required|string|max:255|unique:users',
                'course_id' => 'required|exists:courses,id',
                'year_of_entry' => 'required|integer|min:2000|max:' . date('Y'),
            ]));
        } elseif (in_array($request->role, ['supervisor', 'project_coordinator'])) {
            $validatedData = array_merge($validatedData, $request->validate([
                'job_id_number' => 'required|string|max:255|unique:users',
                'department_id' => 'nullable|exists:departments,id',
            ]));
        } elseif ($request->role === 'admin') {
            $validatedData = array_merge($validatedData, $request->validate([
                'department_id' => 'nullable|exists:departments,id',
            ]));
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images/users'), $imageName);
            $validatedData['image'] = $imageName;
        }

        User::create(array_merge($validatedData, [
            'password' => Hash::make($validatedData['password']),
        ]));

        return redirect('login')->with('success', ucfirst($validatedData['role']) . ' registered successfully!');
    }


    public function login()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            if (Auth::user()->role == 'admin') {
               
                return redirect()->intended('admin/dashboard');
            } elseif (Auth::user()->role == 'student') {
                
                return redirect()->intended('studenthomepage');
            } elseif (Auth::user()->role == 'supervisor') {

                return redirect()->intended('supervisor/dashboard');
            } else {
                return redirect()->back()->with('error', 'Enter correct credentials');
            }
        } else {
            return redirect()->back()->with('error', 'Enter correct credentials');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login')->with('success', 'You have been logged out successfully.');
    }

    public function forgot()
    {
        return view('auth.forgot');
    }

    public function forgot_post(Request $request)
    {
        $count=User::where('email','=',$request->email)->count();
        if($count>0)
        {
            $user=User::where('email','=',$request->email)->first();
            $user->remember_token=Str::random(50);
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success','password reset');

        }
        else
        {
            return redirect()->back()->with('error','email not found ');

        }


    }
}

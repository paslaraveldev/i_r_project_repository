<?php

namespace App\Http\Controllers;
use App\Models\Group;
use App\Models\User;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::with(['students', 'supervisor'])->get(); // Eager load related students and supervisor
        $supervisors = User::where('role', 'supervisor')->get(); // Fetch supervisors
        return view('adminfiles.groups.index', compact('groups', 'supervisors'));
    }

    public function create()
    {
        $students = User::where('role', 'student')->get();
        return view('adminfiles.groups.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_ids' => 'required|array|min:1|max:3',
        ]);

        $groupNumber = Group::count() + 1;
        $groupName = 'Group ' . $groupNumber;

        $group = Group::create(['name' => $groupName]);

        $group->students()->attach($request->student_ids);

        return redirect()->route('groups.index')->with('success', 'Group created successfully!');
    }

       
           public function show($id)
    {
        $group = Group::with(['students', 'supervisor'])->findOrFail($id);
        $concepts = $group->concepts; // If concepts are related to the group
        return view('adminfiles.concepts.show', compact('group', 'concepts'));
    }







         public function assignSupervisorForm(Group $group)
    {
        $supervisors = User::where('role', 'supervisor')->get(); // Fetch supervisors
        return view('adminfiles.groups.supervisor_assignment', compact('group', 'supervisors'));
    }

    public function storeSupervisorAssignment(Request $request, Group $group)
    {
        $request->validate([
            'supervisor_id' => 'required|exists:users,id', // Ensure a valid supervisor is selected
        ]);

        // Assign the selected supervisor to the group
        $group->update(['supervisor_id' => $request->supervisor_id]);

        return redirect()->route('groups.index')->with('success', 'Supervisor assigned successfully!');
    }




            public function assignMultipleSupervisors(Request $request)
    {
        $request->validate([
            'supervisor' => 'required|array',
        ]);

        foreach ($request->supervisor as $groupId => $supervisorId) {
            $group = Group::findOrFail($groupId);
            $group->update(['supervisor_id' => $supervisorId]);
        }

        return redirect()->route('groups.index')->with('success', 'Supervisors assigned successfully!');
    }



}

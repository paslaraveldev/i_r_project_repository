<?php

namespace App\Http\Controllers;
use App\Models\Group;
use App\Models\User;

use Illuminate\Http\Request;

class StudentgroupController extends Controller
{
  
    /**
     * Display a listing of all groups.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all groups with their students
        $groups = Group::with('students')->get();
        return view('Studentfiles.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new group.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Fetch all students who are not already assigned to a group
        $students = User::where('role', 'student')
            ->whereDoesntHave('groups')
            ->get();

        return view('Studentfiles.groups.create', compact('students'));
    }

    /**
     * Store a newly created group in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_ids' => 'required|array|min:1|max:3',
        ]);

        // Ensure no student is already assigned to a group
        $studentsAlreadyInGroup = User::whereIn('id', $request->student_ids)
            ->whereHas('groups')
            ->exists();

        if ($studentsAlreadyInGroup) {
            return redirect()->back()->withErrors('One or more selected students already belong to a group.');
        }

        // Generate the group name automatically
        $groupNumber = Group::count() + 1;
        $groupName = 'GROUP ' . $groupNumber;

        // Create the new group
        $group = Group::create(['name' => $groupName]);

        // Attach the students to the group
        $group->students()->attach($request->student_ids);

        // Redirect back with a success message
        return redirect()->route('studentgroups.index')->with('success', 'Group created successfully!');
    }

    /**
     * Show the form for editing the specified group.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::with('students')->findOrFail($id);
        $students = User::where('role', 'student')
            ->whereDoesntHave('groups', function ($query) use ($id) {
                $query->where('id', '!=', $id);
            })
            ->orWhereHas('groups', function ($query) use ($id) {
                $query->where('id', $id);
            })
            ->get();

        return view('Studentfiles.groups.edit', compact('group', 'students'));
    }

    /**
     * Update the specified group in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'student_ids' => 'required|array|min:1|max:3',
        ]);

        $group = Group::findOrFail($id);

        // Ensure no student is assigned to multiple groups
        $studentsAlreadyInGroup = User::whereIn('id', $request->student_ids)
            ->whereHas('groups', function ($query) use ($id) {
                $query->where('id', '!=', $id);
            })
            ->exists();

        if ($studentsAlreadyInGroup) {
            return redirect()->back()->withErrors('One or more selected students already belong to another group.');
        }

        // Update the group's students
        $group->students()->sync($request->student_ids);

        return redirect()->route('studentgroups.index')->with('success', 'Group updated successfully!');
    }

    /**
     * Remove the specified group from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->students()->detach();
        $group->delete();

        return redirect()->route('studentgroups.index')->with('success', 'Group deleted successfully!');
    }

    /**
     * Display the specified group.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Fetch group with students
        $group = Group::with('students')->findOrFail($id);
        return view('Studentfiles.groups.show', compact('group'));
    }
}

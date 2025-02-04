<?php

namespace App\Http\Controllers;


use App\Models\Concept;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentConceptController extends Controller
{
   
    /**
     * Display a listing of the public concepts.
     */
    public function index()
    {
        // Fetch public concepts that are accepted and not confidential
        $publicConcepts = Concept::where('confidentiality_level', 'Public')
            ->where('status', 'Accepted')
            ->get();

        // Get the authenticated user's group
        $user = Auth::user();
        $userGroup = $user->groups()->first();

        // Fetch the group's concepts or return an empty collection
        $groupConcepts = $userGroup ? $userGroup->concepts : collect();

        // Check if the user belongs to a group, handle gracefully if not
        if (!$userGroup) {
            return redirect()->route('studentgroups.index')
                ->with('error', 'You do not belong to any group.');
        }

        return view('Studentfiles.concepts.index', compact('publicConcepts', 'groupConcepts', 'userGroup'));
    }

    /**
     * Show the form for creating a new concept.
     */
            public function create()
    {
        $user = Auth::user();
        $group = $user->groups()->first();

        // Check if the user belongs to a group
        if (!$group) {
            return redirect()->route('concepts.index')
                ->with('error', 'You are not assigned to any group.');
        }

        // Ensure the group has more than 2 members
        if ($group->students()->count() < 2) {
            return redirect()->route('concepts.index')
                ->with('error', 'Your group must have atleast 2 members to submit concepts.');
        }

        // Ensure the group hasn't exceeded the concept submission limit
        $nonRejectedConceptsCount = $group->concepts()->where('status', '!=', 'Rejected')->count();
        if ($nonRejectedConceptsCount >= 3) {
            return redirect()->route('concepts.index')
                ->with('error', 'Your group has already submitted the maximum of 3 concepts.');
        }

        return view('Studentfiles.concepts.create');
    }

        public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'main_objective' => 'required|string',
            'description' => 'required|string',
            'significance' => 'required|string',
            'confidentiality_level' => 'required|in:Public,Restricted,Confidential',
        ]);

        $user = Auth::user();
        $group = $user->groups()->first();

        // Check if the user belongs to a group
        if (!$group || $group->students()->count() < 2) {
            return redirect()->route('concepts.index')
                ->with('error', 'Your group must have more than 2 members to submit concepts.');
        }

        // Check if the group has reached the maximum of 3 non-rejected concepts
        $nonRejectedConceptsCount = $group->concepts()->where('status', '!=', 'Rejected')->count();
        if ($nonRejectedConceptsCount >= 3) {
            return redirect()->route('concepts.index')
                ->with('error', 'Your group has already submitted the maximum of 3 concepts.');
        }

        $group->concepts()->create([
            'title' => $request->title,
            'main_objective' => $request->main_objective,
            'other_objectives' => $request->other_objectives ?? null,
            'description' => $request->description,
            'significance' => $request->significance,
            'confidentiality_level' => $request->confidentiality_level,
            'status' => 'Pending',
        ]);

        return redirect()->route('concepts.index')
            ->with('success', 'Concept submitted successfully.');
    }
}

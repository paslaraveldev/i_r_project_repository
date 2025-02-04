<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Proposal;
use App\Models\Concept;
use Illuminate\Support\Facades\Auth;
class StudentProposalController extends Controller
{
    public function create()
    {
        // Fetch the user's group
        $user = Auth::user();
        $userGroup = $user->groups()->first(); // Get the first group

        if (!$userGroup) {
            return redirect()->route('studentgroups.index')
                ->with('error', 'You do not belong to any group.');
        }

        // Corrected group reference
        $concepts = Concept::where('group_id', $userGroup->id)->get();

        return view('Studentfiles.proposals.create', compact('concepts'));
    }

    /**
     * Store a new proposal.
     */
   public function store(Request $request)
{
    $request->validate([
        'concept_id' => 'required|exists:concepts,id',
        'pdf' => 'required|mimes:pdf|max:20480', // Max 20MB PDF file
        'description' => 'required|string', // Add validation for description
    ]);

    // Fetch the selected concept and check if it's accepted
    $concept = Concept::findOrFail($request->concept_id);
    if ($concept->status !== 'Accepted') {
        return redirect()->back()->with('error', 'The selected concept has not been accepted for proposals.');
    }

    $user = Auth::user();
    $userGroup = $user->groups()->first();

    if (!$userGroup) {
        return redirect()->route('studentgroups.index')
            ->with('error', 'You do not belong to any group.');
    }

    // Store the PDF file
    $path = $request->file('pdf')->store('proposals', 'public');

    // Create the proposal with status 'Draft' by default
    Proposal::create([
        'group_id' => $userGroup->id,
        'concept_id' => $concept->id,
        'description' => $request->description, // Corrected this line
        'title' => $concept->title, // Use the concept title
        'pdf_path' => $path,
        'status' => 'Draft', // Default status as Draft
        'submitted_by' => Auth::id(),
    ]);

    // Redirect to the index page with a success message
    return redirect()->route('proposals.index')->with('success', 'Proposal created successfully. You can submit it after supervisor approval.');
}

public function updateStatusToSubmitted($id)
{
    $proposal = Proposal::findOrFail($id);

    // Only allow the supervisor to change the status to 'Submitted'
    if (Auth::id() !== $proposal->reviewed_by) {
        return redirect()->back()->with('error', 'You are not authorized to submit this proposal.');
    }

    $proposal->update([
        'status' => 'Submitted',
    ]);

    return redirect()->route('proposals.index')->with('success', 'Proposal submitted successfully.');
}



    /**
     * Show all proposals submitted by the student's group.
     */
 public function index()
{
    $user = Auth::user();
    $group = $user->groups()->first();  // Get the first group of the logged-in user

    if (!$group) {
        return redirect()->back()->with('error', 'You must be assigned to a group to view proposals.');
    }

    $proposals = Proposal::where('group_id', $group->id)->get();

    return view('Studentfiles.proposals.index', compact('proposals', 'group')); // Pass group info to the view
}



    /**
     * Download the proposal PDF.
     */
    public function download($id)
    {
        $proposal = Proposal::findOrFail($id);

        if (!Storage::disk('public')->exists($proposal->pdf_path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return response()->download(storage_path('app/public/' . $proposal->pdf_path));
    }

    /**
     * Supervisor comments and update the proposal.
     */
    public function update(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);

        $request->validate([
            'supervisor_comments' => 'required|string',
            'status' => 'required|in:Needs Revision,Approved', // Only allow valid statuses
        ]);

        $proposal->update([
            'supervisor_comments' => $request->supervisor_comments,
            'status' => $request->status,
            'supervisor_commented_at' => now(),
            'reviewed_by' => Auth::id(), // Assuming the supervisor is logged in
        ]);

        return redirect()->back()->with('success', 'Proposal updated successfully.');
    }
}

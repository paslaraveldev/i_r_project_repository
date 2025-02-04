<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Proposal;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use App\Models\ProposalComment;



class SupervisorProposalController extends Controller
{ /**
     * Display all groups assigned to the supervisor and their proposals.
     */
    public function index()
{
    $supervisor = Auth::user();

    // Fetch only groups assigned to the supervisor where 'supervisor_id' is not null
    $groups = Group::where('supervisor_id', $supervisor->id)
        ->whereNotNull('supervisor_id') // Ensure supervisor_id is not null
        ->with('proposals')
        ->get();

    if ($groups->isEmpty()) {
        return view('Supervisorfiles.proposal.index', ['message' => 'No groups assigned to you.']);
    }

    return view('Supervisorfiles.proposal.index', compact('groups'));
}


    /**
     * Show a specific proposal for review.
     */
   // app/Http/Controllers/SupervisorProposalController.php

public function show($id)
{
    $supervisor = Auth::user();

    // Fetch the proposal with its comments
    $proposal = Proposal::with(['group', 'comments'])->whereHas('group', function ($query) use ($supervisor) {
        $query->where('supervisor_id', $supervisor->id);
    })->find($id);

    // Check if proposal is found and belongs to the assigned group
    if (!$proposal) {
        return redirect()->route('supervisor.proposals.index')->with('error', 'You are trying to review a proposal that is not assigned to you.');
    }

    // Pass the comments to the view
    return view('Supervisorfiles.proposal.show', compact('proposal'));
}




    /**
     * Download the proposal PDF.
     */
   public function download($id)
{
    $supervisor = Auth::user();
    $proposal = Proposal::whereHas('group', function ($query) use ($supervisor) {
        $query->where('supervisor_id', $supervisor->id);
    })->findOrFail($id);

    if (!Storage::disk('public')->exists($proposal->pdf_path)) {
        return redirect()->back()->with('error', 'File not found.');
    }

    return response()->download(storage_path('app/public/' . $proposal->pdf_path));
}


    /**
     * Upload a new version of the proposal PDF.
     */
    public function upload(Request $request, $id)
    {
        $supervisor = Auth::user();

        // Find the proposal, ensuring it belongs to a group assigned to the supervisor
        $proposal = Proposal::whereHas('group', function ($query) use ($supervisor) {
            $query->where('supervisor_id', $supervisor->id);
        })->findOrFail($id);

        $request->validate([
            'pdf' => 'required|mimes:pdf|max:20480', // Max 20MB PDF file
        ]);

        if (Storage::disk('public')->exists($proposal->pdf_path)) {
            Storage::disk('public')->delete($proposal->pdf_path);
        }

        $path = $request->file('pdf')->store('proposals', 'public');

        $proposal->update([
            'pdf_path' => $path,
        ]);

        return redirect()->back()->with('success', 'Proposal PDF updated successfully.');
    }

    /**
     * Update the status and comments for a proposal.
     */
     /**
     * Update the status and comments for a proposal.
     */
    public function review(Request $request, $id)
    {
        $supervisor = Auth::user();

        // Find the proposal, ensuring it belongs to a group assigned to the supervisor
        $proposal = Proposal::whereHas('group', function ($query) use ($supervisor) {
            $query->where('supervisor_id', $supervisor->id);
        })->findOrFail($id);

        // Validate input
        $request->validate([
            'status' => 'required|in:Needs Revision,Approved',
            'supervisor_comments' => 'required|string',
        ]);

        // Store the new comment in the ProposalComment table
        ProposalComment::create([
            'proposal_id' => $proposal->id,
            'supervisor_id' => $supervisor->id,
            'comment' => $request->supervisor_comments,
        ]);

        // Update the status of the proposal
        $proposal->update([
            'status' => $request->status,
        ]);

        return redirect()->route('supervisor.proposals.index')->with('success', 'Proposal reviewed successfully.');
    }
}

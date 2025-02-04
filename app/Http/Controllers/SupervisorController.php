<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SupervisorController extends Controller
{
  // Display only proposals assigned to the logged-in supervisor
    public function index()
    {
        $supervisorId = Auth::id();
        $proposals = Proposal::whereHas('group', function ($query) use ($supervisorId) {
            $query->where('supervisor_id', $supervisorId);
        })->get();
        
        return view('Supervisorfiles.proposal.index', compact('proposals'));
    }

    // Show proposal details
    public function show($id)
    {
        $proposal = Proposal::findOrFail($id);
        $this->authorize('view', $proposal);
        
        return view('Supervisorfiles.proposal.show', compact('proposal'));
    }

    // Add a comment to a proposal
    public function addComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);
        
        $proposal = Proposal::findOrFail($id);
        $this->authorize('update', $proposal);
        
        $proposal->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->comment,
        ]);
        
        return redirect()->back()->with('success', 'Comment added successfully');
    }

    // Change proposal status
    public function changeStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Draft,Submitted,Approved,Rejected'
        ]);
        
        $proposal = Proposal::findOrFail($id);
        $this->authorize('update', $proposal);
        
        $proposal->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'Proposal status updated');
    }

    // Upload a report
    public function uploadReport(Request $request, $id)
    {
        $request->validate([
            'report' => 'required|mimes:pdf|max:2048'
        ]);
        
        $proposal = Proposal::findOrFail($id);
        $this->authorize('update', $proposal);
        
        $filePath = $request->file('report')->store('reports');
        
        $proposal->update(['report_path' => $filePath]);
        
        return redirect()->back()->with('success', 'Report uploaded successfully');
    }

    // Download a report
    public function downloadReport($id)
    {
        $proposal = Proposal::findOrFail($id);
        $this->authorize('view', $proposal);
        
        if (!$proposal->report_path || !Storage::exists($proposal->report_path)) {
            return redirect()->back()->with('error', 'Report not found');
        }
        
        return Storage::download($proposal->report_path);
    }
}

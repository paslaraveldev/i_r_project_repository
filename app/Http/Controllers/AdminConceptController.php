<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concept;
use App\Models\Group;
use Illuminate\Support\Facades\Mail;


class AdminConceptController extends Controller
{
    
    /**
     * Display all submitted concepts with their details.
     */
    public function index()
    {
        $concepts = Concept::with(['group', 'group.supervisor'])->orderBy('created_at', 'desc')->get();
        return view('Adminfiles.concepts.index', compact('concepts'));
    }

    /**
     * Show details of a specific concept.
     */
    public function show($id)
    {
        $concept = Concept::with('group.supervisor')->findOrFail($id);
        return view('Adminfiles.concepts.show', compact('concept'));
    }

    /**
     * Accept a concept, ensuring only one concept per group is accepted.
     */

public function accept($id)
{
    $concept = Concept::findOrFail($id);
    $group = $concept->group;

    // Reject all other concepts in the group before accepting this one
    $group->concepts()->update(['status' => 'Rejected']);

    $concept->update(['status' => 'Accepted', 'rejection_reason' => null]);

    // Get supervisor name
    $supervisorName = $group->supervisor ? $group->supervisor->name : 'No Supervisor Assigned';

    // Notify all group members
    $students = $group->students;
    foreach ($students as $student) {
        Mail::send('emails.conceptAccepted', [
            'studentName' => $student->name,
            'conceptTitle' => $concept->title,
            'supervisorName' => $supervisorName,
        ], function ($message) use ($student) {
            $message->to($student->email)
                    ->subject('Your Concept has been Accepted');
        });
    }

    return redirect()->back()->with('success', 'Concept accepted successfully and emails sent to the group members.');
}


    /**
     * Reject a concept.
     */
    public function reject(Request $request, $id)
{
    $concept = Concept::findOrFail($id);

    // Ensure a reason is provided for rejection
    $request->validate([
        'rejection_reason' => 'required|string|max:255',
    ]);

    // Update the concept's status and reason
    $concept->update(['status' => 'Rejected', 'rejection_reason' => $request->rejection_reason]);

    $group = $concept->group;

    // Check if all concepts in the group are rejected
    $allRejected = $group->concepts()->where('status', '!=', 'Rejected')->doesntExist();

    if ($allRejected) {
        // Send email to group members
        $this->notifyGroupOnRejection($group);
    }

    return redirect()->back()->with('success', 'Concept rejected successfully.');
}


    /**
     * Finalize rejection when all concepts are rejected.
     */
    public function finalizeRejections(Request $request)
    {
        $rejectedGroups = Group::whereDoesntHave('concepts', function ($query) {
            $query->where('status', 'Accepted');
        })->get();

        foreach ($rejectedGroups as $group) {
            $group->concepts()->update(['status' => 'Rejected']);
        }

        return redirect()->back()->with('success', 'All rejections finalized.');
    }

    /**
     * Check if all concepts in a group are rejected.
     */
    public function conceptsByGroup($groupId)
    {
        $group = Group::with('concepts')->findOrFail($groupId);
        $concepts = $group->concepts;
        $allRejected = $concepts->every(function ($concept) {
            return $concept->status == 'Rejected';
        });

        return view('Adminfiles.concepts.by_group', compact('group', 'concepts', 'allRejected'));
    }

    protected function notifyGroupOnRejection($group)
    {
        $students = $group->students; // Get all students in the group
        $supervisorName = $group->supervisor->name ?? 'Supervisor';
        $rejectionReasons = $group->concepts()->pluck('rejection_reason')->filter()->toArray();

        foreach ($students as $student) {
            Mail::send('emails.concepts.rejected', [
                'studentName' => $student->name,
                'groupName' => $group->name,
                'supervisorName' => $supervisorName,
                'rejectionReasons' => $rejectionReasons,
            ], function ($message) use ($student) {
                $message->to($student->email)
                        ->subject('Concepts Rejected Notification');
            });
        }
    }


}

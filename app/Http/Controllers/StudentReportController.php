<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Group;
use App\Models\Concept;
use App\Models\ProjectType;
use Illuminate\Support\Facades\Storage;
use App\Notifications\ReportSubmitted;



class StudentReportController extends Controller
{
  public function create()
    {
        $group = auth()->user()->groups()->first();
        $concepts = Concept::where('group_id', $group->id)->where('status', 'Accepted')->get();
        $projectTypes = ProjectType::all();
        return view('Studentfiles.projectreport.create', compact('group', 'concepts', 'projectTypes'));
    }


public function store(Request $request)
{
    $request->validate([
        'concept_id' => 'required|exists:concepts,id',
        'project_type_id' => 'required|exists:project_types,id',
        'title' => 'required|string|max:255',
        'abstract' => 'required|string',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg',
        'video_link' => 'nullable|url',
        'pdf_file' => 'required|mimes:pdf',
        'confidentiality_level' => 'required|in:Public,Restricted,Confidential',
    ]);

    // Ensure the directory exists
    $reportDirectory = public_path('assets/projectreport/');
    if (!file_exists($reportDirectory)) {
        mkdir($reportDirectory, 0777, true);
    }

    // Store PDF in public/assets/projectreport
    $pdfFile = $request->file('pdf_file');
    $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
    $pdfPath = 'assets/projectreport/' . $pdfFileName;
    $pdfFile->move($reportDirectory, $pdfFileName);

    // Store image if provided
    $imagePath = null;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageFileName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('assets/report_images/'), $imageFileName);
        $imagePath = 'assets/report_images/' . $imageFileName;
    }

    $report = Report::create([
        'group_id' => auth()->user()->groups()->first()->id,
        'concept_id' => $request->concept_id,
        'project_type_id' => $request->project_type_id,
        'title' => $request->title,
        'description' => $request->description,
        'image' => $imagePath,
        'abstract' => $request->abstract,
        'video_link' => $request->video_link,
        'pdf_file' => $pdfPath,
        'status' => 'Draft',
        'submitted_by' => auth()->id(),
        'confidentiality_level' => $request->confidentiality_level,
    ]);

    // Fetch the supervisor assigned to the group
    $supervisor = $report->group->supervisor; // Assuming you have a `supervisor` relation on the `Group` model

    if ($supervisor) {
        // Notify the supervisor about the new report submission
        $supervisor->notify(new ReportSubmitted($report));
    }

    return redirect()->route('studentreports.index')->with('success', 'Report submitted successfully.');
}

public function index()
{
    $user = auth()->user();

    // Fetch the first group the user belongs to
    $group = $user->groups()->first();

    if (!$group) {
        return redirect()->route('studentgroups.index')->with('error', 'You are not assigned to any group.');
    }

    $reports = Report::where('group_id', $group->id)->get();
    
    return view('Studentfiles.projectreport.index', compact('reports'));
}




    public function download($id)
    {
        $report = Report::findOrFail($id);
        return response()->download(public_path($report->pdf_file));

    }

    public function updateStatusToSubmitted($id)
    {
        $report = Report::findOrFail($id);
        $report->update(['status' => 'Ready for Submission']);
        return redirect()->route('studentreports.index')->with('success', 'Report submitted successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Needs Revision,Approved',
            'supervisor_comments' => 'nullable|string',
            'revision_needed' => 'boolean',
        ]);

        $report = Report::findOrFail($id);
        $report->update([
            'status' => $request->status,
            'supervisor_comments' => $request->supervisor_comments,
            'revision_needed' => $request->revision_needed,
            'reviewed_by' => auth()->id(),
            'supervisor_commented_at' => now(),
        ]);

        return redirect()->route('studentreports.index')->with('success', 'Report updated successfully.');
    }
}

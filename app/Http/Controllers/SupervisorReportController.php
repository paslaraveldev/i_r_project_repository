<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Report;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use App\Models\ReportComment;
use App\Mail\SupervisorCommentNotification;
use Illuminate\Support\Facades\Mail;

class SupervisorReportController extends Controller
{ /**
     * Display all project reports for groups assigned to the supervisor.
     */
    public function index()
    {
        $supervisor = Auth::user();
        
        // Fetch groups assigned to the supervisor with their project reports
        $groups = Group::where('supervisor_id', $supervisor->id)
            ->whereNotNull('supervisor_id')
            ->with('reports') // This ensures the reports are eager-loaded
            ->get();

        if ($groups->isEmpty()) {
            return view('Supervisorfiles.projectreport.index', ['message' => 'No reports available for your groups.']);
        }

        // Pass the reports from each group to the view
        $reports = $groups->flatMap(function ($group) {
            return $group->reports;
        });

        return view('Supervisorfiles.projectreport.index', compact('reports'));
    }

    /**
     * Show a specific project report.
     */
    public function show($id)
    {
        $supervisor = Auth::user();
        
        $report = Report::with(['group', 'comments'])->whereHas('group', function ($query) use ($supervisor) {
            $query->where('supervisor_id', $supervisor->id);
        })->findOrFail($id);

        return view('Supervisorfiles.projectreport.show', compact('report'));
    }

    /**
     * Download the project report PDF.
     */
   public function download($id)
{
    $supervisor = Auth::user();
    
    // Ensure the report belongs to a group assigned to the supervisor
    $report = Report::whereHas('group', function ($query) use ($supervisor) {
        $query->where('supervisor_id', $supervisor->id);
    })->findOrFail($id);

    // Correct file path using public_path
    $filePath = public_path($report->pdf_file);

    // Check if the file exists in the public directory
    if (!file_exists($filePath)) {
        return redirect()->back()->with('error', 'File not found.');
    }

    // Return the download response
    return response()->download($filePath);
}


    /**
     * Upload a new version of the project report PDF.
     */
    public function upload(Request $request, $id)
    {
        $supervisor = Auth::user();
        $report = Report::whereHas('group', function ($query) use ($supervisor) {
            $query->where('supervisor_id', $supervisor->id);
        })->findOrFail($id);

        $request->validate([
            'pdf' => 'required|mimes:pdf|max:20480',
        ]);

        $uploadDir = public_path('assets/projectreport/samples/');
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Store sample report
        $file = $request->file('pdf');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = 'assets/projectreport/samples/' . $fileName;
        $file->move($uploadDir, $fileName);

        return redirect()->back()->with('success', 'Sample report uploaded successfully.');
    }

    /**
     * Review and comment on a project report.
     */
    public function review(Request $request, $id)
{
    $supervisor = auth()->user();
    $report = Report::whereHas('group', function ($query) use ($supervisor) {
        $query->where('supervisor_id', $supervisor->id);
    })->findOrFail($id);

    $request->validate([
        'status' => 'required|in:Draft,Ready for Submission', 
        'supervisor_comments' => 'required|string',
    ]);

    // Store the supervisor's comment
    $comment = ReportComment::create([
        'report_id' => $report->id,
        'supervisor_id' => $supervisor->id,
        'comment' => $request->supervisor_comments,
    ]);

    // Update the report status
    $report->update(['status' => $request->status]);

    // Check if the report's concept is accepted
    if ($report->concept->status === 'Ready for Submission') {
        // Find the latest report submitted by students in the same group
        $nextReport = Report::where('group_id', $report->group_id)
            ->where('id', '>', $report->id) // Ensure it's the next report
            ->orderBy('id', 'asc')
            ->first();

        // Update the next report's status to "Submitted"
        if ($nextReport) {
            $nextReport->update(['status' => 'Submitted']);
        }
    }

    // Notify all students in the group via email
    $students = $report->group->students;
    foreach ($students as $student) {
        Mail::to($student->email)->send(new SupervisorCommentNotification($report, $comment));
    }

    return redirect()->route('supervisor.reports.index')->with('success', 'Project reviewed and students notified.');
}

}

<!DOCTYPE html>
<html>
<head>
    <title>New Report Submitted</title>
</head>
<body>
    <p>Hello {{ $supervisorName }},</p>

    <p>A new report has been submitted by a student in your assigned group.</p>

    <p><strong>Report Title:</strong> {{ $report->title }}</p>
    <p><strong>Concept Title:</strong> {{ $report->concept->title }}</p>

    <p>You can review the report by clicking the button below:</p>

    <p><a href="{{ route('supervisor.reports.show', $report->id) }}" style="padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">View Report</a></p>

    <p>Thank you for your attention.</p>

    <p>Best Regards,</p>
    <p>IR Repository</p>
</body>
</html>

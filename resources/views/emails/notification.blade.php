<!DOCTYPE html>
<html>
<head>
    <title>Project Report Notification</title>
</head>
<body>
    <h1>{{ $report->title }}</h1>
    <p>{{ $report->review_comments ?? 'Your report has been reviewed.' }}</p>
    <p>Status: {{ $report->status }}</p>
</body>
</html>

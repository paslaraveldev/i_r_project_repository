<!DOCTYPE html>
<html>
<head>
    <title>Supervisor Comment Notification</title>
</head>
<body>
    <p>Dear Student,</p>
    <p>Your group’s research report titled <strong>{{ $report->title }}</strong> has received a new comment from your supervisor.</p>
    
    <p><strong>Comment:</strong> {{ $comment->comment }}</p>
    
    <p>Submitted on: {{ $comment->created_at->format('d M Y, H:i') }}</p>
    
    <p>You can view the full report <a href="{{ route('studentreports.index') }}">here</a>.</p>

    <p>Regards,<br>IR Repository</p>
</body>
</html>

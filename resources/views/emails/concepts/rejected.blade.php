<!DOCTYPE html>
<html>
<head>
    <title>Concepts Rejected</title>
</head>
<body>
    <p>Dear {{ $studentName }},</p>

    <p>We regret to inform you that all concepts submitted by your group, <strong>{{ $groupName }}</strong>, have been rejected. Below are the reasons provided by your supervisor, <strong>{{ $supervisorName }}</strong>:</p>

    <ul>
        @foreach ($rejectionReasons as $reason)
            <li>{{ $reason }}</li>
        @endforeach
    </ul>

    <p>Please consult your supervisor for further clarification and guidance.</p>

    <p>Best regards,</p>
    <p>The IR Repository Team</p>
</body>
</html>

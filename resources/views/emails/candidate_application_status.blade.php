<!DOCTYPE html>
<html>
<head>
    <title>Application Status Update</title>
</head>
<body>
    <p>Dear {{ $data['full_name'] }},</p>

    <p>Thank you for applying to join {{ config('app.name') }}. We appreciate the time and effort you put into your application.</p>

    <p><strong>Application Details:</strong></p>
    <ul>
        <li><strong>Position:</strong> {{ $data['job_title'] }}</li>
        <li><strong>Status Update:</strong><br>{{ $data['application_status'] }}</li>
    </ul>

    <p>We will continue to keep you informed about any further developments related to your application.</p>

    <p>If you have any questions in the meantime, feel free to reach out to us.</p>

    <p>Best regards,<br>
    The {{ config('app.name') }} Recruitment Team</p>
</body>
</html>

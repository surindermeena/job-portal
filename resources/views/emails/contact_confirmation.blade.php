<!DOCTYPE html>
<html>
<head>
    <title>Contact Confirmation</title>
</head>
<body>
    <p>Dear {{ $data['full_name'] }},</p>

    <p>Thank you for reaching out to us. We've received your message and will get back to you shortly.</p>

    <p><strong>Your message summary:</strong></p>

    <ul>
        <li><strong>Name:</strong> {{ $data['full_name'] }}</li>
        <li><strong>Email:</strong> {{ $data['email'] }}</li>
        <li><strong>Subject:</strong> {{ $data['subject'] }}</li>
        <li><strong>Message:</strong><br>{{ $data['message'] }}</li>
    </ul>

    <p>We appreciate your interest and will respond as soon as possible.</p>

    <p>Best regards,<br>
    The {{ config('app.name') }} Team</p>
</body>
</html>

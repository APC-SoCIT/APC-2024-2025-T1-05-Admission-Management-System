<!DOCTYPE html>
<html>

<head>
    <title>Application Accepted</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
        }

        .footer {
            margin-top: 20px;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ddd;
        }

        h1 {
            color: #0369d3
        }

        h3 {
            color: #0369d3
        }

        p {
            color: black
        }
    </style>
</head>

<body>
    <h3>Dear {{ $applicant->applicant_given_name }} {{ $applicant->applicant_middle_name }}
        {{ $applicant->applicant_surname }} {{ $applicant->applicant_extension }},</h3>

    <p>We regret to inform you that your application has not been accepted.</p>

    <p><strong>Reason for Rejection:</strong> <strong>{{ $applicant->rejection_reason }}</strong></p>

    <p>We appreciate your interest in our institution and encourage you to apply again in the future.</p>
    <p>If you have any questions or need assistance, feel free to contact our support team.</p>
    <p>Best regards,<br>
        Team Innolab</p>

</body>
<div class="footer">
    Copyright © 2025. All Rights Reserved. Developed by Innolab.
</div>

</html>
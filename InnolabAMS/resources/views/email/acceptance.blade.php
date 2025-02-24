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
    <h1>Congratulations, {{ $applicant->applicant_given_name }} {{ $applicant->applicant_middle_name }}
        {{ $applicant->applicant_surname }} {{ $applicant->applicant_extension }}!</h1>
    <p>We are pleased to inform you that your application has been accepted.</p>
    <p>Thank you for choosing our institution. We look forward to seeing you soon.</p>
    <p>Best regards,</p>
    <p>If you have any questions or need assistance, feel free to contact our support team.</p>
    <p>Best regards,<br>
            Team Innolab</p>
</body>
<div class="footer">
    Copyright © 2025. All Rights Reserved. Developed by Innolab.
</div>

</html>
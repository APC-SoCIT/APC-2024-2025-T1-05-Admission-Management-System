<!DOCTYPE html>
<html>

<head>
    <title>Welcome Email</title>
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
            color:#0369d3
        }

        h3 {
            color:#0369d3
        }

        p {
            color:black
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome, {{ $user->name }}!</h1>
        <h3>Thank you for registering with us.</h3>
        <p>We are excited to have you on board. Please complete your application to our student portal by following
            these steps:</p>

        <ol>
            <li>Log in to your account using your registered email and password.</li>
            <li>Navigate to the items in the applicant panel to start your application proccess.</li>
            <li>Fill out all required details and upload any necessary documents.</li>
            <li>Review your application and click "Submit".</li>
        </ol>

        <p>If you have any questions or need assistance, feel free to contact our support team.</p>

        <p>Best regards,<br>
            Team Innolab</p>
    </div>

    <div class="footer">
        Copyright © 2025. All Rights Reserved. Developed by Innolab.
    </div>
</body>

</html>
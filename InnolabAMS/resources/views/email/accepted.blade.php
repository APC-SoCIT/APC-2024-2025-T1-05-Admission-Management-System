<!DOCTYPE html>
<html>

<head>
    <title>Accepted Email</title>
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
    <div class="container">
        <h1>Congratulations, {{ $user->name }}!</h1>
        <h3>You’ve been officially accepted!</h3>
        <p>We are thrilled to welcome you to our academic community. Your journey towards excellence begins now, and we
            can't wait to see all that you will achieve.</p>

        <p>If you have any questions or need assistance, our support team is here to help.</p>

        <p>Once again, congratulations and welcome aboard!</p>

        <p>Best regards,<br>
            Team Innolab</p>
    </div>

    <div class="footer">
        Copyright © 2025. All Rights Reserved. Developed by Innolab.
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Form</title>
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> Link to Tailwind or custom styles -->

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .header {
            display: flex;
            align-items: center;
            background-color: #007bff;
            padding: 20px;
            color: #fff;
        }

        .header img {
            width: 50px;
            height: 50px;
            margin-right: 20px;
            border-radius: 50%;
        }

        .header-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .header-content h1 {
            margin: 0;
            font-size: 24px;
        }

        .header-content p {
            margin: 5px 0 0;
            font-size: 14px;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: none;
        }

        .form-group small {
            color: #e74c3c;
            font-size: 0.9em;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <!-- Content -->
        <div>
            @yield('content')
        </div>
    </div>
</body>
</html>

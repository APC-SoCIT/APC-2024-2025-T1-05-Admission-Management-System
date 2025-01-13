<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Form</title>
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

<body>
    <!-- School Header -->
    <div class="header">
        <img src="#" alt="School Logo">
        <div class="header-content">
            <h1>School Name</h1>
            <p>School description</p>
        </div>
    </div>

    <!-- Inquiry Form -->
    <div class="container">
        <h1>Inquiry Form</h1>
        @csrf
        <!-- Flash Messages -->
        @if(session('success'))
            <div
                style="color: green; background-color: #d4edda; padding: 10px; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div
                style="color: red; background-color: #f8d7da; padding: 10px; border: 1px solid #f5c6cb; border-radius: 5px; margin-bottom: 15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('lead_info.store') }}" method="POST">
            <!-- First Name -->
            <div class="form-group">
                <label for="lead_given_name">First Name</label>
                <input type="text" id="lead_given_name" name="lead_given_name" required>
            </div>

            <!-- Last Name -->
            <div class="form-group">
                <label for="lead_surname">Last Name</label>
                <input type="text" id="lead_surname" name="lead_surname" required>
            </div>

            <!-- Middle Name -->
            <div class="form-group">
                <label for="lead_middle_name">Middle Name</label>
                <input type="text" id="lead_middle_name" name="lead_middle_name">
            </div>

            <!-- Extension -->
            <div class="form-group">
                <label for="lead_extension">Ext.</label>
                <input type="text" id="lead_extension" name="lead_extension">
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="lead_email">Email</label>
                <input type="email" id="lead_email" name="lead_email" required>
            </div>

            <!-- Contact Number -->
            <div class="form-group">
                <label for="lead_mobile_number">Mobile Number</label>
                <input type="text" id="lead_mobile_number" name="lead_mobile_number" maxlength="13" required>
            </div>

            <!-- City -->
            <div class="form-group">
                <label for="lead_address_city">City</label>
                <input type="text" id="lead_address_city" name="lead_address_city">
            </div>

            <!-- Inquiry Details -->
            <div class="form-group">
                <label for="inquired_details">What details would you like to know?</label>
                <select id="inquired_details" name="inquired_details" required>
                    <option value="Option1">Option 1</option>
                    <option value="Option2">Option 2</option>
                    <option value="Option3">Option 3</option>
                </select>
            </div>

            <!-- Message -->
            <div class="form-group">
                <label for="lead_message">Message</label>
                <textarea id="lead_message" name="lead_message"></textarea>
            </div>

            <!-- How Did You Learn About Us -->
            <div class="form-group">
                <label>How did you learn about us?</label><br>
                <input type="checkbox" id="source_social_media" name="source[]" value="Social Media">
                <label for="source_social_media">Social Media</label><br>
                <input type="checkbox" id="source_website" name="source[]" value="Website">
                <label for="source_website">Website</label><br>
                <input type="checkbox" id="source_referral" name="source[]" value="Referral">
                <label for="source_referral">Referral</label><br>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>
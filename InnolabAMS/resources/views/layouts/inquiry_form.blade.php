<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'InnolabAMS') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('/static/images/innolab_favicon.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<style>
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



    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    input[type="checkbox"] {
        margin: 0;
        width: 16px;
        height: 16px;
    }

    /* Data Privacy Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        width: 80%;
        max-width: 900px;
        height: auto;
        max-height: 90vh;
        overflow-y: auto;
        padding: 20px;
    }

    .modal-content div {
        text-align: left !important;
        line-height: 1.8; 
        padding: 25px;

    }

    .modal button {
        background-color: red;
        color: white;
        margin-top: 10px;
        width: auto;
    }

    .required {
        color: red;
        font-weight: bold;
    }

</style>
</head>

<body class="bg-gray-100">

    <div class="flex justify-center mt-10">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>
    </div>
    <div>
        <!-- Content -->
        <div>
            @yield('content')
        </div>
    </div>

    <!-- Data Privacy Modal -->
    <div id="privacyModal" class="modal">
        <div class="modal-content">
            <div class="prose max-w-none">
                {!! Str::markdown(file_get_contents(resource_path('markdown/policy.md'))) !!}
            </div>
            <div class="flex justify-end mt-4">
                <x-danger-button onclick="closePrivacyPolicy()">
                    Close
                </x-danger-button>
            </div>
        </div>
        </>
    </div>

</body>

<script>
        function openPrivacyPolicy() {
            document.getElementById('privacyModal').style.display = 'flex';
        }

        function closePrivacyPolicy() {
            document.getElementById('privacyModal').style.display = 'none';
        }
    </script>
</html>
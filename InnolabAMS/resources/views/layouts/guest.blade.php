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

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    h1 {
        text-align: center;
        color: #333;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
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
        text-align: left;
        line-height: 1.8;
        padding: 25px;
    }
</style>


<body class="font-sans antialiased bg-gray-100 text-black"
    x-data="{ showAuthLinks: false, activeButton: '', buttonsVisible: true }">
    <div class="relative w-full">
        <!-- Heading Section with Flexbox for Logo and Text -->
        <div class="flex items-center mt-10 ml-20">
            <!-- Logo -->
            <img src="{{ asset('/static/images/innolab_logo3.png') }}" alt="Logo" class="w-20 h-20 rounded-full mr-2">

            <!-- Text Next to Logo -->
            <div>
                <h2 class="text-2xl font-bold mb-1">InnolabAMS</h2>
                <h3 class="text-lg">Your innovation solution partner.</h3>
            </div>
        </div>
    </div>

    <div class="max-h-screen flex flex-col justify-center items-center mt-10 py-10 bg-gray-100">


        <div class="w-full sm:max-w-md mt-4 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>

        <!-- Inquire Now Link -->
        <div class="mt-4 text-center">
            <span class="text-sm text-black">Have a question? </span>
            <a href="{{ route('lead_info.create') }}"
                class="underline text-sm text-black hover:text-indigo-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Inquire Now') }}
            </a>
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

<!-- Footer -->
<footer class="w-full text-center text-sm py-10  text-gray-500 mt-4">
    <p>Copyright © 2025. All Rights Reserved. Developed by Team Innolab</p>
</footer>

</html>

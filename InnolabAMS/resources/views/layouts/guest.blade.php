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

        <style>
            .bg-school {
                background-image: url("{{ asset('static/images/school-background-srccmsths.jpg') }}");
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
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
    </head>

    <body class="font-sans antialiased bg-gray-100 text-black"
        x-data="{ showAuthLinks: false, activeButton: '', buttonsVisible: true }">
        <div class="min-h-screen flex flex-col bg-school">
            <!-- Header Section -->
            <div class="relative w-full bg-white/80 backdrop-blur-sm">
                <!-- Heading Section with Flexbox for Logo and Text -->
                <div class="flex items-center py-6 ml-20">
                    <!-- Logo -->
                    <img src="{{ asset('/static/images/innolab_logo3.png') }}"
                         alt="Logo"
                         class="w-20 h-20 rounded-full mr-2">

                    <!-- Text Next to Logo -->
                    <div>
                        <h2 class="text-2xl font-bold mb-1">InnolabAMS</h2>
                        <h3 class="text-lg">Your innovation solution partner.</h3>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col items-center justify-center">
                <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    {{ $slot }}

                    <!-- Inquire Now Section -->
                    <div class="mt-4 text-center">
                        <span class="text-sm text-gray-600">Have a question? </span>
                        <a href="{{ route('lead_info.create') }}"
                            class="underline text-sm text-gray-600 hover:text-indigo-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Inquire Now') }}
                        </a>
                    </div>
                </div>
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
        </div>

        <script>
            function openPrivacyPolicy() {
                document.getElementById('privacyModal').style.display = 'flex';
            }

            function closePrivacyPolicy() {
                document.getElementById('privacyModal').style.display = 'none';
            }
        </script>

        <!-- Footer -->
        <footer class="w-full text-center text-sm py-10 text-gray-500 mt-4">
            <p>Copyright © 2025. All Rights Reserved. Developed by Team Innolab</p>
        </footer>
    </body>
</html>

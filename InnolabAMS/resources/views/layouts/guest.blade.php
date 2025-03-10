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

        .modal-content div h1 {
            text-align: center;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.6) !important;
            position: relative;
            z-index: 10;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100 text-black"
    x-data="{
        userType: '{{ request()->is('register') ? 'apply' : null }}',
        showHelp: false
    }">
    <div class="min-h-screen flex flex-col bg-school">
        <!-- Welcome Header -->
        <div class="flex items-center p-4 ml-4">
            <img src="{{ asset('/static/images/innolab_logo4.png') }}" alt="Logo" class="w-16 h-16">
            <div class="ml-4">
                <h1 class="text-2xl font-bold text-white">Welcome to InnolabAMS</h1>
                <p class="text-white/90">Your innovation solution partner.</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col items-center justify-center p-4 pb-32">
            <!-- User Type Selection -->
            <div x-show="!userType" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100" class="w-full max-w-md mb-6">
                <div class="flex justify-center space-x-4">
                    <button @click="userType = 'apply'"
                        class="flex flex-col items-center p-6 bg-white rounded-lg shadow-lg hover:bg-blue-50 transition-all w-48">
                        <i class="fas fa-file-alt text-4xl mb-3 text-blue-600"></i>
                        <span class="font-medium text-lg">Apply Now</span>
                        <span class="text-sm text-gray-500">Start your admission process</span>
                    </button>

                    <a href="{{ route('lead_info.create') }}"
                        class="flex flex-col items-center p-6 bg-white rounded-lg shadow-lg hover:bg-blue-50 transition-all w-48">
                        <i class="fas fa-info-circle text-4xl mb-3 text-blue-600"></i>
                        <span class="font-medium text-lg">Inquire</span>
                        <span class="text-sm text-center text-gray-500">Learn more about admission</span>
                    </a>
                </div>
            </div>

            <!-- Login/Register Form Container -->
            <div x-show="userType === 'apply'" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100" class="w-full sm:max-w-md">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <!-- Back Button -->
                    <div class="p-4 border-b">
                        <button @click="userType = null"
                            class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i>
                            <span>Back to options</span>
                        </button>
                    </div>

                    <div class="p-6">
                        <!-- Help Icon -->
                        <button @click="showHelp = !showHelp"
                            class="absolute top-4 right-4 text-gray-400 hover:text-blue-500">
                            <i class="fas fa-question-circle text-xl"></i>
                        </button>

                        <!-- Help Panel -->
                        <div x-show="showHelp"
                            class="bg-blue-50 p-4 rounded-lg mb-6 text-sm border-l-4 border-blue-500">
                            <h3 class="font-semibold text-blue-800 mb-2">Need Help?</h3>
                            <ul class="list-disc list-inside space-y-2 text-gray-600">
                                <li>New applicant? Click "Register" below</li>
                                <li>Already applied? Sign in to check your status</li>
                                <li>Forgot password? Click "Forgot your password?" to reset</li>
                            </ul>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <a class="flex items-center text-sm text-gray-600 hover:text-blue-600 transition-colors duration-200"
                                href="{{ route('register') }}">
                                <i class="fas fa-user-plus mr-2"></i>
                                {{ __('Register') }}
                            </a>

                            <x-primary-button>
                                {{ __('Log in') }}
                            </x-primary-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Footer -->
        <footer class="bg-gray-900/70 backdrop-blur-md py-4">
            <div class="container mx-auto px-4 text-center">
                <p class="text-sm text-white font-medium">
                    Having technical issues? Contact our support team at
                    <a href="mailto:innolabdevelopers@gmail.com" class="text-white hover:text-blue-100 underline">
                        innolabdevelopers@gmail.com
                    </a>
                </p>
                <p class="text-sm text-white font-medium mt-2">
                    Copyright © 2025. All rights reserved.Developed by Innolab
                </p>
            </div>
        </footer>
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
</body>

</html>

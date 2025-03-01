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
        x-data="{ userType: null, showHelp: false }">
        <div class="min-h-screen flex flex-col bg-school">
            <!-- Welcome Header -->
            <div class="flex items-center p-4 ml-4">
                <img src="{{ asset('/static/images/innolab_logo3.png') }}" alt="Logo" class="w-16 h-16">
                <div class="ml-4">
                    <h1 class="text-2xl font-bold text-white">Welcome to InnolabAMS</h1>
                    <p class="text-white/90">Your innovation solution partner.</p>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col items-center justify-center p-4">
                <!-- User Type Selection -->
                <div class="w-full max-w-md mb-6">
                    <div class="flex justify-center space-x-4">
                        <button @click="userType = 'applicant'"
                                class="flex flex-col items-center p-6 bg-white rounded-lg shadow-lg hover:bg-blue-50 transition-all w-48"
                                :class="{ 'ring-2 ring-blue-500': userType === 'applicant' }">
                            <i class="fas fa-user-graduate text-4xl mb-3 text-blue-600"></i>
                            <span class="font-medium text-lg">Student/Applicant</span>
                            <span class="text-sm text-gray-500">Apply for admission</span>
                        </button>

                        <button @click="userType = 'admin'"
                                class="flex flex-col items-center p-6 bg-white rounded-lg shadow-lg hover:bg-blue-50 transition-all w-48"
                                :class="{ 'ring-2 ring-blue-500': userType === 'admin' }">
                            <i class="fas fa-user-shield text-4xl mb-3 text-blue-600"></i>
                            <span class="font-medium text-lg">Staff/Admin</span>
                            <span class="text-sm text-gray-500">Manage admissions</span>
                        </button>
                    </div>
                </div>

                <!-- Login Forms - Shown only when a user type is selected -->
                <div x-show="userType"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-90"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     class="w-full sm:max-w-md">
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="p-6">
                            <!-- Sign In Form -->
                            {{ $slot }}

                            <!-- Quick Links - Only shown for applicants -->
                            <template x-if="userType === 'applicant'">
                                <div class="mt-6 space-y-3">
                                    <a href="{{ route('register') }}" class="flex items-center text-blue-600 hover:text-blue-700">
                                        <i class="fas fa-user-plus mr-2"></i>
                                        <span>Want to apply? Create an Account</span>
                                    </a>
                                    <a href="{{ route('lead_info.create') }}" class="flex items-center text-blue-600 hover:text-blue-700">
                                        <i class="fas fa-question-circle mr-2"></i>
                                        <span>Need Help? Inquire Now</span>
                                    </a>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-white/90 backdrop-blur-sm py-4">
                <div class="container mx-auto px-4 text-center">
                    <p class="text-sm text-gray-600">Having technical issues? Contact our support team at innolabdevelopers@gmail.com</p>
                    <p class="text-sm text-gray-500 mt-2">© {{ date('Y') }} InnolabAMS. All rights reserved.</p>
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

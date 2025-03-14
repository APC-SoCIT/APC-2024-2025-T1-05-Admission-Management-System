<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SRCCMSTHS') }}</title>

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
            z-index: 50;
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

        /* Process Steps */
        .step-circle {
            width: 50px;
            height: 50px;
            background-color: #e6f0ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 1rem;
        }

        /* Feature Cards */
        .feature-card {
            background: #f8fafc;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 2rem;
            color: #2563eb;
            margin-bottom: 1rem;
        }

        .landing-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .auth-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 40;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100 text-black" x-data="{
    userType: window.location.pathname.includes('/register') ||
              window.location.pathname.includes('/login') ||
              window.location.pathname.includes('/forgot-password') ||
              window.location.pathname.includes('/reset-password') ? 'apply' : null,
    showHelp: false,
    showAuthModal: window.location.pathname.includes('/register') ||
                   window.location.pathname.includes('/login') ||
                   window.location.pathname.includes('/forgot-password') ||
                   window.location.pathname.includes('/reset-password')
}">
    <!-- Split the UI flow based on whether we're on an auth page or not -->
    <template x-if="showAuthModal">
        <!-- Auth Modal Container -->
        <div class="auth-container">
            <div class="w-full sm:max-w-md">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <!-- Back Button -->
                    <div class="p-4 border-b">
                        <button @click="window.location.pathname.includes('/forgot-password') ? window.location.href = '/login' : window.location.href = '/'"
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

                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </template>

    <template x-if="!showAuthModal">
        <!-- Main Landing Page -->
        <div class="min-h-screen flex flex-col">
            <!-- Navigation Bar -->
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 flex items-center">
                                <img src="{{ asset('/static/images/srccmsths-logo.png') }}" alt="Logo" class="w-10 h-10">
                                <span class="ml-2 text-xl font-bold text-blue-600">SRCCMSTHS</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Sign In</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Register</a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Hero Section -->
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-16">
                <div class="landing-container">
                    <div class="max-w-3xl">
                        <h1 class="text-4xl font-bold mb-4">SRCCMSTHS Online Admissions</h1>
                        <p class="text-xl mb-8">Senator Renato "Compañero" Cayetano Memorial Science and Technology High School welcomes applicants for the upcoming school year. Apply online through our streamlined admissions process.</p>
                        <div class="flex space-x-4">
                            <a href="{{ route('register') }}" class="bg-transparent border border-white text-white hover:bg-white hover:text-blue-600 px-6 py-3 rounded-md font-medium flex items-center">
                                <i class="fas fa-info-circle mr-2"></i> Apply Now
                            </a>
                            <a href="{{ route('lead_info.create') }}" class="bg-transparent border border-white text-white hover:bg-white hover:text-blue-600 px-6 py-3 rounded-md font-medium flex items-center">
                                <i class="fas fa-info-circle mr-2"></i> Send Inquiry
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admissions Process Section -->
            <div class="py-16 bg-white">
                <div class="landing-container">
                    <h2 class="text-3xl font-bold text-center mb-6">Admissions Process</h2>
                    <p class="text-center text-gray-600 mb-12">Follow these steps to apply to SRCCMSTHS</p>

                    <div class="grid md:grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Step 1 -->
                        <div class="feature-card">
                            <div class="step-circle">1</div>
                            <h3 class="text-xl font-semibold mb-2">Create an Account</h3>
                            <p class="text-gray-600">Register in our admissions portal to start your application</p>
                        </div>

                        <!-- Step 2 -->
                        <div class="feature-card">
                            <div class="step-circle">2</div>
                            <h3 class="text-xl font-semibold mb-2">Complete Application</h3>
                            <p class="text-gray-600">Fill out all required information and upload necessary documents</p>
                        </div>

                        <!-- Step 3 -->
                        <div class="feature-card">
                            <div class="step-circle">3</div>
                            <h3 class="text-xl font-semibold mb-2">Track Application</h3>
                            <p class="text-gray-600">Monitor your application status and respond to any requests</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Why Apply Section -->
            <div class="py-16 bg-gray-50">
                <div class="landing-container">
                    <h2 class="text-3xl font-bold text-center mb-12">Why Apply to SRCCMSTHS?</h2>
                    <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-8">
                        <!-- Feature 1 -->
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Academic Excellence</h3>
                            <p class="text-gray-600">Recognized as a Best Performing School in DepEd TAPAT Secondary Level</p>
                        </div>

                        <!-- Feature 2 -->
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-award"></i>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Award-Winning Programs</h3>
                            <p class="text-gray-600">Multiple awards for Brigada Eskwela and other educational initiatives</p>
                        </div>

                        <!-- Feature 3 -->
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Efficient Process</h3>
                            <p class="text-gray-600">Our online system streamlines the entire application experience</p>
                        </div>

                        <!-- Feature 4 -->
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Paperless Submissions</h3>
                            <p class="text-gray-600">Upload all your documents digitally, no need for physical copies</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-gray-900 text-white py-8 mt-auto">
                <div class="landing-container">
                    <!-- Logo and School Name -->
                    <div class="flex justify-center items-center mb-6">
                        <img src="{{ asset('/static/images/srccmsths-logo.png') }}" alt="Logo" class="w-12 h-12">
                        <div class="ml-3">
                            <span class="text-xl font-bold">SRCCMSTHS</span>
                        </div>
                    </div>

                    <!-- Support Contact -->
                    <div class="text-center mb-6">
                        <p class="text-sm">
                            Having technical issues? Contact our support team at
                            <a href="mailto:innolabdevelopers@gmail.com" class="text-blue-300 hover:text-blue-100 underline">
                                innolabdevelopers@gmail.com
                            </a>
                        </p>
                    </div>

                    <div class="border-t border-gray-800 pt-6 text-center">
                        <p class="text-sm">Copyright © 2025. All rights reserved. Developed by
                            <a href="#" onclick="openAboutModal()" class="text-blue-300 hover:text-blue-100 underline">Innolab</a>
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </template>

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

    <!-- About Us Modal -->
    <div id="aboutModal" class="modal">
        <div class="modal-content">
            <div class="prose max-w-none">
                <h2 class="text-2xl font-bold text-center mb-6">About Innolab Developers</h2>
                <p class="text-center mb-8">Meet the team behind the SRCCMSTHS Admissions Management System</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    <!-- Developer 1 -->
                    <div class="text-center">
                        <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4">
                            <img src="{{ asset('/static/images/dev1.jpg') }}" alt="Developer 1" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-bold text-lg">John Doe</h3>
                        <p class="text-gray-600">Lead Developer</p>
                    </div>

                    <!-- Developer 2 -->
                    <div class="text-center">
                        <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4">
                            <img src="{{ asset('/static/images/dev2.jpg') }}" alt="Developer 2" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-bold text-lg">Jane Smith</h3>
                        <p class="text-gray-600">UI/UX Designer</p>
                    </div>

                    <!-- Developer 3 -->
                    <div class="text-center">
                        <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4">
                            <img src="{{ asset('/static/images/dev3.jpg') }}" alt="Developer 3" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-bold text-lg">Mike Johnson</h3>
                        <p class="text-gray-600">Backend Developer</p>
                    </div>
                </div>

                <div class="flex justify-center mb-8">
                    <!-- Developer 4 -->
                    <div class="text-center" style="max-width: 200px;">
                        <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4">
                            <img src="{{ asset('/static/images/dev4.jpg') }}" alt="Developer 4" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-bold text-lg">John Doe</h3>
                        <p class="text-gray-600">Backend Developer</p>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <p>Founded in 2024, Innolab is a team of 4 passionate developers committed to creating innovative solutions for educational institutions. Our mission is to streamline administrative processes and enhance the student experience through technology.</p>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <x-danger-button onclick="closeAboutModal()">
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

        function openAboutModal() {
            document.getElementById('aboutModal').style.display = 'flex';
        }

        function closeAboutModal() {
            document.getElementById('aboutModal').style.display = 'none';
        }
    </script>
</body>

</html>

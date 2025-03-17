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
            background-image: url("{{ asset('static/images/srccmsths-bg-1.jpg') }}");
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
            background-image: url("{{ asset('static/images/srccmsths-bg-1.jpg') }}") !important;
            background-size: cover !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
        }
    </style>
</head>

<body class="font-sans antialiased text-black" x-data="{
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
    <template x-if="showAuthModal">
        <div class="auth-container bg-school bg-cover bg-center">
            <div class="w-full sm:max-w-md px-4">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <!-- Back Button -->
                    <div class="p-4 border-b">
                        <button @click="window.location.pathname.includes('/forgot-password') ? window.location.href = '/login' : window.location.href = '/'"
                            class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i>
                            <span>Back</span>
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
            <!-- Main Navigation Bar -->
            <header class="bg-blue-700 text-white shadow">
                <div class="max-w-7xl mx-auto">
                    <!-- Logo and School Name -->
                    <div class="flex justify-between items-center py-3 px-4">
                        <div class="flex items-center">
                            <a href="/" class="flex items-center">
                                <img src="{{ asset('/static/images/srccmsths-logo.png') }}" alt="SRCCMSTHS Logo" class="h-12 w-12">
                                <span class="ml-2 text-xl font-bold">SRCCMSTHS</span>
                            </a>
                        </div>

                        <!-- Mobile menu button -->
                        <div class="lg:hidden">
                            <button type="button" class="text-white hover:text-gray-200"
                                    x-data="{}" @click="$dispatch('toggle-mobile-menu')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Desktop Navigation Menu - Always Visible -->
                    <nav class="hidden lg:block border-t border-blue-600">
                        <div class="flex justify-between items-center py-2 px-4">
                            <div class="flex space-x-1">
                                <a href="/" class="px-3 py-2 text-white hover:bg-blue-600 transition-colors rounded">Home</a>

                                <!-- Our School Dropdown -->
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" @click.away="open = false"
                                            class="px-3 py-2 text-white hover:bg-blue-600 transition-colors rounded flex items-center">
                                        Our School
                                        <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <div x-show="open" class="absolute z-10 mt-2 w-48 bg-white text-gray-700 rounded-md shadow-lg py-1">
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">About Us</a>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">History</a>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Vision & Mission</a>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Administration</a>
                                    </div>
                                </div>

                                <!-- Admissions Dropdown -->
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" @click.away="open = false"
                                            class="px-3 py-2 text-white hover:bg-blue-600 transition-colors rounded flex items-center">
                                        Admissions
                                        <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <div x-show="open" class="absolute z-10 mt-2 w-48 bg-white text-gray-700 rounded-md shadow-lg py-1">
                                        <a href="{{ route('register') }}" class="block px-4 py-2 hover:bg-gray-100">Apply Now</a>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Requirements</a>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Process</a>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">FAQs</a>
                                    </div>
                                </div>

                                <a href="#" class="px-3 py-2 text-white hover:bg-blue-600 transition-colors rounded">News</a>
                                <a href="#" class="px-3 py-2 text-white hover:bg-blue-600 transition-colors rounded">Facilities</a>
                                <a href="#" class="px-3 py-2 text-white hover:bg-blue-600 transition-colors rounded">Clubs</a>
                                <a href="#" class="px-3 py-2 text-white hover:bg-blue-600 transition-colors rounded">Faculty and Admin</a>
                                <a href="{{ route('lead_info.create') }}" class="px-3 py-2 text-white hover:bg-blue-600 transition-colors rounded">Inquiry</a>
                            </div>

                            <!-- Sign In Button -->
                            <a href="{{ route('login') }}" class="px-4 py-2 bg-white text-blue-700 rounded hover:bg-gray-100 transition-colors">
                                Sign In
                            </a>
                        </div>
                    </nav>
                </div>

                <!-- Mobile Navigation Menu - Hidden by Default -->
                <div class="lg:hidden" x-data="{ open: false }" @toggle-mobile-menu.window="open = !open" x-show="open" style="display: none;">
                    <nav class="bg-blue-800 py-2 px-4 space-y-1">
                        <a href="/" class="block px-3 py-2 text-white hover:bg-blue-600 rounded">Home</a>

                        <!-- Mobile Our School Menu -->
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="w-full text-left px-3 py-2 text-white hover:bg-blue-600 rounded flex justify-between items-center">
                                Our School
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" class="pl-4 space-y-1">
                                <a href="#" class="block px-3 py-2 text-white hover:bg-blue-600 rounded">About Us</a>
                                <a href="#" class="block px-3 py-2 text-white hover:bg-blue-600 rounded">History</a>
                                <a href="#" class="block px-3 py-2 text-white hover:bg-blue-600 rounded">Vision & Mission</a>
                                <a href="#" class="block px-3 py-2 text-white hover:bg-blue-600 rounded">Administration</a>
                            </div>
                        </div>

                        <!-- Mobile Admissions Menu -->
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="w-full text-left px-3 py-2 text-white hover:bg-blue-600 rounded flex justify-between items-center">
                                Admissions
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" class="pl-4 space-y-1">
                                <a href="{{ route('register') }}" class="block px-3 py-2 text-white hover:bg-blue-600 rounded">Apply Now</a>
                                <a href="#" class="block px-3 py-2 text-white hover:bg-blue-600 rounded">Requirements</a>
                                <a href="#" class="block px-3 py-2 text-white hover:bg-blue-600 rounded">Process</a>
                                <a href="#" class="block px-3 py-2 text-white hover:bg-blue-600 rounded">FAQs</a>
                            </div>
                        </div>

                        <a href="#" class="block px-3 py-2 text-white hover:bg-blue-600 rounded">News</a>
                        <a href="#" class="block px-3 py-2 text-white hover:bg-blue-600 rounded">Facilities</a>
                        <a href="#" class="block px-3 py-2 text-white hover:bg-blue-600 rounded">Clubs</a>
                        <a href="#" class="block px-3 py-2 text-white hover:bg-blue-600 rounded">Faculty and Admin</a>
                        <a href="{{ route('lead_info.create') }}" class="block px-3 py-2 text-white hover:bg-blue-600 rounded">Inquiry</a>
                        <a href="{{ route('login') }}" class="block px-3 py-2 mt-2 bg-white text-blue-700 rounded hover:bg-gray-100">Sign In</a>
                    </nav>
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

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SRCCMSTHS Admission Portal') }}</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('/static/images/school-logo-srccmsths.png') }}" type="image/x-icon">

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

        .hero-section {
            background-image: url("{{ asset('/static/images/school-background-srccmsths.jpg') }}");
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(30, 64, 175, 0.7);
        }

        .achievement-card {
            border-left: 4px solid #1e40af;
            transition: transform 0.3s ease;
        }

        .achievement-card:hover {
            transform: translateY(-5px);
        }

        .step-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .step-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
    </style>

<body class="font-sans antialiased text-black" x-data="{ showLoginModal: false }">
    <!-- Header/Navigation -->
    <header class="bg-blue-800 shadow-md">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <!-- Logo and School Name -->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('/static/images/school-logo-srccmsths.png') }}" alt="SRCCMSTHS Logo" class="w-16 h-16 rounded-full">
                    <div class="hidden md:block">
                        <h1 class="text-white text-lg font-bold leading-tight">Senator Renato "Compañero" Cayetano</h1>
                        <h2 class="text-white text-sm leading-tight">Memorial Science and Technology High School</h2>
                    </div>
                    <div class="block md:hidden">
                        <h1 class="text-white text-lg font-bold">SRCCMSTHS</h1>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex items-center space-x-6">
                    <a href="#" class="text-white hover:text-blue-200 transition">Home</a>
                    <a href="#" class="text-white hover:text-blue-200 transition">Our School</a>
                    <a href="#" class="text-white hover:text-blue-200 transition font-semibold">Admissions</a>
                    <a href="#" class="text-white hover:text-blue-200 transition">News</a>
                    <button
                        @click="showLoginModal = true"
                        class="bg-white text-blue-700 hover:bg-blue-100 px-4 py-2 rounded-md font-semibold transition"
                    >
                        Portal Login
                    </button>
                </nav>

                <!-- Mobile menu button -->
                <button class="md:hidden text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-section text-white py-24 relative">
        <div class="container mx-auto px-4 relative z-10">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div class="space-y-6">
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                        Welcome to SRCCMSTHS Admission Portal
                    </h1>
                    <p class="text-xl md:text-2xl opacity-90">
                        "To the east over mountain high"
                    </p>
                    <p class="text-lg opacity-80">
                        Developing globally competitive students through excellence in science and technology education
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 pt-4">
                        <button
                            @click="showLoginModal = true"
                            class="bg-white text-blue-700 hover:bg-blue-50 px-6 py-3 rounded-md font-semibold text-lg transition"
                        >
                            Portal Login
                        </button>
                        <a href="{{ route('lead_info.create') }}"
                           class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-700 px-6 py-3 rounded-md font-semibold text-lg transition text-center">
                            Inquire Now
                        </a>
                    </div>
                </div>
                <div class="hidden md:flex justify-end">
                    <img
                        src="{{ asset('/static/images/school-logo-srccmsths.png') }}"
                        alt="SRCCMSTHS Logo"
                        class="max-h-72"
                    >
                </div>
            </div>
        </div>
    </section>

    <!-- Admission Process Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Admission Process</h2>

            <div class="grid md:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="step-card bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="bg-blue-100 text-blue-700 rounded-full w-12 h-12 flex items-center justify-center text-xl font-bold mx-auto mb-4">
                        1
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Create Account</h3>
                    <p class="text-gray-600">Register for a new account on the admission portal</p>
                </div>

                <!-- Step 2 -->
                <div class="step-card bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="bg-blue-100 text-blue-700 rounded-full w-12 h-12 flex items-center justify-center text-xl font-bold mx-auto mb-4">
                        2
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Complete Application</h3>
                    <p class="text-gray-600">Fill out the application form with required personal and academic information</p>
                </div>

                <!-- Step 3 -->
                <div class="step-card bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="bg-blue-100 text-blue-700 rounded-full w-12 h-12 flex items-center justify-center text-xl font-bold mx-auto mb-4">
                        3
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Submit Documents</h3>
                    <p class="text-gray-600">Upload required documents and submit your application for review</p>
                </div>

                <!-- Step 4 -->
                <div class="step-card bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="bg-blue-100 text-blue-700 rounded-full w-12 h-12 flex items-center justify-center text-xl font-bold mx-auto mb-4">
                        4
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Track Status</h3>
                    <p class="text-gray-600">Monitor your application status and receive updates in real time</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Achievements Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">School Achievements</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Achievement 1 -->
                <div class="achievement-card bg-blue-50 p-6 rounded-r-lg">
                    <h3 class="text-xl font-semibold mb-2 text-blue-700">Best Performing School</h3>
                    <p class="text-gray-700">
                        Recognized as the Best Performing School in DepEd TAPAT, Secondary Level alongside Taguig Science High School.
                    </p>
                </div>

                <!-- Achievement 2 -->
                <div class="achievement-card bg-blue-50 p-6 rounded-r-lg">
                    <h3 class="text-xl font-semibold mb-2 text-blue-700">Brigada Eskwela Champion</h3>
                    <p class="text-gray-700">
                        1st Place - Best Brigada Eskwela Implementer (Division Level) and multiple regional awards for excellence.
                    </p>
                </div>

                <!-- Achievement 3 -->
                <div class="achievement-card bg-blue-50 p-6 rounded-r-lg">
                    <h3 class="text-xl font-semibold mb-2 text-blue-700">Academic Excellence</h3>
                    <p class="text-gray-700">
                        Outstanding performance in national competitions in Mathematics, Science, Robotics, and Research.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-blue-700 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Ready to Apply?</h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto">
                Join our community of excellence in science and technology education. Start your application process today!
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="{{ route('register') }}"
                   class="bg-white text-blue-700 hover:bg-blue-50 px-8 py-4 rounded-md font-semibold text-lg transition text-center">
                    Start Application
                </a>
                <a href="{{ route('lead_info.create') }}"
                   class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-700 px-8 py-4 rounded-md font-semibold text-lg transition text-center">
                    Inquire Now
                </a>
            </div>
        </div>
    </section>

    <!-- Actual content slot for auth pages -->
    <div id="auth-content" class="max-h-screen flex flex-col justify-center items-center py-10 bg-gray-100" x-show="!showLoginModal" style="display: none;">
        <div class="w-full sm:max-w-md mt-4 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>

    <!-- Login Modal -->
    <div id="loginModal" class="modal" x-show="showLoginModal" style="display: flex;">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Sign In</h3>
                    <button @click="showLoginModal = false" class="text-gray-400 hover:text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="email" class="block text-gray-700 mb-2">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter your email"
                            required
                        />
                    </div>

                    <div>
                        <label for="password" class="block text-gray-700 mb-2">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter your password"
                            required
                        />
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input
                                type="checkbox"
                                id="remember_me"
                                name="remember"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            />
                            <label for="remember_me" class="ml-2 block text-gray-700">
                                Remember me
                            </label>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                            Forgot password?
                        </a>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-blue-700 text-white py-2 px-4 rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition"
                    >
                        Sign In
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        Don't have an account?{" "}
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800">
                            Register
                        </a>
                    </p>
                </div>

                <div class="mt-4 text-center">
                    <a href="{{ route('lead_info.create') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                        Have a question? Inquire Now
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Privacy Modal (preserved from original) -->
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

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-10">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <!-- School Info -->
                <div>
                    <h3 class="text-white text-lg font-semibold mb-4">SRCCMSTHS</h3>
                    <p class="mb-2">Senator Renato "Compañero" Cayetano Memorial Science and Technology High School</p>
                    <p>"To the east over mountain high."</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-white text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">Home</a></li>
                        <li><a href="#" class="hover:text-white transition">Admissions</a></li>
                        <li><a href="#" class="hover:text-white transition">News</a></li>
                        <li><a href="#" class="hover:text-white transition">Faculty</a></li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div>
                    <h3 class="text-white text-lg font-semibold mb-4">Connect With Us</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition"><i class="fab fa-facebook mr-2"></i>Facebook</a></li>
                        <li><a href="#" class="hover:text-white transition"><i class="fab fa-instagram mr-2"></i>Instagram</a></li>
                        <li><a href="#" class="hover:text-white transition"><i class="fab fa-twitter mr-2"></i>Twitter</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-white text-lg font-semibold mb-4">Contact Us</h3>
                    <p class="mb-2"><i class="fas fa-envelope mr-2"></i>Email: info@srccmsths.edu.ph</p>
                    <p class="mb-2"><i class="fas fa-phone mr-2"></i>Phone: (02) 8888-7777</p>
                    <p class="mb-2"><i class="fas fa-map-marker-alt mr-2"></i>Address: Fort Bonifacio, Taguig City</p>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p>&copy; 2025 SRCCMSTHS. All Rights Reserved. Powered by InnolabAMS.</p>
            </div>
        </div>
    </footer>

    <script>
        function openPrivacyPolicy() {
            document.getElementById('privacyModal').style.display = 'flex';
        }

        function closePrivacyPolicy() {
            document.getElementById('privacyModal').style.display = 'none';
        }

        // On page load, check if we should show regular auth content
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.pathname === '/login' ||
                window.location.pathname === '/register' ||
                window.location.pathname.includes('/password')) {
                document.getElementById('auth-content').style.display = 'flex';
            }
        });
    </script>
</body>
</html>

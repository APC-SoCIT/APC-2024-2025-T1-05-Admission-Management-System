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
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }

            .hero-section {
                background-image: url("{{ asset('/static/images/school-background-srccmsths.jpg') }}");
                background-size: cover;
                background-position: center;
                position: relative;
                min-height: 500px;
            }

            .hero-section::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, rgba(30, 64, 175, 0.85) 0%, rgba(30, 64, 175, 0.7) 100%);
            }

            .school-logo {
                width: 80px;
                height: 80px;
                object-fit: contain;
            }

            .header-logo {
                width: 50px;
                height: 50px;
                object-fit: contain;
            }

            .achievement-card {
                border-left: 4px solid #1e40af;
                transition: all 0.3s ease;
            }

            .achievement-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            }

            .step-card {
                transition: all 0.3s ease;
                border-bottom: 3px solid transparent;
            }

            .step-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
                border-bottom: 3px solid #1e40af;
            }

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
                border-radius: 8px;
                max-width: 500px;
                width: 90%;
                max-height: 90vh;
                overflow-y: auto;
            }

            .privacy-modal {
                max-width: 800px;
            }

            .animate-on-scroll {
                opacity: 0;
                transition: opacity 0.5s ease, transform 0.5s ease;
                transform: translateY(20px);
            }

            .animate-fade-in {
                opacity: 1;
                transform: translateY(0);
            }

            .footer-link {
                transition: all 0.2s ease;
            }

            .footer-link:hover i {
                transform: translateX(3px);
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50" x-data="{ showLoginModal: false }">
        <!-- Header -->
        <header class="bg-blue-700 shadow-md">
            <div class="container mx-auto px-4 py-3">
                <div class="flex items-center justify-between">
                    <!-- Logo and School Name -->
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('/static/images/school-logo-srccmsths.png') }}" alt="SRCCMSTHS Logo" class="header-logo rounded-full">
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
                        <a href="#" class="text-white hover:text-blue-200 transition">About</a>
                        <a href="#" class="text-white hover:text-blue-200 transition font-semibold">Admissions</a>
                        <a href="#" class="text-white hover:text-blue-200 transition">News</a>
                        <a href="#" class="text-white hover:text-blue-200 transition">Contact</a>
                        <button
                            @click="showLoginModal = true"
                            class="bg-white text-blue-700 hover:bg-blue-50 px-4 py-2 rounded-md font-medium transition"
                        >
                            <i class="fas fa-sign-in-alt mr-1"></i> Login
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
        <section class="hero-section">
            <div class="container mx-auto px-4 relative z-10 py-16 md:py-24">
                <div class="max-w-3xl">
                    <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-6">Welcome to SRCCMSTHS Admission Portal</h1>
                    <p class="text-xl text-white opacity-90 mb-8">"To the east over mountain high"</p>
                    <p class="text-lg text-white opacity-80 mb-8">Developing globally competitive students through excellence in science and technology education</p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <button
                            @click="showLoginModal = true"
                            class="bg-white text-blue-700 hover:bg-blue-50 px-6 py-3 rounded-lg font-medium text-lg transition shadow-lg"
                        >
                            <i class="fas fa-user mr-2"></i> Portal Login
                        </button>
                        <a
                            href="{{ route('register') }}"
                            class="bg-blue-600 border-2 border-white text-white hover:bg-blue-700 px-6 py-3 rounded-lg font-medium text-lg transition shadow-lg text-center"
                        >
                            <i class="fas fa-user-plus mr-2"></i> Register Now
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Admission Process Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-4 text-gray-800">Admission Process</h2>
                <p class="text-center text-gray-600 mb-12 max-w-3xl mx-auto">Follow these simple steps to complete your admission to SRCCMSTHS</p>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Step 1 -->
                    <div class="bg-white p-6 rounded-lg shadow-md text-center step-card animate-on-scroll">
                        <div class="bg-blue-100 text-blue-700 rounded-full w-14 h-14 flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                            1
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-blue-800">Create Account</h3>
                        <p class="text-gray-600">Register for a new account on our secure admission portal</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="bg-white p-6 rounded-lg shadow-md text-center step-card animate-on-scroll">
                        <div class="bg-blue-100 text-blue-700 rounded-full w-14 h-14 flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                            2
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-blue-800">Complete Application</h3>
                        <p class="text-gray-600">Fill out all required forms with academic and personal information</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="bg-white p-6 rounded-lg shadow-md text-center step-card animate-on-scroll">
                        <div class="bg-blue-100 text-blue-700 rounded-full w-14 h-14 flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                            3
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-blue-800">Submit Documents</h3>
                        <p class="text-gray-600">Upload required documents and submit for review</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="bg-white p-6 rounded-lg shadow-md text-center step-card animate-on-scroll">
                        <div class="bg-blue-100 text-blue-700 rounded-full w-14 h-14 flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                            4
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-blue-800">Track Status</h3>
                        <p class="text-gray-600">Monitor your application status and receive updates</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Achievements Section -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-4 text-gray-800">School Achievements</h2>
                <p class="text-center text-gray-600 mb-12 max-w-3xl mx-auto">Excellence in academics, leadership, and community service</p>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Achievement 1 -->
                    <div class="bg-white rounded-lg shadow-md p-6 achievement-card animate-on-scroll">
                        <h3 class="text-xl font-semibold mb-3 text-blue-700">Best Performing School</h3>
                        <p class="text-gray-700">Recognized as the Best Performing School in the Division, consistently achieving academic excellence.</p>
                    </div>

                    <!-- Achievement 2 -->
                    <div class="bg-white rounded-lg shadow-md p-6 achievement-card animate-on-scroll">
                        <h3 class="text-xl font-semibold mb-3 text-blue-700">Brigada Eskwela Champion</h3>
                        <p class="text-gray-700">First place in Brigada Eskwela implementation, demonstrating exceptional community engagement.</p>
                    </div>

                    <!-- Achievement 3 -->
                    <div class="bg-white rounded-lg shadow-md p-6 achievement-card animate-on-scroll">
                        <h3 class="text-xl font-semibold mb-3 text-blue-700">Science Competition Winners</h3>
                        <p class="text-gray-700">Multiple national and regional awards in science fairs and competitions.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-16 bg-blue-700 text-white">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold mb-6">Ready to Apply?</h2>
                <p class="text-xl mb-8 max-w-2xl mx-auto">
                    Join our community of excellence in science and technology education.
                </p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                    <a
                        href="{{ route('register') }}"
                        class="bg-white text-blue-700 hover:bg-blue-50 px-8 py-4 rounded-lg font-medium text-lg transition shadow-lg inline-block"
                    >
                        Start Application
                    </a>
                    <a
                        href="{{ route('lead_info.create') }}"
                        class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-700 px-8 py-4 rounded-lg font-medium text-lg transition shadow-lg inline-block"
                    >
                        Inquire Now
                    </a>
                </div>
            </div>
        </section>

        <!-- Login Modal -->
        <div class="modal" x-show="showLoginModal" style="display: none;">
            <div class="modal-content max-w-md w-full bg-white rounded-lg shadow-2xl p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Sign In</h3>
                    <button @click="showLoginModal = false" class="text-gray-400 hover:text-gray-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-gray-700 mb-2 font-medium">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter your email"
                                required
                            />
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-gray-700 mb-2 font-medium">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter your password"
                                required
                            />
                        </div>
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
                        <a href="{{ route('password.request') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Forgot password?
                        </a>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-blue-700 text-white py-3 px-4 rounded-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition font-medium flex items-center justify-center"
                    >
                        <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            Register
                        </a>
                    </p>
                </div>

                <div class="mt-4 text-center">
                    <a href="{{ route('lead_info.create') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium inline-flex items-center">
                        <i class="fas fa-question-circle mr-1"></i> Have a question? Inquire Now
                    </a>
                </div>
            </div>
        </div>

        <!-- Data Privacy Modal -->
        <div id="privacyModal" class="modal">
            <div class="modal-content privacy-modal p-6 md:p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Data Privacy Policy</h3>
                <div class="prose max-w-none">
                    {!! Str::markdown(file_get_contents(resource_path('markdown/policy.md'))) !!}
                </div>
                <div class="flex justify-end mt-6">
                    <button onclick="closePrivacyPolicy()" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded-lg transition flex items-center">
                        <i class="fas fa-times mr-2"></i> Close
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800 text-gray-300 py-12">
            <div class="container mx-auto px-4">
                <div class="grid md:grid-cols-4 gap-8">
                    <!-- School Info -->
                    <div>
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('/static/images/school-logo-srccmsths.png') }}" alt="SRCCMSTHS Logo" class="w-12 h-12 rounded-full mr-3">
                            <h3 class="text-white text-lg font-semibold">SRCCMSTHS</h3>
                        </div>
                        <p class="mb-4">Senator Renato "Compañero" Cayetano Memorial Science and Technology High School</p>
                        <p class="italic">"To the east over mountain high."</p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-white text-lg font-semibold mb-6">Quick Links</h3>
                        <ul class="space-y-3">
                            <li><a href="#" class="hover:text-white transition footer-link"><i class="fas fa-chevron-right mr-2 text-blue-400"></i>Home</a></li>
                            <li><a href="#" class="hover:text-white transition footer-link"><i class="fas fa-chevron-right mr-2 text-blue-400"></i>Admissions</a></li>
                            <li><a href="#" class="hover:text-white transition footer-link"><i class="fas fa-chevron-right mr-2 text-blue-400"></i>News</a></li>
                            <li><a href="#" class="hover:text-white transition footer-link"><i class="fas fa-chevron-right mr-2 text-blue-400"></i>Faculty</a></li>
                        </ul>
                    </div>

                    <!-- Social Media -->
                    <div>
                        <h3 class="text-white text-lg font-semibold mb-6">Connect With Us</h3>
                        <ul class="space-y-3">
                            <li><a href="#" class="hover:text-white transition footer-link"><i class="fab fa-facebook text-blue-400 mr-3"></i>Facebook</a></li>
                            <li><a href="#" class="hover:text-white transition footer-link"><i class="fab fa-instagram text-blue-400 mr-3"></i>Instagram</a></li>
                            <li><a href="#" class="hover:text-white transition footer-link"><i class="fab fa-twitter text-blue-400 mr-3"></i>Twitter</a></li>
                            <li><a href="#" class="hover:text-white transition footer-link"><i class="fab fa-youtube text-blue-400 mr-3"></i>YouTube</a></li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div>
                        <h3 class="text-white text-lg font-semibold mb-6">Contact Us</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-envelope text-blue-400 mt-1.5 mr-3"></i>
                                <span>info@srccmsths.edu.ph</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-phone text-blue-400 mt-1.5 mr-3"></i>
                                <span>(02) 8888-7777</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-map-marker-alt text-blue-400 mt-1.5 mr-3"></i>
                                <span>Fort Bonifacio, Taguig City, Metro Manila, Philippines</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                    <p>&copy; {{ date('Y') }} Senator Renato "Compañero" Cayetano Memorial Science and Technology High School. All Rights Reserved.</p>
                    <p class="text-sm mt-2">Powered by <span class="text-blue-400">InnolabAMS</span> - Admission Management System</p>
                </div>
            </div>
        </footer>

        <!-- Auth Content Slot -->
        <div id="auth-content" class="max-h-screen flex flex-col justify-center items-center py-10 bg-gray-100" x-show="!showLoginModal" style="display: none;">
            <div class="w-full sm:max-w-md mt-4 px-6 py-4 bg-white shadow-xl rounded-lg">
                {{ $slot }}
            </div>
        </div>

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

                // Add smooth scrolling to all links
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function (e) {
                        e.preventDefault();

                        const targetId = this.getAttribute('href');
                        if (targetId === '#') return;

                        const targetElement = document.querySelector(targetId);
                        if (targetElement) {
                            targetElement.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    });
                });

                // Add animation on scroll for certain elements
                const animateOnScroll = function() {
                    const elements = document.querySelectorAll('.animate-on-scroll');

                    elements.forEach(element => {
                        const elementPosition = element.getBoundingClientRect();
                        const windowHeight = window.innerHeight;

                        if (elementPosition.top < windowHeight * 0.85) {
                            element.classList.add('animate-fade-in');
                            element.classList.remove('opacity-0');
                        }
                    });
                };

                // Run animation check on page load and scroll
                window.addEventListener('scroll', animateOnScroll);
                animateOnScroll(); // Run once on page load
            });
        </script>
    </body>
</html>

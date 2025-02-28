<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SRCCMSTHS') }}</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('/static/images/school-logo-srccmsths.png') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .carousel-container {
                position: relative;
                overflow: hidden;
                width: 100%;
            }

            .carousel-slide {
                display: none;
                width: 100%;
            }

            .carousel-slide.active {
                display: block;
            }

            .carousel-indicators {
                display: flex;
                justify-content: center;
                margin: 1rem 0;
            }

            .carousel-indicator {
                width: 10px;
                height: 10px;
                border-radius: 50%;
                background-color: #ccc;
                margin: 0 5px;
                cursor: pointer;
            }

            .carousel-indicator.active {
                background-color: #0066cc;
            }

            .wave-divider {
                width: 100%;
                height: 50px;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='1' d='M0,96L80,106.7C160,117,320,139,480,149.3C640,160,800,160,960,138.7C1120,117,1280,75,1360,53.3L1440,32L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
                background-size: cover;
                background-position: bottom;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-white" x-data="{ mobileMenuOpen: false }">
        <!-- Header Navigation -->
        <header class="bg-blue-600 text-white sticky top-0 z-50">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between h-20">
                    <!-- Logo and School Name -->
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('/static/images/school-logo-srccmsths.png') }}" alt="SRCCMSTHS Logo" class="w-12 h-12">
                        <span class="text-xl font-bold">SRCCMSTHS</span>
                    </div>

                    <!-- Main Navigation -->
                    <nav class="hidden md:flex items-center space-x-6">
                        <a href="#" class="py-2 hover:text-blue-200 transition-colors">Home</a>
                        <div class="relative group">
                            <a href="#" class="flex items-center py-2 hover:text-blue-200 transition-colors">
                                Our School
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="relative group">
                            <a href="#" class="flex items-center py-2 hover:text-blue-200 transition-colors">
                                Admissions
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </a>
                        </div>
                        <a href="#" class="py-2 hover:text-blue-200 transition-colors">News</a>
                        <a href="#" class="py-2 hover:text-blue-200 transition-colors">Facilities</a>
                        <a href="#" class="py-2 hover:text-blue-200 transition-colors">Clubs</a>
                        <a href="#" class="py-2 hover:text-blue-200 transition-colors">Faculty and Admin</a>
                        <a href="#" class="py-2 hover:text-blue-200 transition-colors">Inquiry</a>
                    </nav>

                    <!-- Search and Mobile Menu -->
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" class="hidden md:block bg-white text-blue-600 px-4 py-1 rounded-full text-sm font-medium">
                            Login
                        </a>
                        <button class="text-white hover:text-blue-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                        <button
                            @click="mobileMenuOpen = !mobileMenuOpen"
                            class="md:hidden text-white hover:text-blue-200"
                        >
                            <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Mobile Menu (Hidden by default) -->
        <div x-show="mobileMenuOpen" class="md:hidden bg-blue-600 text-white">
            <div class="container mx-auto px-4 py-2">
                <nav class="flex flex-col space-y-2">
                    <a href="#" class="py-2 hover:text-blue-200 transition-colors">Home</a>
                    <a href="#" class="py-2 hover:text-blue-200 transition-colors">Our School</a>
                    <a href="#" class="py-2 hover:text-blue-200 transition-colors">Admissions</a>
                    <a href="#" class="py-2 hover:text-blue-200 transition-colors">News</a>
                    <a href="#" class="py-2 hover:text-blue-200 transition-colors">Facilities</a>
                    <a href="#" class="py-2 hover:text-blue-200 transition-colors">Clubs</a>
                    <a href="#" class="py-2 hover:text-blue-200 transition-colors">Faculty and Admin</a>
                    <a href="#" class="py-2 hover:text-blue-200 transition-colors">Inquiry</a>
                    <a href="{{ route('login') }}" class="py-2 hover:text-blue-200 transition-colors">Login</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-blue-600 text-white py-10">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- School Info -->
                    <div>
                        <h3 class="text-lg font-bold mb-4">Senator Renato "Compañero" Cayetano Memorial Science and Technology High School</h3>
                        <p class="mb-2">To the east over mountain high.</p>
                        <p>Created by ICT 201 Batch 4.<br>2020-2021</p>
                    </div>

                    <!-- Social Media Links -->
                    <div>
                        <h3 class="text-lg font-bold mb-4">Facebook</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-blue-200 transition-colors">Cayetano SciTech News & Updates</a></li>
                            <li><a href="#" class="hover:text-blue-200 transition-colors">SRCCMSTHS SSG</a></li>
                            <li><a href="#" class="hover:text-blue-200 transition-colors">SRCCMSTHS CAT</a></li>
                            <li><a href="#" class="hover:text-blue-200 transition-colors">DEPED PENS - George Tizon</a></li>
                        </ul>
                    </div>

                    <!-- Other Social Media -->
                    <div>
                        <h3 class="text-lg font-bold mb-4">Instagram</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-blue-200 transition-colors">SRCCMSTHS SSG</a></li>
                            <li><a href="#" class="hover:text-blue-200 transition-colors">SRCCMSTHS CAT</a></li>
                            <li><a href="#" class="hover:text-blue-200 transition-colors">CIC-CCR</a></li>
                        </ul>

                        <h3 class="text-lg font-bold mt-4 mb-2">Twitter</h3>
                        <ul>
                            <li><a href="#" class="hover:text-blue-200 transition-colors">SRCCMSTHS SSG</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <!-- JavaScript for carousel -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const slides = document.querySelectorAll('.carousel-slide');
                const indicators = document.querySelectorAll('.carousel-indicator');
                let currentSlide = 0;

                function showSlide(index) {
                    // Hide all slides
                    slides.forEach(slide => {
                        slide.classList.remove('active');
                    });

                    // Deactivate all indicators
                    indicators.forEach(indicator => {
                        indicator.classList.remove('active');
                    });

                    // Show current slide and activate indicator
                    slides[index].classList.add('active');
                    indicators[index].classList.add('active');
                }

                // Set up indicator click handlers
                indicators.forEach((indicator, index) => {
                    indicator.addEventListener('click', () => {
                        currentSlide = index;
                        showSlide(currentSlide);
                    });
                });

                // Auto-rotate slides
                function nextSlide() {
                    currentSlide = (currentSlide + 1) % slides.length;
                    showSlide(currentSlide);
                }

                // Start with first slide
                showSlide(0);

                // Auto-rotate every 5 seconds
                setInterval(nextSlide, 5000);
            });
        </script>
    </body>
</html>

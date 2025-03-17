<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SRCCMSTHS - Our School</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('/static/images/innolab_favicon.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-black">
    <!-- Navigation Bar -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo on left -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('/static/images/srccmsths-logo.png') }}" alt="SRCCMSTHS Logo" class="h-10 w-10">
                        <span class="ml-2 text-xl font-bold text-blue-600">SRCCMSTHS</span>
                    </a>
                </div>

                <!-- Navigation items on right -->
                <div class="flex items-center">
                    <a href="/" class="px-3 text-gray-700 hover:text-blue-600">Home</a>
                    <a href="{{ route('school.show') }}" class="px-3 text-gray-700 hover:text-blue-600">Our School</a>

                    <!-- Admissions Dropdown -->
                    <div class="relative px-3" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false"
                                class="text-gray-700 hover:text-blue-600 flex items-center">
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

                    <a href="#" class="px-3 text-gray-700 hover:text-blue-600">News</a>
                    <a href="#" class="px-3 text-gray-700 hover:text-blue-600">Facilities</a>
                    <a href="#" class="px-3 text-gray-700 hover:text-blue-600">Clubs</a>
                    <a href="#" class="px-3 text-gray-700 hover:text-blue-600">Faculty and Admin</a>

                    <!-- Sign In Button -->
                    <a href="{{ route('login') }}" class="ml-3 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                        Sign In
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="container mx-auto px-4 py-12">
            <h1 class="text-4xl font-bold text-blue-600 text-center mb-16">OUR SCHOOL</h1>

            <div class="flex justify-center mb-16">
                <img src="{{ asset('/static/images/srccmsths-logo.png') }}" alt="SRCCMSTHS Logo" class="h-32">
            </div>

            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-center text-blue-600 mb-8">THE SRCCMSTHS SEAL</h2>

                <p class="text-gray-700 text-lg leading-relaxed text-center mb-16">
                    The Sunrays stands for the light that illuminates your path in building a temple of immortal souls in the
                    future generations; the Open Book means that anyone may come to engraft a branch of knowledge into the
                    stock of wisdom. The Mountains and Sunrays represents hope of a new beginning. The Gear symbolizes
                    technology and know-how in the modern society. The Building represents the City of Taguig of modern
                    infrastructures whilst the White Duck represents Pateros. The Laurel leaves represent the dignity of man
                    and serve as the emblem of victory, of a courageous flight of success. This is the meaning of our seal, revere
                    it, cherish it, and lives by it always.
                </p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-auto">
        <div class="container mx-auto px-4">
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
                <p class="text-sm">Copyright © 2025. All rights reserved. Developed by Innolab</p>
            </div>
        </div>
    </footer>

    <script>
        // Make sure Alpine.js is available for the dropdowns
        document.addEventListener('alpine:init', () => {
            // Initialize any Alpine.js data if needed
        });
    </script>
</body>
</html>
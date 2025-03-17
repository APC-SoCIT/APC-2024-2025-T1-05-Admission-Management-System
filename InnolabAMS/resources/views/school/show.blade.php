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

                    <!-- Our School -->
                    <div class="relative px-3" x-data="{ open: false }">
                        <a href="{{ route('school.show') }}" class="text-gray-700 hover:text-blue-600 flex items-center">
                            Our School
                            <button @click.prevent="open = !open" @click.away="open = false" class="ml-1 focus:outline-none">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                        </a>
                        <div x-show="open" class="absolute z-10 mt-2 w-48 bg-white text-gray-700 rounded-md shadow-lg py-1">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">History</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Mission and Vision</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">DepEd Philosophy</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Student Handbook</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Office of School Head</a>
                        </div>
                    </div>

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
                <p class="text-sm">Copyright © 2025. All rights reserved. Developed by
                    <a href="#" onclick="openAboutModal()" class="text-blue-300 hover:text-blue-100 underline">Innolab</a>
                </p>
            </div>
        </div>
    </footer>

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
                <button onclick="closeAboutModal()" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        // For About Modal
        function openAboutModal() {
            document.getElementById('aboutModal').style.display = 'flex';
        }

        function closeAboutModal() {
            document.getElementById('aboutModal').style.display = 'none';
        }

        // Make sure Alpine.js is available for the dropdowns
        document.addEventListener('alpine:init', () => {
            // Initialize any Alpine.js data if needed
        });
    </script>

    <style>
        /* Modal styles */
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
    </style>
</body>
</html>
<x-srccmsths-layout>
    <!-- Header Navigation -->
    <header class="bg-blue-600 text-white sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-20">
                <!-- Logo and School Name -->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('static/images/school-logo-srccmsths.png') }}"
                         alt="SRCCMSTHS Logo"
                         class="w-10 h-10">
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
                <div class="flex items-center">
                    <a href="{{ route('login') }}" class="md:hidden bg-white text-blue-600 px-4 py-1 rounded-full text-sm font-medium mr-2">
                        Login
                    </a>
                    <button class="text-white hover:text-blue-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section with School Name -->
    <div class="relative bg-blue-600 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight">
                SENATOR RENATO "COMPAÑERO" CAYETANO MEMORIAL<br>
                SCIENCE AND TECHNOLOGY HIGH SCHOOL
            </h1>
        </div>
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0" style="background-image: url('{{ asset('static/images/school-background-srccmsths.jpg') }}'); background-size: cover; background-position: center;">
            <div class="absolute inset-0 bg-blue-600 opacity-80"></div>
        </div>

        <!-- Wave Decoration -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full">
                <path fill="#ffffff" fill-opacity="1" d="M0,96L80,106.7C160,117,320,139,480,149.3C640,160,800,160,960,138.7C1120,117,1280,75,1360,53.3L1440,32L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
            </svg>
        </div>
    </div>

    <!-- Tagline -->
    <div class="bg-white py-10">
        <p class="text-center text-blue-600 text-2xl italic">
            Developing globally competitive students.
        </p>
    </div>

    <!-- Main Content -->
    <div class="flex-1 ml-64">
        <!-- Top Bar -->
        <div class="bg-blue-600 text-white h-24 flex justify-end items-center px-8">
            <a href="{{ route('login') }}"
               class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-blue-50 transition-colors">
                Login
            </a>
        </div>

        <!-- Main Content Area -->
        <div class="bg-white p-8">
            <h1 class="text-3xl text-blue-600 font-bold text-center mb-12">ACHIEVEMENTS</h1>

            <!-- Brigada Eskwela Section -->
            <div class="max-w-4xl mx-auto mb-16">
                <h2 class="text-2xl font-bold text-blue-600 mb-8">BRIGADA ESKWELA</h2>

                <div class="space-y-8">
                    <div>
                        <h3 class="font-bold text-lg">Mr. Mark Anthony Galan</h3>
                        <ul class="list-disc pl-5 space-y-2 mt-3">
                            <li>Division Rank 1 - Best Brigada Eskwela Coordinator (Medium School Category)</li>
                            <li>Regional Awardee - Brigada Eskwela Coordinator</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="font-bold text-lg">2019</h3>
                        <ul class="list-disc pl-5 mt-2">
                            <li>2nd Place - Best Brigada Eskwela Implementer - Division Level</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="font-bold text-lg">2018</h3>
                        <ul class="list-disc pl-5 mt-2">
                            <li>1st Place - Best Brigada Eskwela Implementer - Division Level</li>
                            <li>5th Place - Best Brigada Eskwela Implementer - Regional Level</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Best Performing School Section -->
            <div class="max-w-4xl mx-auto">
                <h2 class="text-2xl font-bold text-blue-600 mb-8">BEST PERFORMING SCHOOL</h2>
                <div class="bg-gray-50 rounded-lg p-8">
                    <p class="text-lg text-center italic">
                        SRCCMSTHS was recognized as the BEST PERFORMING SCHOOL in DepEd TAPAT, Secondary Level
                        alongside Taguig Science High School in the #DepEdStakeholdersSummit2019.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-srccmsths-layout>

<x-srccmsths-layout>
    <!-- Header Navigation -->
    <header class="bg-blue-600 text-white sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-20">
                <!-- Logo and School Name -->


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

    <!-- Hero Section with School Name (simplified without the large background logo) -->
    <div class="relative bg-blue-600 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight">
                SENATOR RENATO "COMPAÑERO" CAYETANO MEMORIAL<br>
                SCIENCE AND TECHNOLOGY HIGH SCHOOL
            </h1>
        </div>
        <!-- Just a simple blue background instead of the image with the large logo -->
        <div class="absolute inset-0 z-0 bg-blue-600"></div>
        <!-- Wave Decoration -->
        <div class="absolute bottom-0 left-0 right-0">
            <div class="wave-divider"></div>
        </div>
    </div>

    <!-- Tagline -->
    <div class="bg-white py-10">
        <p class="text-center text-blue-600 text-2xl italic">
            {{ $schoolTagline }}
        </p>
    </div>

    <!-- Carousel/Slider -->
    <div class="carousel-container mb-12">
        <!-- Slide 1 -->
        <div class="carousel-slide active">
            <img src="{{ asset('static/images/srccmsths/slide1.jpg') }}" alt="Research Competition" class="w-full">
            <div class="p-4 bg-gray-100">
                <p class="text-center">Research Competition - Applied Science Category - 1st Runner-Up</p>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-slide">
            <img src="{{ asset('static/images/srccmsths/slide2.jpg') }}" alt="Regional Schools Press Conference" class="w-full">
            <div class="p-4 bg-gray-100">
                <p class="text-center">Regional Schools Press Conference Awardees</p>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-slide">
            <img src="{{ asset('static/images/srccmsths/slide3.jpg') }}" alt="School Performance" class="w-full">
            <div class="p-4 bg-gray-100">
                <p class="text-center">School Performance and Cultural Activities</p>
            </div>
        </div>

        <!-- Slide 4 -->
        <div class="carousel-slide">
            <img src="{{ asset('static/images/srccmsths/slide4.jpg') }}" alt="Virtual Graduation" class="w-full">
            <div class="p-4 bg-gray-100">
                <p class="text-center">Virtual Graduation Ceremony</p>
            </div>
        </div>

        <!-- Carousel Indicators -->
        <div class="carousel-indicators">
            <div class="carousel-indicator active"></div>
            <div class="carousel-indicator"></div>
            <div class="carousel-indicator"></div>
            <div class="carousel-indicator"></div>
        </div>
    </div>

    <!-- Quote Section -->
    <div class="container mx-auto px-4 py-10 border-t border-b border-gray-200 mb-12">
        <blockquote class="text-center italic text-lg text-gray-700 max-w-4xl mx-auto">
            "Everybody talks about the new normal. Let's forget that. Let's think about the new future. We have an opportunity to shape the future. God put us at this time of COVID-19. You are the batch that graduated at the time of COVID-19. I believe you will all do great things for the city and your country."
            <footer class="text-gray-600 mt-4 font-semibold">- Mayor Lino Edgardo S. Cayetano</footer>
        </blockquote>
    </div>

    <!-- Achievements Section -->
    <div class="container mx-auto px-4 mb-16">
        <h2 class="text-4xl font-bold text-blue-600 text-center mb-12">ACHIEVEMENTS</h2>

        <!-- Brigada Eskwela Section -->
        <div class="max-w-5xl mx-auto mb-16">
            <h3 class="text-3xl font-bold text-blue-600 mb-10 text-center">BRIGADA ESKWELA</h3>

            <div class="grid md:grid-cols-2 gap-8 items-center mb-8">
                <div>
                    <img src="{{ asset('static/images/srccmsths/brigada-eskwela.jpg') }}" alt="Brigada Eskwela Award" class="rounded-lg shadow-lg">
                </div>
                <div>
                    <h4 class="text-xl font-bold text-blue-700 mb-4">2020</h4>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>1st Place - Best Brigada Eskwela Implementer - Division Level (Medium School Category)</li>
                        <li>Regional Awardee</li>
                    </ul>

                    <h4 class="text-xl font-bold text-blue-700 mt-6 mb-4">Mr. Mark Anthony Galan</h4>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Division Rank 1 - Best Brigada Eskwela Coordinator (Medium School Category)</li>
                        <li>Regional Awardee - Brigada Eskwela Coordinator</li>
                    </ul>

                    <h4 class="text-xl font-bold text-blue-700 mt-6 mb-4">2019</h4>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>2nd Place - Best Brigada Eskwela Implementer - Division Level</li>
                    </ul>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h4 class="text-xl font-bold text-blue-700 mb-4">Mr. Judd Lawrence D. Guy-joco</h4>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Best Brigada Eskwela Coordinator - Secondary Level</li>
                        <li>1st Place - 2018 Regional Brigada Eskwela Table Evaluation Best Presenter - Secondary Level</li>
                    </ul>

                    <h4 class="text-xl font-bold text-blue-700 mt-6 mb-4">2017</h4>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>2nd Place - Best Brigada Eskwela Implementer - Division Level</li>
                    </ul>
                </div>
                <div>
                    <img src="{{ asset('static/images/srccmsths/brigada-coordinator.jpg') }}" alt="Brigada Eskwela Coordinator" class="rounded-lg shadow-lg">
                </div>
            </div>
        </div>

        <!-- Best Performing School Section -->
        <div class="max-w-5xl mx-auto">
            <h3 class="text-3xl font-bold text-blue-600 mb-10 text-center">BEST PERFORMING SCHOOL</h3>

            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <img src="{{ asset('static/images/srccmsths/best-performing.jpg') }}" alt="Best Performing School Award" class="rounded-lg shadow-lg">
                </div>
                <div class="bg-gray-50 p-8 rounded-lg shadow">
                    <p class="text-lg italic">
                        SRCCMSTHS was recognized as the BEST PERFORMING SCHOOL in DepEd TAPAT, Secondary Level alongside Taguig Science High School in the #DepEdStakeholdersSummit2019.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-srccmsths-layout>

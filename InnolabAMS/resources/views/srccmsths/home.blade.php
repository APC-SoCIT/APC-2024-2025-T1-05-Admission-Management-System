<x-srccmsths-layout>
    <div class="min-h-screen bg-gray-100">
        <!-- Hero Section with School Logo and Name -->
        <div class="relative bg-blue-600 text-white py-12">
            <div class="container mx-auto px-4">
                <div class="flex flex-col items-center justify-center">
                    <!-- School Logo -->
                    <img src="{{ asset('static/images/school-logo-srccmsths.png') }}"
                         alt="SRCCMSTHS Logo"
                         class="w-32 h-32 mb-6">

                    <h1 class="text-3xl md:text-5xl font-bold text-center mb-4 leading-tight">
                        SENATOR RENATO "COMPAÑERO" CAYETANO MEMORIAL<br>
                        SCIENCE AND TECHNOLOGY HIGH SCHOOL
                    </h1>
                    <p class="text-xl text-center italic mt-4">
                        Developing globally competitive students.
                    </p>
                </div>
            </div>

            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 z-0" style="background-image: url('{{ asset('static/images/school-background-srccmsths.jpg') }}'); background-size: cover; background-position: center;">
                <div class="absolute inset-0 bg-blue-600 opacity-90"></div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="relative">
            <!-- Image Carousel Section -->
            <div class="bg-white py-12" x-data="{ activeSlide: 1 }">
                <div class="container mx-auto px-4">
                    <div class="relative overflow-hidden rounded-lg shadow-lg">
                        <!-- Carousel Images -->
                        <template x-for="(slide, index) in 7" :key="index">
                            <div x-show="activeSlide === index + 1"
                                 class="w-full h-[400px] bg-cover bg-center transition-opacity duration-500"
                                 :style="`background-image: url('/static/images/carousel-${index + 1}.jpg')`">
                            </div>
                        </template>

                        <!-- Carousel Navigation -->
                        <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2">
                            <template x-for="(dot, index) in 7" :key="index">
                                <button @click="activeSlide = index + 1"
                                        :class="{'bg-blue-600': activeSlide === index + 1, 'bg-gray-300': activeSlide !== index + 1}"
                                        class="w-3 h-3 rounded-full transition-colors duration-300">
                                </button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Achievements Section -->
            <div class="bg-gray-50 py-16">
                <div class="container mx-auto px-4">
                    <h2 class="text-3xl font-bold text-center text-blue-600 mb-12">ACHIEVEMENTS</h2>

                    <!-- Brigada Eskwela Section -->
                    <div class="max-w-5xl mx-auto mb-16">
                        <h3 class="text-2xl font-bold text-blue-600 mb-8">BRIGADA ESKWELA</h3>
                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="space-y-6">
                                <div>
                                    <h4 class="font-bold text-lg">Mr. Mark Anthony Galan</h4>
                                    <ul class="list-disc pl-5 space-y-2 mt-3">
                                        <li>Division Rank 1 - Best Brigada Eskwela Coordinator (Medium School Category)</li>
                                        <li>Regional Awardee - Brigada Eskwela Coordinator</li>
                                    </ul>
                                </div>

                                <div>
                                    <h4 class="font-bold text-lg">2019</h4>
                                    <ul class="list-disc pl-5 mt-2">
                                        <li>2nd Place - Best Brigada Eskwela Implementer - Division Level</li>
                                    </ul>
                                </div>

                                <div>
                                    <h4 class="font-bold text-lg">2018</h4>
                                    <ul class="list-disc pl-5 mt-2">
                                        <li>1st Place - Best Brigada Eskwela Implementer - Division Level</li>
                                        <li>5th Place - Best Brigada Eskwela Implementer - Regional Level</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Best Performing School Section -->
                    <div class="max-w-5xl mx-auto">
                        <h3 class="text-2xl font-bold text-blue-600 mb-8">BEST PERFORMING SCHOOL</h3>
                        <div class="bg-white rounded-lg shadow-lg p-8">
                            <p class="text-lg text-center italic">
                                SRCCMSTHS was recognized as the BEST PERFORMING SCHOOL in DepEd TAPAT, Secondary Level
                                alongside Taguig Science High School in the #DepEdStakeholdersSummit2019.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-blue-600 text-white py-12">
            <div class="container mx-auto px-4">
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Social Media Links -->
                    <div>
                        <h4 class="font-bold mb-4">Facebook</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:underline">Cayetano SciTech News & Updates</a></li>
                            <li><a href="#" class="hover:underline">SRCCMSTHS SSG</a></li>
                            <li><a href="#" class="hover:underline">SRCCMSTHS CAT</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-bold mb-4">Instagram</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:underline">SRCCMSTHS SSG</a></li>
                            <li><a href="#" class="hover:underline">SRCCMSTHS CAT</a></li>
                            <li><a href="#" class="hover:underline">CIC-CCR</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-bold mb-4">School Information</h4>
                        <p class="italic mb-2">To the east over mountain high.</p>
                        <p>Created by ICT 201 Batch 4.</p>
                        <p>2020-2021</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Login Button -->
        <div class="absolute top-4 right-4">
            <a href="{{ route('login') }}"
               class="bg-white text-blue-600 px-6 py-2 rounded-full font-semibold hover:bg-blue-50 transition-colors">
                Login
            </a>
        </div>
    </div>
</x-srccmsths-layout>

@php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
@endphp

<!-- resources/views/layouts/navigation.blade.php -->
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Logo section -->
        <div class="shrink-0 flex items-center">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('static/images/innolab_logo1.png') }}" class="h-10 w-auto" alt="Logo">
            </a>
            <span class="ml-3 text-xl font-semibold">Admission Management System</span>
        </div>

        <!-- Sidebar Navigation -->
        <div class="w-64 bg-white border-r h-full fixed left-0 top-16">
            <nav class="mt-5 px-4">
                <div class="space-y-4">
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center py-3 px-4 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-home w-5 h-5 mr-3"></i>
                        <span>Dashboard</span>
                    </a>

                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                                class="flex items-center w-full py-3 px-4 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-file-alt w-5 h-5 mr-3"></i>
                            <span>Admission</span>
                            <i class="fas fa-chevron-down ml-auto" :class="{ 'transform rotate-180': open }"></i>
                        </button>
                        <div x-show="open" class="pl-12 mt-2 space-y-2">
                            <a href="{{ route('applications.new') }}" class="block py-2 text-gray-600 hover:text-gray-900">
                                New Application
                            </a>
                            <a href="{{ route('applications.accepted') }}" class="block py-2 text-gray-600 hover:text-gray-900">
                                Accepted Application
                            </a>
                            <a href="{{ route('applications.rejected') }}" class="block py-2 text-gray-600 hover:text-gray-900">
                                Rejected Application
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('scholarship') }}"
                       class="flex items-center py-3 px-4 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-graduation-cap w-5 h-5 mr-3"></i>
                        <span>Scholarship</span>
                    </a>

                    <a href="{{ route('inquiries') }}"
                       class="flex items-center py-3 px-4 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-question-circle w-5 h-5 mr-3"></i>
                        <span>Inquiries</span>
                    </a>

                    <a href="{{ route('users') }}"
                       class="flex items-center py-3 px-4 text-gray-700 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-users w-5 h-5 mr-3"></i>
                        <span>Users</span>
                    </a>
                </div>
            </nav>
        </div>
    </div>
</nav>

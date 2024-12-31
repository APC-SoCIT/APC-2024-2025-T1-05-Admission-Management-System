@php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen">
        <!-- Top Navigation -->
        <div class="bg-white border-b shadow-sm">
            <div class="flex justify-between items-center px-6 py-2">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('static/images/innolab_logo1.png') }}" class="h-8 w-8" alt="Logo">
                    <span class="text-lg font-semibold">Admission Management System</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">Academic Year</span>
                    <span class="text-sm">{{ Auth::user()->email }}</span>
                </div>
            </div>
        </div>

        <!-- Main Layout -->
        <div class="flex">
            <!-- Sidebar -->
            @include('layouts.navigation')

            <!-- Main Content -->
            <main class="flex-1">
                <div class="py-4 px-6">
                    <!-- Header with Applicants title and buttons -->
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-xl font-semibold">Applicants</h1>
                        <div class="flex items-center space-x-3">
                            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Add Applicant
                            </button>
                            <button class="text-gray-500 hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                            <button class="text-gray-500 hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Main Content Area -->
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>
</html>

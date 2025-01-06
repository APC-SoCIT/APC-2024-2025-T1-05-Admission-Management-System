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

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Top Navigation Bar -->
        <div class="bg-white shadow">
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

        <!-- Main Content -->
        <div class="flex-1">
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>

@php
use Illuminate\Support\Facades\Auth;
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
    <div class="min-h-screen bg-gray-50">
        <!-- Top Navigation -->
        <div class="bg-white border-b">
            <div class="flex justify-between items-center px-4 py-3">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('static/images/innolab_logo1.png') }}" class="h-10 w-auto" alt="Logo">
                    <span class="text-xl font-semibold">Admission Management System</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span>Academic Year</span>
                    <span>{{ Auth::user()->email }}</span>
                </div>
            </div>
        </div>

        <!-- Main Layout -->
        <div class="flex">
            <!-- Sidebar -->
            @include('layouts.navigation')

            <!-- Main Content -->
            <div class="flex-1 ml-64 p-8 bg-gray-50">
                @if (isset($header))
                    <header class="mb-6">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-semibold text-gray-800">
                                {{ $header }}
                            </h2>
                            @if(View::hasSection('header_buttons'))
                                @yield('header_buttons')
                            @endif
                        </div>
                    </header>
                @endif

                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</body>
</html>

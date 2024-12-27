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
    <div class="min-h-screen bg-gray-50">
        <!-- Top Navigation -->
        <nav class="bg-white border-b border-gray-200">
            <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex items-center">
                            <img src="/logo.png" alt="Logo" class="h-8 w-8">
                            <span class="ml-2 text-xl font-semibold">Admission Management System</span>
                        </div>
                    </div>

                    <!-- Right Side -->
                    <div class="flex items-center">
                        <span class="mr-4">Academic Year</span>
                        <div class="ml-3 relative">
                            <!-- User Dropdown -->
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out">
                                        <div>{{ Auth::user()->email }}</div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <div class="flex">
            <div class="w-64 bg-white border-r border-gray-200 min-h-screen">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Admin Panel</h2>
                </div>
                <nav class="mt-4">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <i class="fas fa-home mr-2"></i>
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <!-- Admission Dropdown -->
                    <div x-data="{ open: false }">
                        <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-2 text-gray-600 hover:bg-gray-100">
                            <span class="flex items-center">
                                <i class="fas fa-file-alt mr-2"></i>
                                Admission
                            </span>
                            <i class="fas fa-chevron-down text-xs" :class="{ 'transform rotate-180': open }"></i>
                        </button>
                        <div x-show="open" class="ml-4">
                            <x-nav-link :href="route('applications.new')" :active="request()->routeIs('applications.new')">
                                New Application
                            </x-nav-link>
                            <x-nav-link :href="route('applications.accepted')" :active="request()->routeIs('applications.accepted')">
                                Accepted Application
                            </x-nav-link>
                            <x-nav-link :href="route('applications.rejected')" :active="request()->routeIs('applications.rejected')">
                                Rejected Application
                            </x-nav-link>
                        </div>
                    </div>

                    <x-nav-link :href="route('scholarship')" :active="request()->routeIs('scholarship')">
                        <i class="fas fa-graduation-cap mr-2"></i>
                        {{ __('Scholarship') }}
                    </x-nav-link>

                    <x-nav-link :href="route('inquiries')" :active="request()->routeIs('inquiries')">
                        <i class="fas fa-question-circle mr-2"></i>
                        {{ __('Inquiries') }}
                    </x-nav-link>

                    <x-nav-link :href="route('users')" :active="request()->routeIs('users')">
                        <i class="fas fa-users mr-2"></i>
                        {{ __('Users') }}
                    </x-nav-link>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="flex-1">
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</body>
</html>

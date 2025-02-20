<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'InnolabAMS') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('/static/images/innolab_favicon.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 text-black"
    x-data="{ showAuthLinks: false, activeButton: '', buttonsVisible: true }">
    <div class="relative w-full">
        <!-- Heading Section with Flexbox for Logo and Text -->
        <div class="flex items-center mt-10 ml-20">
            <!-- Logo -->
            <img src="{{ asset('/static/images/innolab_logo3.png') }}" alt="Logo" class="w-20 h-20 rounded-full mr-2">

            <!-- Text Next to Logo -->
            <div>
                <h1 class="text-2xl font-bold mb-1">InnolabAMS</h1>
                <h3 class="text-lg">Your innovation solution partner.</h3>
            </div>
        </div>
    </div>

    <div class="max-h-screen flex flex-col justify-center items-center mt-10 py-10 bg-gray-100">


        <div class="w-full sm:max-w-md mt-4 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>

        <!-- Inquire Now Link -->
        <div class="mt-4 text-center">
            <span class="text-sm text-black">Have a question? </span>
            <a href="{{ route('lead_info.create') }}"
                class="underline text-sm text-black hover:text-indigo-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Inquire Now') }}
            </a>
        </div>
    </div>
</body>

<!-- Footer -->
<footer class="w-full text-center text-sm py-4  text-gray-500 mt-4">
    <p>Copyright © 2025. All Rights Reserved. Developed by Innolab</p>
</footer>

</html>
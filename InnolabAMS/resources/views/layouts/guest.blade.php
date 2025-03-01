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

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    h1 {
        text-align: center;
        color: #333;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    /* Data Privacy Modal */
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

    .modal-content div {
        text-align: left;
        line-height: 1.8;
        padding: 25px;
    }

    /* Authentication Cards */
    .auth-options {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 30px;
    }

    .auth-card {
        display: none;
        opacity: 0;
        transform: translateY(-20px);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .auth-card.active {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .auth-button {
        padding: 12px 24px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
        border-radius: 8px;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        font-weight: 600;
        text-align: center;
        width: 200px;
    }

    .auth-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .auth-button.active {
        background: linear-gradient(135deg, #1e3a8a, #1e40af);
        transform: scale(0.98);
    }
</style>


<body class="font-sans antialiased bg-gradient-to-b from-blue-100 to-white">
    <div class="min-h-screen flex flex-col">
        <!-- Hero Section -->
        <div class="relative w-full bg-center bg-cover h-[400px]"
             style="background-image: url('{{ asset('static/images/school-background-srccmsths.jpg') }}')">
            <div class="absolute inset-0 bg-black/40"></div>
            <div class="relative z-10 container mx-auto px-6 py-8">
                <div class="flex items-center justify-center mt-8">
                    <img src="{{ asset('static/images/school-logo-srccmsths.png') }}"
                         alt="SRCCMSTHS Logo"
                         class="w-32 h-32">
                </div>
                <h1 class="text-4xl font-bold text-center text-white mt-6">
                    InnolabAMS
                </h1>
                <p class="text-xl text-center text-white mt-2">
                    Empowering Education Through Innovation
                </p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow container mx-auto px-6 py-8">
            <div class="max-w-md mx-auto">
                <!-- Auth Options -->
                <div class="auth-options">
                    <button onclick="showAuth('signin')" class="auth-button">
                        <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                    </button>
                    <button onclick="showAuth('register')" class="auth-button">
                        <i class="fas fa-user-plus mr-2"></i>Register
                    </button>
                </div>

                <!-- Auth Cards -->
                <div id="signin-card" class="auth-card bg-white rounded-lg shadow-xl overflow-hidden">
                    <div class="p-6">
                        {{ $slot }}
                    </div>
                </div>

                <div id="register-card" class="auth-card bg-white rounded-lg shadow-xl overflow-hidden">
                    <div class="p-6">
                        @include('auth.register')
                    </div>
                </div>

                <!-- Action Links -->
                <div class="mt-6 text-center space-y-4">
                    <div>
                        <span class="text-gray-600">Have a question? </span>
                        <a href="{{ route('lead_info.create') }}"
                           class="text-blue-600 hover:text-blue-800 font-medium">
                            Inquire Now
                        </a>
                    </div>

                    <!-- New: Check Out Our School Button -->
                    <a href="/school-tour"
                       class="inline-block bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-colors">
                        <i class="fas fa-school mr-2"></i>
                        Check Out Our School
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-6">
            <div class="container mx-auto px-6 text-center">
                <p class="text-sm">
                    Copyright © {{ date('Y') }} Senator Renato "Compañero" Cayetano Memorial Science and Technology High School.
                    <br>All Rights Reserved. Developed by Team Innolab
                </p>
            </div>
        </footer>
    </div>

    <!-- Data Privacy Modal -->
    <div id="privacyModal" class="modal">
        <div class="modal-content">
            <div class="prose max-w-none">
                {!! Str::markdown(file_get_contents(resource_path('markdown/policy.md'))) !!}
            </div>
            <div class="flex justify-end mt-4">
                <x-danger-button onclick="closePrivacyPolicy()">
                    Close
                </x-danger-button>
            </div>
        </div>
        </>
    </div>

    <script>
        function showAuth(type) {
            // Hide all cards
            document.querySelectorAll('.auth-card').forEach(card => {
                card.classList.remove('active');
            });

            // Remove active state from buttons
            document.querySelectorAll('.auth-button').forEach(button => {
                button.classList.remove('active');
            });

            // Show selected card and activate button
            if (type === 'signin') {
                document.getElementById('signin-card').classList.add('active');
                document.querySelector('button[onclick="showAuth(\'signin\')"]').classList.add('active');
            } else {
                document.getElementById('register-card').classList.add('active');
                document.querySelector('button[onclick="showAuth(\'register\')"]').classList.add('active');
            }
        }

        // Show signin by default if there are validation errors
        window.addEventListener('load', () => {
            const hasErrors = document.querySelector('.auth-card .text-red-500');
            if (hasErrors) {
                showAuth(hasErrors.closest('#register-card') ? 'register' : 'signin');
            }
        });
    </script>
</body>

<script>
    function openPrivacyPolicy() {
        document.getElementById('privacyModal').style.display = 'flex';
    }

    function closePrivacyPolicy() {
        document.getElementById('privacyModal').style.display = 'none';
    }
</script>

</html>

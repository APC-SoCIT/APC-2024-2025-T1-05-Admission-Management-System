<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SRCCMSTHS') }} - Inquiry Form</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('/static/images/innolab_favicon.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-image: url("{{ asset('static/images/srccmsths-bg-1.jpg') }}") !important;
            background-size: cover !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-attachment: fixed !important;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 700px;
            margin: 2rem auto;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }

        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #D1D5DB;
            border-radius: 0.375rem;
            margin-bottom: 0.5rem;
        }

        .required {
            color: #EF4444;
        }

        /* SweetAlert2 custom styling */
        .swal2-confirm-blue {
            background-color: #2563EB !important;
            color: white !important;
            border-radius: 0.375rem !important;
            padding: 0.5rem 1rem !important;
        }
    </style>
</head>

<body>
    <header class="bg-white shadow-sm mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <img src="{{ asset('/static/images/srccmsths-logo.png') }}" alt="Logo" class="w-10 h-10">
                        <span class="ml-2 text-xl font-bold text-blue-600">SRCCMSTHS</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/" class="px-5 py-2 rounded-md font-medium text-gray-700 hover:text-white hover:bg-blue-600 transition-colors duration-200">Home</a>
                </div>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- Data Privacy Modal -->
    <div id="privacyModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 50;">
        <div class="modal-content" style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); width: 80%; max-width: 900px; height: auto; max-height: 90vh; overflow-y: auto; padding: 20px;">
            <div class="prose max-w-none">
                {!! Str::markdown(file_get_contents(resource_path('markdown/policy.md'))) !!}
            </div>
            <div class="flex justify-end mt-4">
                <button onclick="closePrivacyPolicy()" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        function openPrivacyPolicy() {
            document.getElementById('privacyModal').style.display = 'flex';
        }

        function closePrivacyPolicy() {
            document.getElementById('privacyModal').style.display = 'none';
        }

        // Show/hide other skills field based on selection
        document.addEventListener('DOMContentLoaded', function() {
            const skillsDropdown = document.getElementById('skills_lead');
            const otherSkillsContainer = document.getElementById('other_skills_container');

            if(skillsDropdown && otherSkillsContainer) {
                skillsDropdown.addEventListener('change', function() {
                    if(this.value === 'Others') {
                        otherSkillsContainer.style.display = 'block';
                    } else {
                        otherSkillsContainer.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>

</html>
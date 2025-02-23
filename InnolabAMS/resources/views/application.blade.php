<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                @if(auth()->user()->hasRole('Admin'))
                    {{ __('Admin Panel') }}
                @elseif(auth()->user()->hasRole('Staff'))
                    {{ __('Staff Panel') }}
                @else(auth()->user()->hasRole('Applicant'))
                    {{ __('Applicant Panel') }}
               
                @endif
            </h2>


            @if(request()->routeIs('admission.show'))
            <div class="flex space-x-8 justify-start">
                    <a href="#" class="text-blue-600 pb-4 text-base underline">
                        Application
                    </a>
                    <a href="#" class="text-gray-600 pb-4 text-base">
                        Attachments
                    </a>
                    <a href="#" class="text-gray-600 pb-4 text-base">
                        Additional Information
                    </a>
            </div>
            @endif

                @unless(request()->routeIs('admission.show'))
                <h2 class="text-base">{{ __('2025 - 2026') }}</h2>
                @endunless
        </div>
    </x-slot>

    <head>
        <!-- Add Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>

    <div class="flex">
    <!-- Sidebar -->
    <div class="w-64 h-screen bg-gray-100 text-gray-800 border-r border-gray-300 flex-shrink-0">
        <ul class="space-y-6 p-6">
            @if(auth()->user()->hasRole('Admin'))
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out
                              {{ request()->routeIs('dashboard') ? 'bg-gray-200' : '' }}">
                        <i class="fa-solid fa-house w-6 text-center"></i>
                        <span class="font-semibold ml-6">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admission.index') }}"
                       class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out
                              {{ request()->routeIs('admission.*') ? 'bg-gray-200' : '' }}">
                        <i class="fa-solid fa-file w-6 text-center"></i>
                        <span class="font-semibold ml-6">{{ __('Admission') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('scholarship.show') }}"
                       class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out
                              {{ request()->routeIs('scholarship.show') ? 'bg-gray-200' : '' }}">
                        <i class="fa-solid fa-graduation-cap w-6 text-center"></i>
                        <span class="font-semibold ml-6">{{ __('Scholarship') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('inquiry.index') }}"
                       class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out
                              {{ request()->routeIs('inquiry.index') ? 'bg-gray-200' : '' }}">
                        <i class="fa-solid fa-question-circle w-6 text-center"></i>
                        <span class="font-semibold ml-6">{{ __('Inquiries') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.show') }}"
                       class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out
                       {{ request()->routeIs('user.show') ? 'bg-gray-200' : '' }}">
                        <i class="fa-solid fa-users w-6 text-center"></i>
                        <span class="font-semibold ml-6">{{ __('Users') }}</span>
                    </a>
                </li>
            @elseif(auth()->user()->hasRole('Staff'))
                <li>
                    <a href="{{ route('admission.index') }}"
                       class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out
                              {{ request()->routeIs('admission.*') ? 'bg-gray-200' : '' }}">
                        <i class="fa-solid fa-file w-6 text-center"></i>
                        <span class="font-semibold ml-6">{{ __('Admission') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('scholarship.show') }}"
                       class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out
                              {{ request()->routeIs('scholarship.show') ? 'bg-gray-200' : '' }}">
                        <i class="fa-solid fa-graduation-cap w-6 text-center"></i>
                        <span class="font-semibold ml-6">{{ __('Scholarship') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('inquiry.index') }}"
                       class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out
                              {{ request()->routeIs('inquiry.index') ? 'bg-gray-200' : '' }}">
                        <i class="fa-solid fa-question-circle w-6 text-center"></i>
                        <span class="font-semibold ml-6">{{ __('Inquiries') }}</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>

    <!-- Content Area -->
    <div class="flex-grow p-6">
        <!-- Welcome Message -->
        @if (Request::is('app'))
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-semibold mx-4 my-4">{{ __('Welcome, ') . Auth::user()->name }}</h1>
            </div>
        @endif

        <div>
            @yield('content')
        </div>
    </div>
</div>
</x-app-layout>

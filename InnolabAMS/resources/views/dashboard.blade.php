<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin Panel') }}
            </h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('2025 - 2026') }}
            </h2>
        </div>
    </x-slot>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 h-screen bg-gray-100 text-gray-800 border-r border-gray-300 flex-shrink-0">
            <ul class="space-y-6 p-6">
                <li>
                    <a href="{{ route('user.show') }}" class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out">
                        <i class="fa-solid fa-user mr-2"></i>
                        <span class="font-semibold ml-2">{{ __('Users') }}</span>
                    </a>

                    <a href="{{ route('scholarship.show') }}" class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out">
                        <i class="fa-solid fa-graduation-cap text lg mr-2"></i>
                        <span class="font-semibold ml-1">{{ __('Scholarship') }}</span>
                    </a>
                    <a href="{{ route('scholarship.show') }}" class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out">
                        <i class="fa-solid fa-graduation-cap text lg mr-2"></i>
                        <span class="font-semibold ml-1">{{ __('Scholarship') }}</span>
                    </a>

                    <!-- Add more menu items here -->
                </li>

            </ul>
        </div>

        <!-- Content Area -->
        <div class="flex-grow p-6">

            @yield('content')
        </div>
    </div>
</x-app-layout>
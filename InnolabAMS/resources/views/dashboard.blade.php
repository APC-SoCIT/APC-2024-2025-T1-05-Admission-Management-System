@php
use Illuminate\Support\Facades\Auth;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 h-screen bg-white text-gray-800 border-r border-gray-300 flex-shrink-0">
            <ul class="space-y-6 p-6">
                <li>
                    <a href="{{ route('applications.index') }}"
                       class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out">
                        <i class="fa-solid fa-list mr-2"></i>
                        <span class="ml-2">{{ __('Applications') }}</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Content Area -->
        <div class="flex-grow p-6">
            {{ __("You're logged in!") }}
            @yield('content')
        </div>
    </div>
</x-app-layout>

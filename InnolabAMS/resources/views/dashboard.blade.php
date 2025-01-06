@php
use Illuminate\Support\Facades\Auth;
@endphp

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
                <!-- Users Tab -->
                <li>
                    <a href="{{ route('users.index') }}"
                       class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out
                              {{ request()->routeIs('users.*') ? 'bg-gray-200' : '' }}"
                       aria-label="Manage Users">
                        <i class="fa-solid fa-user mr-2"></i>
                        <span class="font-semibold ml-2">{{ __('Users') }}</span>
                    </a>
                </li>

                <!-- Applications Dropdown -->
                <li x-data="{ open: false }">
                    <button @click="open = !open"
                            class="w-full flex items-center justify-between py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out
                                   {{ request()->routeIs('applications.*') ? 'bg-gray-200' : '' }}">
                        <div class="flex items-center">
                            <i class="fa-solid fa-list mr-2"></i>
                            <span class="font-semibold ml-2">{{ __('Applications') }}</span>
                        </div>
                        <svg class="h-5 w-5 transform" :class="{ 'rotate-180': open }"
                             xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="pl-12 space-y-2 mt-2">
                        <a href="{{ route('applications.new') }}"
                           class="block py-2 px-4 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded transition duration-200 ease-in-out
                                  {{ request()->routeIs('applications.new') ? 'bg-gray-200 text-gray-900' : '' }}">
                            New Application
                        </a>
                        <a href="{{ route('applications.accepted') }}"
                           class="block py-2 px-4 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded transition duration-200 ease-in-out
                                  {{ request()->routeIs('applications.accepted') ? 'bg-gray-200 text-gray-900' : '' }}">
                            Accepted Application
                        </a>
                        <a href="{{ route('applications.rejected') }}"
                           class="block py-2 px-4 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded transition duration-200 ease-in-out
                                  {{ request()->routeIs('applications.rejected') ? 'bg-gray-200 text-gray-900' : '' }}">
                            Rejected Application
                        </a>
                    </div>
                </li>

                <!-- Scholarship Tab -->
                <li>
                    <a href="{{ route('scholarship.show') }}"
                       class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out
                              {{ request()->routeIs('scholarship.*') ? 'bg-gray-200' : '' }}"
                       aria-label="Manage Scholarships">
                        <i class="fa-solid fa-graduation-cap text-lg mr-2"></i>
                        <span class="font-semibold ml-1">{{ __('Scholarship') }}</span>
                    </a>
                </li>

                <!-- Inquiries Tab -->
                <li>
                    <a href="{{ route('inquiry.show', ['id' => 1]) }}"
                       class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out
                              {{ request()->routeIs('inquiry.*') ? 'bg-gray-200' : '' }}"
                       aria-label="Manage Inquiry">
                        <i class="fa-solid fa-question-circle mr-2"></i>
                        <span class="font-semibold ml-2">{{ __('Inquiry') }}</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Content Area -->
        <div class="flex-grow p-6">
            @yield('content')
        </div>
    </div>
</x-app-layout>

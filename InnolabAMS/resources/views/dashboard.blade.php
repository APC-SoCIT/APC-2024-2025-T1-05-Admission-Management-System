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
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out
                              {{ request()->routeIs('dashboard') ? 'bg-gray-200' : '' }}">
                        <i class="fa-solid fa-house w-6 text-center"></i>
                        <span class="font-semibold ml-6">{{ __('Dashboard') }}</span>
                    </a>
                </li>

                <li x-data="{ open: {{ request()->routeIs('admission.*') ? 'true' : 'false' }} }" 
                    x-init="open = {{ request()->routeIs('admission.*') ? 'true' : 'false' }}">
                    <div class="w-full flex items-center justify-between py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out
                                {{ request()->routeIs('admission.*') ? 'bg-gray-200' : '' }}">
                        <div class="flex items-center cursor-pointer" @click="window.location.href = '{{ route('admission.new') }}'">
                            <i class="fa-solid fa-file w-6 text-center"></i>
                            <span class="font-semibold ml-6">{{ __('Applications') }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-xs bg-white-500 text-blackS px-2 py-1 rounded-full">
                                {{ $newApplicationsCount ?? 0 }}
                            </span>
                            <button @click="open = !open" class="ml-3 focus:outline-none">
                                <i class="fa-solid fa-chevron-down w-6 text-center transition-transform duration-200"
                                   :class="{'rotate-180': open}"></i>
                            </button>
                        </div>
                    </div>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="pl-12 space-y-2 mt-2">
                        <a href="{{ route('admission.new') }}"
                           class="flex justify-between py-2 px-4 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded transition duration-200 ease-in-out
                                  {{ request()->routeIs('admission.new') ? 'bg-gray-200 text-gray-900' : '' }}">
                            <span>New Applications</span>
                            <span class="text-xs bg-white-500 text-black px-2 py-1 rounded-full">
                                {{ $newApplicationsCount ?? 0 }}
                            </span>
                        </a>
                        <a href="{{ route('admission.accepted') }}"
                           class="flex justify-between py-2 px-4 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded transition duration-200 ease-in-out
                                  {{ request()->routeIs('admission.accepted') ? 'bg-gray-200 text-gray-900' : '' }}">
                            <span>Accepted Applications</span>
                            <span class="text-xs bg-white-500 text-black px-2 py-1 rounded-full">
                                {{ $acceptedApplicationsCount ?? 0 }}
                            </span>
                        </a>
                        <a href="{{ route('admission.rejected') }}"
                           class="flex justify-between py-2 px-4 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded transition duration-200 ease-in-out
                                  {{ request()->routeIs('admission.rejected') ? 'bg-gray-200 text-gray-900' : '' }}">
                            <span>Rejected Applications</span>
                            <span class="text-xs bg-white-500 text-black px-2 py-1 rounded-full">
                                {{ $rejectedApplicationsCount ?? 0 }}
                            </span>
                        </a>
                    </div>
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
                        <span class="font-semibold ml-6">{{ __('Inquiry') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.show') }}"
                       class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out
                              {{ request()->routeIs('user.show') ? 'bg-gray-200' : '' }}">
                        <i class="fa-solid fa-user w-6 text-center"></i>
                        <span class="font-semibold ml-6">{{ __('Users') }}</span>
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
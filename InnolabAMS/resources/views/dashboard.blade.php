<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin Panel') }}
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
                        <div class="flex items-center cursor-pointer" @click="window.location.href = '{{ route('admission.index') }}'">
                            <i class="fa-solid fa-file w-6 text-center"></i>
                            <span class="font-semibold ml-6">{{ __('Admission') }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-xs bg-white-500 text-black px-2 py-1 rounded-full">
                                {{ $newApplicationsCount ?? 0 }}
                            </span>
                            <button @click.stop="open = !open" class="ml-3 focus:outline-none">
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

                <!-- Rest of the sidebar items remain unchanged -->
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
                       class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out">
                        <i class="fa-solid fa-users w-6 text-center"></i>
                        <span class="font-semibold ml-6">{{ __('Users') }}</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Content Area -->
        <div class="flex-grow p-6">
            <!-- Welcome Message -->
            @if (Request::is('dashboard'))
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-semibold mx-4 my-4">{{ __('Welcome, ') . Auth::user()->name }}</h1>
                </div>

                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Total Applications -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-gray-500 text-sm font-medium">Total Submitted Applications</h3>
                        <div class="flex items-center">
                            <div class="flex-1">
                                <p class="text-3xl font-bold text-gray-900">{{ $totalApplications ?? 1323 }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Accepted Applications -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-gray-500 text-sm font-medium">Accepted Applications</h3>
                        <div class="flex items-center">
                            <div class="flex-1">
                                <p class="text-3xl font-bold text-green-600">{{ $acceptedApplications ?? 223 }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Rejected Applications -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-gray-500 text-sm font-medium">Rejected Applications</h3>
                        <div class="flex items-center">
                            <div class="flex-1">
                                <p class="text-3xl font-bold text-red-600">{{ $rejectedApplications ?? 32 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Admission Trends Chart -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-gray-500 text-sm font-medium mb-4">Admission Trends</h3>
                        <div class="h-64">
                            <livewire:admission-trends-chart />
                        </div>
                    </div>

                    <!-- Acceptance Rate Chart -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-gray-500 text-sm font-medium mb-4">Acceptance Rate</h3>
                        <div class="h-64">
                            <livewire:acceptance-rate-chart />
                        </div>
                    </div>
                </div>

                <!-- Additional Statistics -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Inquiries -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-gray-500 text-sm font-medium mb-4">Inquiries</h3>
                        <p class="text-2xl font-bold mb-4">1,323 Leads</p>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span>Events</span>
                                <span class="font-medium">800</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Campaign</span>
                                <span class="font-medium">300</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Walk-in</span>
                                <span class="font-medium">223</span>
                            </div>
                        </div>
                    </div>

                    <!-- Channels -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-gray-500 text-sm font-medium mb-4">Channels</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span>Social Media</span>
                                <span class="font-medium">450</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Website</span>
                                <span class="font-medium">300</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Referral</span>
                                <span class="font-medium">573</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Conversion Rate -->
                <div class="mt-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-gray-500 text-sm font-medium mb-4">Conversion Rate</h3>
                        <div class="h-64">
                            <livewire:conversion-rate-chart />
                        </div>
                    </div>
                </div>
            @endif

            <div>
                @yield('content')
            </div>
        </div>
    </div>
</x-app-layout>

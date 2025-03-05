<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Applicant Portal') }}
            </h2>
        </div>
    </x-slot>

    <div class="flex">
        <!-- Improved Sidebar with Visual Indicators -->
        <div class="w-72 h-screen bg-white shadow-lg border-r border-gray-200 flex-shrink-0">
            <div class="p-6">
                <div class="mb-8">
                    <div class="flex items-center space-x-3">
                        <img src="{{ auth()->user()->profile_photo_url }}" class="h-12 w-12 rounded-full">
                        <div>
                            <h3 class="font-medium text-gray-900">{{ Auth::user()->name }}</h3>
                            <p class="text-sm text-gray-500">Applicant</p>
                        </div>
                    </div>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('portal') }}"
                       class="flex items-center px-4 py-3 rounded-lg transition-all duration-200
                              {{ request()->routeIs('portal') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="fa-solid fa-house w-5 h-5"></i>
                        <span class="ml-3 font-medium">{{ __('Home') }}</span>
                    </a>

                    @php
                        $applicant = auth()->user()->applicantInfo;
                        $applicationStatus = $applicant ? 'complete' : 'pending';
                    @endphp

                    <a href="{{ $applicant ? route('admission.show', $applicant->id) : route('form.application') }}"
                       class="flex items-center justify-between px-4 py-3 rounded-lg transition-all duration-200
                              {{ request()->routeIs('form.application') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        <div class="flex items-center">
                            <i class="fa-solid fa-file w-5 h-5"></i>
                            <span class="ml-3 font-medium">{{ __('Application Form') }}</span>
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full {{ $applicationStatus === 'complete' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                            {{ ucfirst($applicationStatus) }}
                        </span>
                    </a>

                    <a href="{{ route('scholarship.create') }}"
                       class="flex items-center px-4 py-3 rounded-lg transition-all duration-200
                              {{ request()->routeIs('scholarship.create') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="fa-solid fa-handshake w-5 h-5"></i>
                        <span class="ml-3 font-medium">{{ __('Scholarship Form') }}</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Enhanced Content Area -->
        <div class="flex-grow bg-gray-50">
            @if (Request::is('portal'))
                <div class="p-8">
                    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">
                            {{ __('Welcome back, ') . Auth::user()->name }}! 👋
                        </h1>
                        <p class="text-gray-600">Let's continue with your admission journey.</p>
                    </div>

                    <!-- Application Progress Cards -->
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Application Status Card -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="font-semibold text-gray-900">Application Status</h3>
                                <i class="fa-solid fa-clipboard-check text-blue-500"></i>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $applicationStatus === 'complete' ? '100%' : '45%' }}"></div>
                                    </div>
                                    <span class="ml-4 text-sm text-gray-600">{{ $applicationStatus === 'complete' ? '100%' : '45%' }}</span>
                                </div>
                                <p class="text-sm text-gray-600">
                                    {{ $applicationStatus === 'complete' ? 'Your application is complete!' : 'Complete your application form to proceed.' }}
                                </p>
                            </div>
                        </div>

                        <!-- Quick Actions Card -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h3 class="font-semibold text-gray-900 mb-4">Quick Actions</h3>
                            <div class="space-y-3">
                                <a href="{{ $applicant ? route('admission.show', $applicant->id) : route('form.application') }}"
                                   class="block px-4 py-2 text-sm text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                    <i class="fa-solid fa-arrow-right mr-2"></i>
                                    {{ $applicationStatus === 'complete' ? 'View Application' : 'Continue Application' }}
                                </a>
                                <a href="{{ route('scholarship.create') }}"
                                   class="block px-4 py-2 text-sm text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                    <i class="fa-solid fa-arrow-right mr-2"></i>
                                    Apply for Scholarship
                                </a>
                            </div>
                        </div>

                        <!-- Help & Support Card -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h3 class="font-semibold text-gray-900 mb-4">Need Help?</h3>
                            <p class="text-sm text-gray-600 mb-4">
                                Having trouble with your application? Our support team is here to help.
                            </p>
                            <a href="#" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-700">
                                <i class="fa-solid fa-headset mr-2"></i>
                                Contact Support
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <div class="p-8">
                @yield('content')
            </div>
        </div>
    </div>
</x-app-layout>

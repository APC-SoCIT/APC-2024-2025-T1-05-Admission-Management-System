<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Applicant Portal') }}
            </h2>
        </div>
    </x-slot>

    <div class="flex min-h-screen">
        <!-- Fixed Sidebar with full height -->
        <div class="w-72 bg-white shadow-lg border-r border-gray-200 flex-shrink-0 sticky top-0 h-screen overflow-y-auto">
            <div class="p-6">
                <nav class="space-y-2">
                    <a href="{{ route('portal') }}"
                       class="flex items-center px-4 py-3 rounded-lg transition-all duration-200
                              {{ request()->routeIs('portal') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="fa-solid fa-house w-5 h-5"></i>
                        <span class="ml-3 font-medium">{{ __('Home') }}</span>
                    </a>

                    @php
                        $applicant = auth()->user()->applicantInfo;
                    @endphp

                    <a href="{{ $applicant ? route('admission.show', $applicant->id) : route('form.application') }}"
                       class="flex items-center px-4 py-3 rounded-lg transition-all duration-200
                              {{ request()->routeIs('form.application') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="fa-solid fa-file w-5 h-5"></i>
                        <span class="ml-3 font-medium">{{ __('Application Form') }}</span>
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
                                @php
                                    $statusColor = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'accepted' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800'
                                    ];
                                    $status = $applicant?->status ?? 'pending';
                                @endphp

                                <div class="flex items-center space-x-2">
                                    <span class="px-3 py-1 rounded-full text-sm font-medium {{ $statusColor[$status] }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600">
                                    @if($status === 'pending')
                                        Complete your application form to proceed.
                                    @elseif($status === 'accepted')
                                        Congratulations! Your application has been accepted.
                                    @else
                                        Unfortunately, your application was not accepted.
                                    @endif
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
                                    {{ $status === 'complete' ? 'View Application' : 'Continue Application' }}
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

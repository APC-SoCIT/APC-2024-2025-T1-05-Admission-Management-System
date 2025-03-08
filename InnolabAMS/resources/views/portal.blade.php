<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Applicant Portal') }}
            </h2>
        </div>
    </x-slot>

    <div class="flex min-h-screen bg-gray-50">
        <!-- Fixed Sidebar - Now always visible -->
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

        <!-- Main Content Area -->
        <div class="flex-grow">
            @if (Request::is('portal'))
                <!-- Hero Welcome Section -->
                <div class="bg-white">
                    <div class="p-8">
                        <h1 class="text-3xl font-bold mb-2 text-gray-900">
                            {{ __('Welcome back, ') . Auth::user()->name }}! 👋
                        </h1>
                        <p class="text-gray-600">Let's continue with your admission journey.</p>
                    </div>
                </div>

                <div class="max-w-7xl mx-auto p-8">
                    <!-- Application Progress Section -->
                    <div class="mb-12">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Application Progress</h2>
                        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                            @php
                                $hasRequiredDocs = $applicant &&
                                    $applicant->birth_certificate_path &&
                                    $applicant->form_137_path &&
                                    $applicant->form_138_path &&
                                    $applicant->id_picture_path &&
                                    $applicant->good_moral_path;

                                $applicationFilled = $applicant &&
                                    $applicant->applicant_surname &&
                                    $applicant->applicant_given_name &&
                                    $applicant->apply_program &&
                                    $applicant->apply_grade_level;

                                $steps = [
                                    [
                                        'icon' => 'fa-solid fa-user-plus',
                                        'title' => 'Create Account',
                                        'done' => true
                                    ],
                                    [
                                        'icon' => 'fa-solid fa-file-lines',
                                        'title' => 'Fill Application',
                                        'done' => $applicationFilled
                                    ],
                                    [
                                        'icon' => 'fa-solid fa-file-arrow-up',
                                        'title' => 'Submit Documents',
                                        'done' => $hasRequiredDocs
                                    ],
                                    [
                                        'icon' => 'fa-solid fa-check-circle',
                                        'title' => 'Complete',
                                        'done' => $applicant && $applicant->status == 'accepted'
                                    ]
                                ];
                            @endphp

                            @foreach($steps as $step)
                                <div class="bg-white rounded-lg p-6 border {{ $step['done'] ? 'border-green-200' : 'border-gray-200' }}">
                                    <div class="flex items-center mb-4">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $step['done'] ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-500' }}">
                                            <i class="{{ $step['icon'] }}"></i>
                                        </div>
                                        <span class="ml-3 font-medium text-gray-900">{{ $step['title'] }}</span>
                                    </div>
                                    @if($step['done'])
                                        <span class="text-sm text-green-600">
                                            <i class="fa-solid fa-check mr-1"></i> Completed
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-500">Pending</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Quick Actions & Status Section -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Application Status Card -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Application Status</h3>
                            @php
                                $statusConfig = [
                                    'new' => ['color' => 'blue', 'icon' => 'fa-file-lines'],
                                    'pending' => ['color' => 'yellow', 'icon' => 'fa-clock'],
                                    'accepted' => ['color' => 'green', 'icon' => 'fa-check-circle'],
                                    'rejected' => ['color' => 'red', 'icon' => 'fa-times-circle']
                                ];

                                $currentStatus = $applicant ? strtolower($applicant->status) : 'new';
                                $config = $statusConfig[$currentStatus];
                            @endphp

                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-full bg-{{ $config['color'] }}-100 flex items-center justify-center">
                                    <i class="fa-solid {{ $config['icon'] }} text-{{ $config['color'] }}-600 text-xl"></i>
                                </div>
                                <div>
                                    <span class="block font-medium text-gray-900">{{ ucfirst($currentStatus) }}</span>
                                    <span class="text-sm text-gray-600">Last updated: {{ $applicant ? $applicant->updated_at->diffForHumans() : 'Not started' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions Card -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                            <div class="space-y-3">
                                <a href="{{ $applicant ? route('admission.show', $applicant->id) : route('form.application') }}"
                                   class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                                    <i class="fa-solid fa-arrow-right mr-3"></i>
                                    <span>{{ $currentStatus === 'complete' ? 'View Application' : 'Continue Application' }}</span>
                                </a>
                                <a href="{{ route('scholarship.create') }}"
                                   class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                                    <i class="fa-solid fa-graduation-cap mr-3"></i>
                                    <span>Apply for Scholarship</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Help Section -->
                    <div class="mt-6 bg-white rounded-lg shadow-sm p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Need Help?</h3>
                                <p class="text-gray-600 mt-1">Having trouble with your application? Our support team is here to help.</p>
                            </div>
                            <a href="mailto:innolabdevelopers@gmail.com"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
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

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin Panel') }}
            </h2>


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
            @if (Request::is('dashboard'))
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-semibold mx-4 my-4">{{ __('Welcome, ') . Auth::user()->name }}</h1>
                    <button @click="refreshData()" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        <i class="fa-solid fa-sync"></i> Refresh Data
                    </button>
                </div>

                <div x-data="analyticsData()" x-init="initCharts(); setInterval(() => refreshData(), 5000)">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-700">Admissions</h3>
                                <i class="fa-solid fa-users-viewfinder text-blue-500"></i>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">New</span>
                                    <span x-text="stats.newApplications" class="text-2xl font-bold text-blue-600"></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Accepted</span>
                                    <span x-text="stats.acceptedApplications" class="text-2xl font-bold text-green-600"></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Rejected</span>
                                    <span x-text="stats.rejectedApplications" class="text-2xl font-bold text-red-600"></span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-700">Inquiries</h3>
                                <i class="fa-solid fa-question-circle text-purple-500"></i>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">New</span>
                                    <span x-text="stats.newInquiries" class="text-2xl font-bold text-purple-600"></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Resolved</span>
                                    <span x-text="stats.resolvedInquiries" class="text-2xl font-bold text-green-600"></span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-700">Scholarships</h3>
                                <i class="fa-solid fa-graduation-cap text-amber-500"></i>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Applications</span>
                                    <span x-text="stats.scholarshipApplications" class="text-2xl font-bold text-amber-600"></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Approved</span>
                                    <span x-text="stats.approvedScholarships" class="text-2xl font-bold text-green-600"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">Admissions Trend</h3>
                            <canvas id="admissionsChart"></canvas>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">Applications Status</h3>
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                </div>
            @endif

            <div>
                @yield('content')
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function analyticsData() {
            return {
                stats: {
                    newApplications: {{ $newApplicationsCount ?? 0 }},
                    acceptedApplications: {{ $acceptedApplicationsCount ?? 0 }},
                    rejectedApplications: {{ $rejectedApplicationsCount ?? 0 }},
                    newInquiries: {{ $newInquiriesCount ?? 0 }},
                    resolvedInquiries: {{ $resolvedInquiriesCount ?? 0 }},
                    scholarshipApplications: {{ $scholarshipApplicationsCount ?? 0 }},
                    approvedScholarships: {{ $approvedScholarshipsCount ?? 0 }}
                },
                charts: {},

                initCharts() {
                    this.charts.admissions = new Chart(
                        document.getElementById('admissionsChart'),
                        {
                            type: 'line',
                            data: {
                                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                                datasets: [{
                                    label: 'Applications',
                                    data: [12, 19, 3, 5, 2, 3],
                                    borderColor: 'rgb(59, 130, 246)',
                                    tension: 0.1
                                }]
                            }
                        }
                    );

                    this.charts.status = new Chart(
                        document.getElementById('statusChart'),
                        {
                            type: 'doughnut',
                            data: {
                                labels: ['New', 'Accepted', 'Rejected'],
                                datasets: [{
                                    data: [
                                        this.stats.newApplications,
                                        this.stats.acceptedApplications,
                                        this.stats.rejectedApplications
                                    ],
                                    backgroundColor: [
                                        'rgb(59, 130, 246)',
                                        'rgb(34, 197, 94)',
                                        'rgb(239, 68, 68)'
                                    ]
                                }]
                            }
                        }
                    );
                },

                async refreshData() {
                    try {
                        const response = await fetch('/api/analytics/dashboard');
                        const data = await response.json();
                        this.stats = data;
                        this.updateCharts();
                    } catch (error) {
                        console.error('Failed to refresh data:', error);
                    }
                },

                updateCharts() {
                    this.charts.status.data.datasets[0].data = [
                        this.stats.newApplications,
                        this.stats.acceptedApplications,
                        this.stats.rejectedApplications
                    ];
                    this.charts.status.update();
                }
            }
        }
    </script>
    @endpush
</x-app-layout>

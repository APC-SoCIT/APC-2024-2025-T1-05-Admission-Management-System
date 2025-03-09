@extends('application')

@section('content')
<div class="py-6" x-data="analyticsData()" x-init="initData()">
    <!-- Add this after the title -->
    <div class="max-w-7xl mx-auto px-4 mb-6">
        <div class="flex justify-end space-x-4">
            <button
                @click="exportData('excel')"
                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md transition-colors duration-150">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export Excel
            </button>

            <button
                @click="exportData('pdf')"
                class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md transition-colors duration-150">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export PDF
            </button>
        </div>

        <!-- Filter Controls -->
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Date Range Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Date Range</label>
                    <select x-model="filters.dateRange" class="mt-1 block w-full rounded-md border-gray-300">
                        <option value="all">All Time</option>
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                        <option value="custom">Custom Range</option>
                    </select>

                    <!-- Custom Date Range Picker (shown only when custom is selected) -->
                    <div x-show="showDatePicker" class="mt-3 grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input
                                type="date"
                                x-model="filters.startDate"
                                class="mt-1 block w-full rounded-md border-gray-300"
                                @change="fetchAnalytics()">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">End Date</label>
                            <input
                                type="date"
                                x-model="filters.endDate"
                                class="mt-1 block w-full rounded-md border-gray-300"
                                @change="fetchAnalytics()">
                        </div>
                    </div>
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Application Status</label>
                    <select x-model="filters.status" class="mt-1 block w-full rounded-md border-gray-300">
                        <option value="all">All Status</option>
                        <option value="new">New</option>
                        <option value="accepted">Accepted</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>

                <!-- Category Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Category</label>
                    <select x-model="filters.category" class="mt-1 block w-full rounded-md border-gray-300">
                        <option value="all">All Categories</option>
                        <option value="admissions">Admissions</option>
                        <option value="inquiries">Inquiries</option>
                        <option value="scholarships">Scholarships</option>
                    </select>
                </div>
            </div>
        </div>

        <div x-show="isLoading" class="flex justify-center items-center h-12 mt-4">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            <span class="ml-3 text-gray-600">Loading data...</span>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="max-w-7xl mx-auto px-4">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Admissions Card -->
            <div class="bg-white rounded-lg shadow-sm p-6 transition duration-300 hover:shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Admissions</h3>
                    <i class="fas fa-user-graduate text-blue-500"></i>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-yellow-600" x-text="stats.newApplications">0</div>
                        <div class="text-sm text-gray-600">New</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600" x-text="stats.acceptedApplications">0</div>
                        <div class="text-sm text-gray-600">Accepted</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-red-600" x-text="stats.rejectedApplications">0</div>
                        <div class="text-sm text-gray-600">Rejected</div>
                    </div>
                </div>
            </div>

            <!-- Inquiries Card -->
            <div class="bg-white rounded-lg shadow-sm p-6 transition duration-300 hover:shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Inquiries</h3>
                    <i class="fas fa-question-circle text-purple-500"></i>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-600" x-text="stats.newInquiries">0</div>
                        <div class="text-sm text-gray-600">New</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-600" x-text="stats.resolvedInquiries">0</div>
                        <div class="text-sm text-gray-600">Resolved</div>
                    </div>
                </div>
            </div>

            <!-- Scholarships Card -->
            <div class="bg-white rounded-lg shadow-sm p-6 transition duration-300 hover:shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Scholarships</h3>
                    <i class="fas fa-graduation-cap text-yellow-500"></i>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-yellow-600" x-text="stats.totalScholarships">0</div>
                        <div class="text-sm text-gray-600">Total</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-yellow-600" x-text="stats.approvedScholarships">0</div>
                        <div class="text-sm text-gray-600">Approved</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Applications Trend Chart -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Applications Trend</h3>
                <div class="h-64">
                    <canvas id="admissionsChart"></canvas>
                </div>
            </div>

            <!-- Application Status Chart -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Application Status</h3>
                <div class="h-64">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Last Updated -->
        <div class="mt-4 text-right text-sm text-gray-600">
            Last updated: <span x-text="stats.lastUpdated || 'Loading...'">-</span>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function analyticsData() {
        return {
            filters: {
                dateRange: 'all',
                status: 'all',
                category: 'all',
                startDate: null,
                endDate: null
            },
            stats: {
                newApplications: 0,
                acceptedApplications: 0,
                rejectedApplications: 0,
                newInquiries: 0,
                resolvedInquiries: 0,
                totalScholarships: 0,
                approvedScholarships: 0,
                monthlyTrend: {
                    labels: [],
                    data: []
                },
                lastUpdated: ''
            },
            charts: {
                admissions: null,
                status: null
            },
            isLoading: false,
            showDatePicker: false,

            initData() {
                this.fetchAnalytics();
                this.initCharts();

                // Watch for filter changes
                this.$watch('filters', () => {
                    this.fetchAnalytics();
                }, { deep: true });
            },

            fetchAnalytics() {
                this.isLoading = true;

                // Show date picker for custom range
                if (this.filters.dateRange === 'custom') {
                    this.showDatePicker = true;
                    // Only proceed if both dates are selected
                    if (!this.filters.startDate || !this.filters.endDate) {
                        return;
                    }
                } else {
                    this.showDatePicker = false;
                }

                fetch(`/dashboard/analytics?${new URLSearchParams(this.filters).toString()}`)
                    .then(response => response.json())
                    .then(data => {
                        this.stats.newApplications = data.admissions.new;
                        this.stats.acceptedApplications = data.admissions.accepted;
                        this.stats.rejectedApplications = data.admissions.rejected;
                        this.stats.newInquiries = data.inquiries.new;
                        this.stats.resolvedInquiries = data.inquiries.resolved;
                        this.stats.totalScholarships = data.scholarships.total;
                        this.stats.approvedScholarships = data.scholarships.approved;
                        this.stats.monthlyTrend = data.monthlyTrend;
                        this.stats.lastUpdated = data.lastUpdated;

                        this.updateCharts();
                        this.isLoading = false;
                    })
                    .catch(error => {
                        console.error('Error fetching analytics:', error);
                        this.isLoading = false;
                    });
            },

            initCharts() {
                this.charts.admissions = new Chart(
                    document.getElementById('admissionsChart'),
                    {
                        type: 'line',
                        data: {
                            labels: this.stats.monthlyTrend.labels,
                            datasets: [{
                                label: 'Applications',
                                data: this.stats.monthlyTrend.data,
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
                                    'rgb(234, 179, 8)',
                                    'rgb(34, 197, 94)',
                                    'rgb(239, 68, 68)'
                                ]
                            }]
                        }
                    }
                );
            },
            updateCharts() {
                if (this.charts.admissions) {
                    this.charts.admissions.data.labels = this.stats.monthlyTrend.labels;
                    this.charts.admissions.data.datasets[0].data = this.stats.monthlyTrend.data;
                    this.charts.admissions.update();
                }

                if (this.charts.status) {
                    this.charts.status.data.datasets[0].data = [
                        this.stats.newApplications,
                        this.stats.acceptedApplications,
                        this.stats.rejectedApplications
                    ];
                    this.charts.status.update();
                }
            },
            exportData(format) {
                const filterParams = new URLSearchParams({
                    ...this.filters,
                    format: format
                }).toString();

                window.location.href = `{{ route('dashboard.export') }}?${filterParams}`;
            }
        }
    }
</script>
@endpush
@endsection

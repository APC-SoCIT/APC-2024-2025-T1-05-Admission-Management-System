@extends('application')

@section('content')
<div class="py-6" x-data="analyticsData()" x-init="initData()">
    <!-- Add this after the title -->
    <div class="max-w-7xl mx-auto px-4 mb-6">
        <div class="flex justify-end space-x-4">
            <button
                @click="window.location.href='{{ route('dashboard.export', ['format' => 'excel']) }}'"
                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md transition-colors duration-150">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export Excel
            </button>

            <button
                @click="window.location.href='{{ route('dashboard.export', ['format' => 'pdf']) }}'"
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
            Last updated: <span x-text="formatDateTime(stats.lastUpdated)">-</span>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function analyticsData() {
        return {
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
                lastUpdated: null
            },
            charts: {
                admissions: null,
                status: null
            },
            filters: {
                dateRange: 'all',
                status: 'all',
                category: 'all'
            },
            async initData() {
                await this.refreshData();
                this.initCharts();
                // Set up periodic refresh every 30 seconds
                setInterval(() => this.refreshData(), 30000);
            },
            async refreshData() {
                try {
                    const response = await fetch('/dashboard/analytics');
                    const data = await response.json();

                    // Update stats
                    this.stats = {
                        newApplications: data.admissions.new,
                        acceptedApplications: data.admissions.accepted,
                        rejectedApplications: data.admissions.rejected,
                        newInquiries: data.inquiries.new,
                        resolvedInquiries: data.inquiries.resolved,
                        totalScholarships: data.scholarships.total,
                        approvedScholarships: data.scholarships.approved,
                        monthlyTrend: data.monthlyTrend,
                        lastUpdated: data.lastUpdated
                    };

                    if (this.charts.admissions || this.charts.status) {
                        this.updateCharts();
                    }
                } catch (error) {
                    console.error('Failed to refresh data:', error);
                }
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
            formatDateTime(dateString) {
                if (!dateString) return '-';

                try {
                    // Parse the date string and ensure it's treated as Manila/Singapore time
                    const date = new Date(dateString + ' GMT+0800');

                    // Format the date
                    const options = {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        hour12: true
                    };

                    return date.toLocaleString('en-US', options);
                } catch (error) {
                    console.error('Date formatting error:', error);
                    return dateString; // Return the original string if parsing fails
                }
            }
        }
    }
</script>
@endpush
@endsection

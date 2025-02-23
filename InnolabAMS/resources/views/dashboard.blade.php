@extends('application')

@section('content')
<div class="py-12" x-data="analyticsData()">
    <!-- Statistics Cards -->
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Admissions Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Admissions</h3>
                <div class="grid grid-cols-3 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold" x-text="stats.newApplications">0</div>
                        <div class="text-sm text-gray-600">New</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold" x-text="stats.acceptedApplications">0</div>
                        <div class="text-sm text-gray-600">Accepted</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold" x-text="stats.rejectedApplications">0</div>
                        <div class="text-sm text-gray-600">Rejected</div>
                    </div>
                </div>
            </div>

            <!-- Inquiries Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Inquiries</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold" x-text="stats.newInquiries">0</div>
                        <div class="text-sm text-gray-600">New</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold" x-text="stats.resolvedInquiries">0</div>
                        <div class="text-sm text-gray-600">Resolved</div>
                    </div>
                </div>
            </div>

            <!-- Scholarships Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Scholarships</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold" x-text="stats.scholarshipApplications">0</div>
                        <div class="text-sm text-gray-600">Total</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold" x-text="stats.approvedScholarships">0</div>
                        <div class="text-sm text-gray-600">Approved</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Applications Trend Chart -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Applications Trend</h3>
                <canvas id="admissionsChart"></canvas>
            </div>

            <!-- Application Status Chart -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Application Status</h3>
                <canvas id="statusChart"></canvas>
            </div>
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
                scholarshipApplications: 0,
                approvedScholarships: 0,
                monthlyTrend: {
                    labels: [],
                    data: []
                }
            },
            charts: {},

            init() {
                this.refreshData();
                this.initCharts();
                // Refresh data every 5 minutes
                setInterval(() => this.refreshData(), 300000);
            },

            async refreshData() {
                try {
                    const response = await fetch('/dashboard/analytics');
                    const data = await response.json();
                    this.stats = data;
                    this.updateCharts();
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
                                    'rgb(59, 130, 246)',
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
            }
        }
    }
</script>
@endpush
@endsection

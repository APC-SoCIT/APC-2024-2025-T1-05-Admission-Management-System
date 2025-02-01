<div wire:ignore x-data="{
    chart: null,
    init() {
        const labels = {{ Js::from($chartData['labels'] ?? []) }};
        const applications = {{ Js::from($chartData['applications'] ?? []) }};
        const expected = {{ Js::from($chartData['expected'] ?? []) }};
        const colors = {{ Js::from($chartData['colors'] ?? [
            'applications' => [
                'border' => '#4F46E5',
                'background' => '#4F46E5'
            ],
            'expected' => [
                'border' => '#9333EA',
                'background' => '#9333EA'
            ]
        ]) }};

        this.chart = new Chart(this.$refs.canvas.getContext('2d'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Applications',
                        data: applications,
                        borderColor: colors.applications.border,
                        backgroundColor: colors.applications.background,
                        tension: 0.4,
                        borderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    },
                    {
                        label: 'Expected',
                        data: expected,
                        borderColor: colors.expected.border,
                        backgroundColor: colors.expected.background,
                        tension: 0.4,
                        borderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: '#E2E8F0'
                        },
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.raw.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    }
}">
    <canvas x-ref="canvas" class="w-full h-full"></canvas>
</div>

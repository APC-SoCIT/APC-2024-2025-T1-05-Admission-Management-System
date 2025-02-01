<div wire:ignore x-data="{
    chart: null,
    init() {
        const labels = @json($chartData['labels'] ?? []);
        const accepted = @json($chartData['accepted'] ?? []);
        const rejected = @json($chartData['rejected'] ?? []);
        const colors = @json($chartData['colors'] ?? []);

        this.chart = new Chart(this.$refs.canvas.getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Accepted',
                        data: accepted,
                        backgroundColor: colors.accepted,
                        borderRadius: 4,
                        borderSkipped: false,
                        barPercentage: 0.6
                    },
                    {
                        label: 'Rejected',
                        data: rejected,
                        backgroundColor: colors.rejected,
                        borderRadius: 4,
                        borderSkipped: false,
                        barPercentage: 0.6
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

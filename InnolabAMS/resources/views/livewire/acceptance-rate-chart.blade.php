<div wire:ignore x-data="{
    chart: null,
    init() {
        const labels = @json($chartData['labels'] ?? []);
        const accepted = @json($chartData['accepted'] ?? []);
        const rejected = @json($chartData['rejected'] ?? []);

        this.chart = new Chart(this.$refs.canvas.getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Accepted',
                        data: accepted,
                        backgroundColor: '#10B981',
                    },
                    {
                        label: 'Rejected',
                        data: rejected,
                        backgroundColor: '#EF4444',
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: '#E2E8F0'
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
                        position: 'bottom'
                    }
                }
            }
        });
    }
}">
    <canvas x-ref="canvas" class="w-full h-full"></canvas>
</div>

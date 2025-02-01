<div wire:ignore x-data="{
    chart: null,
    init() {
        const labels = @json($chartData['labels'] ?? []);
        const applications = @json($chartData['applications'] ?? []);
        const expected = @json($chartData['expected'] ?? []);

        this.chart = new Chart(this.$refs.canvas.getContext('2d'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Applications',
                        data: applications,
                        borderColor: '#94A3B8',
                        backgroundColor: '#94A3B8',
                        tension: 0.4
                    },
                    {
                        label: 'Expected',
                        data: expected,
                        borderColor: '#1E40AF',
                        backgroundColor: '#1E40AF',
                        tension: 0.4
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

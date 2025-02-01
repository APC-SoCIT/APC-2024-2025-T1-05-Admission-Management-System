<div wire:ignore x-data="{
    chart: null,
    init() {
        const labels = @json($chartData['labels'] ?? []);
        const accepted = @json($chartData['accepted'] ?? []);
        const rejected = @json($chartData['rejected'] ?? []);
        const defaultColors = {
            accepted: '#22C55E',
            rejected: '#EF4444'
        };
        const colors = {
            accepted: @json($chartData['colors']['accepted'] ?? '#22C55E'),
            rejected: @json($chartData['colors']['rejected'] ?? '#EF4444')
        };

        // Calculate total for percentages
        const total = accepted.reduce((a, b) => a + b, 0) + rejected.reduce((a, b) => a + b, 0);
        const acceptedPercentage = ((accepted.reduce((a, b) => a + b, 0) / total) * 100).toFixed(1);
        const rejectedPercentage = ((rejected.reduce((a, b) => a + b, 0) / total) * 100).toFixed(1);

        this.chart = new Chart(this.$refs.canvas.getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Accepted', 'Rejected'],
                datasets: [{
                    data: [acceptedPercentage, rejectedPercentage],
                    backgroundColor: [colors.accepted, colors.rejected],
                    borderWidth: 0,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
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
                                return context.label + ': ' + context.raw + '%';
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

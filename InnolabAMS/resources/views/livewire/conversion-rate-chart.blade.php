<div wire:ignore x-data="{
    chart: null,
    init() {
        const labels = @json($chartData['labels'] ?? []);
        const data = @json($chartData['data'] ?? []);
        const colors = @json($chartData['colors'] ?? []);

        this.chart = new Chart(this.$refs.canvas.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colors,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.raw + '%';
                            }
                        }
                    }
                },
                cutout: '65%'
            }
        });
    }
}">
    <canvas x-ref="canvas" class="w-full h-full"></canvas>
</div>

<div wire:ignore x-data="{
    chart: null,
    init() {
        const labels = @json($chartData['labels'] ?? []);
        const data = @json($chartData['data'] ?? []);
        const colors = @json($chartData['colors'] ?? ['#4F46E5', '#E5E7EB']);
        const hoverColors = @json($chartData['hoverColors'] ?? ['#4338CA', '#D1D5DB']);

        this.chart = new Chart(this.$refs.canvas.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colors,
                    hoverBackgroundColor: hoverColors,
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
                                return context.label + ': ' + context.raw.toFixed(1) + '%';
                            }
                        }
                    }
                },
                cutout: '75%',
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
    }
}">
    <canvas x-ref="canvas" class="w-full h-full"></canvas>
</div>

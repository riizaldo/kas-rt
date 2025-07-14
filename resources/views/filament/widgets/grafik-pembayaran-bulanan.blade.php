<!-- <x-filament::widget>
    <x-filament::card>
        {{-- Filter Form --}}
        <form wire:submit.prevent>
            {{ $this->form }}
        </form>

        {{-- Chart Canvas --}}
        <div style="position: relative; height: 350px;">
            <canvas id="grafikPembayaran"></canvas>
        </div>
    </x-filament::card>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Tunggu DOM siap
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('grafikPembayaran').getContext('2d');

            if (window.grafikPembayaranChart) {
                window.grafikPembayaranChart.destroy();
            }
            window.grafikPembayaranChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Total Pembayaran',
                        data: @json($data),
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-filament::widget> -->
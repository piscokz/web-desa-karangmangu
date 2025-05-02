{{-- resources/views/sections/age-range.blade.php --}}
<section id="rentang-umur" class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-green-800 mb-8 text-center">Rentang Umur</h2>
        <div class="bg-white p-6 rounded-2xl shadow">
            <canvas id="ageRangeChart" class="w-full" style="height:24rem;"></canvas>
        </div>
    </div>
</section>

@push('scripts')
    <!-- Chart.js & DataLabels -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // dummy labels & data
            const ageLabels = ['0–4', '5–9', '10–14', '15–19', '20–24', '25–29', '30–34', '35–39', '40–44', '45–49',
                '50–54', '55–59', '60–64', '65–69', '70–74', '75–79', '80–84', '85+'
            ];
            const maleCount = [21, 79, 54, 37, 52, 42, 31, 30, 16, 10, 7, 5, 4, 2, 1, 1, 0, 0];
            const femaleCount = [24, 53, 52, 54, 57, 43, 29, 35, 19, 6, 5, 8, 5, 2, 1, 1, 0, 0];

            // prepare negated male data
            const maleData = maleCount.map(v => -v);

            const ctx = document.getElementById('ageRangeChart').getContext('2d');
            Chart.register(ChartDataLabels);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ageLabels,
                    datasets: [{
                            label: 'Laki-Laki',
                            data: maleData,
                            backgroundColor: '#22C55E',
                            xAxisID: 'xLeft',
                            datalabels: {
                                anchor: 'end',
                                align: 'start',
                                formatter: v => Math.abs(v)
                            }
                        },
                        {
                            label: 'Perempuan',
                            data: femaleCount,
                            backgroundColor: '#EC4899',
                            xAxisID: 'xRight',
                            datalabels: {
                                anchor: 'start',
                                align: 'end',
                                formatter: v => v
                            }
                        }
                    ]
                },
                options: {
                    indexAxis: 'y',
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    },
                    scales: {
                        xLeft: {
                            position: 'left',
                            stacked: true,
                            grid: {
                                drawOnChartArea: false
                            },
                            min: -100,
                            max: 100,
                            ticks: {
                                callback: v => Math.abs(v),
                                color: '#374151'
                            }
                        },
                        xRight: {
                            position: 'right',
                            stacked: true,
                            grid: {
                                drawOnChartArea: false
                            },
                            ticks: {
                                color: '#374151'
                            }
                        },
                        y: {
                            stacked: true,
                            ticks: {
                                color: '#374151'
                            }
                        }
                    },
                    plugins: {
                        datalabels: {
                            color: '#374151',
                            font: {
                                weight: '600'
                            }
                        },
                        legend: {
                            position: 'top',
                            labels: {
                                color: '#374151',
                                usePointStyle: true
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: ctx => `${ctx.dataset.label}: ${Math.abs(ctx.raw)}`
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });
        });
    </script>
@endpush
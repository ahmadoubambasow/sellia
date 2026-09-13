@props([
    'data',
])

<section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

    <div class="border-b border-slate-100 px-5 py-4">
        <h3 class="font-semibold text-slate-900">
            Évolution du chiffre d'affaires
        </h3>

        <p class="mt-1 text-sm text-slate-500">
            Chiffre d'affaires réalisé au cours des 7 derniers jours.
        </p>
    </div>

    <div class="p-5">
        <div class="h-72">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const data = @js(
            $data->map(fn ($day) => [
                'label' => $day['label'],
                'revenue' => $day['revenue'],
            ])->values()
        );

        const canvas = document.getElementById('revenueChart');

        if (!canvas) {
            return;
        }

        new Chart(canvas, {
            type: 'line',

            data: {
                labels: data.map(item => item.label),

                datasets: [{
                    label: 'Chiffre d’affaires',
                    data: data.map(item => item.revenue),

                    borderWidth: 3,
                    tension: 0.35,
                    fill: true,

                    pointRadius: 4,
                    pointHoverRadius: 6,
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false,
                    },

                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return new Intl.NumberFormat('fr-FR')
                                    .format(context.raw) + ' FCFA';
                            }
                        }
                    }
                },

                scales: {
                    y: {
                        beginAtZero: true,

                        ticks: {
                            callback: function (value) {
                                return new Intl.NumberFormat('fr-FR')
                                    .format(value) + ' F';
                            }
                        },

                        grid: {
                            color: '#e2e8f0',
                        }
                    },

                    x: {
                        grid: {
                            display: false,
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
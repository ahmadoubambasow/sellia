@props([
    'products',
])

<section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

    <div class="border-b border-slate-100 px-5 py-4">
        <h3 class="font-semibold text-slate-900">
            Produits les plus vendus
        </h3>

        <p class="mt-1 text-sm text-slate-500">
            Les produits ayant généré le plus de ventes.
        </p>
    </div>

    <div class="p-5">
        <div class="h-72">
            <canvas id="topProductsChart"></canvas>
        </div>
    </div>

</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const products = @js(
            $products->map(fn ($product) => [
                'name' => $product->name,
                'quantity' => (int) ($product->sold_quantity ?? 0),
            ])->values()
        );

        const canvas = document.getElementById('topProductsChart');

        if (!canvas) {
            return;
        }

        new Chart(canvas, {
            type: 'bar',

            data: {
                labels: products.map(product => product.name),

                datasets: [{
                    label: 'Quantité vendue',
                    data: products.map(product => product.quantity),

                    borderWidth: 1,
                    borderRadius: 6,
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
                                return context.raw + ' unité(s)';
                            }
                        }
                    }
                },

                scales: {
                    y: {
                        beginAtZero: true,

                        ticks: {
                            precision: 0,
                        },

                        grid: {
                            color: '#e2e8f0',
                        }
                    },

                    x: {
                        grid: {
                            display: false,
                        },

                        ticks: {
                            maxRotation: 0,
                            minRotation: 0,
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
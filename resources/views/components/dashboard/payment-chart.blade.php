@props([
    'summary',
])

<section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

    <div class="border-b border-slate-100 px-5 py-4">
        <h3 class="font-semibold text-slate-900">
            Situation des paiements
        </h3>

        <p class="mt-1 text-sm text-slate-500">
            Répartition des ventes selon leur état de paiement.
        </p>
    </div>

    <div class="flex items-center justify-center p-5">
        <div class="h-72 w-full max-w-sm">
            <canvas id="paymentChart"></canvas>
        </div>
    </div>

</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const paymentData = {
            paid: @js($summary['paid_sales']),
            partial: @js($summary['partial_sales']),
            unpaid: @js($summary['unpaid_sales']),
        };

        const canvas = document.getElementById('paymentChart');

        if (!canvas) {
            return;
        }

        new Chart(canvas, {
            type: 'doughnut',

            data: {
                labels: [
                    'Payées',
                    'Partiellement payées',
                    'Impayées',
                ],

                datasets: [{
                    data: [
                        paymentData.paid,
                        paymentData.partial,
                        paymentData.unpaid,
                    ],

                    borderWidth: 2,
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                cutout: '68%',

                plugins: {
                    legend: {
                        position: 'bottom',

                        labels: {
                            padding: 20,
                        }
                    },

                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return context.label + ' : ' + context.raw;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="text-xl font-bold tracking-tight text-slate-900">
                    Ventes
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Consultez et suivez les ventes enregistrées dans votre boutique.
                </p>
            </div>

            <a
                href="{{ route('sales.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-sellia-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-sellia-800 focus:outline-none focus:ring-2 focus:ring-sellia-500 focus:ring-offset-2"
            >
                <svg
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 4v16m8-8H4"
                    />
                </svg>

                Nouvelle vente
            </a>

        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50">

        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

            {{-- Statistiques --}}
           

            <div class="mb-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

                {{-- Nombre de ventes --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Total des ventes
                            </p>

                            <p class="mt-2 text-2xl font-bold tracking-tight text-slate-900">
                                {{ $summary['total_sales'] }}
                            </p>
                        </div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-sellia-50 text-sellia-700">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 14l2 2 4-4m5-3V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-3"
                                />
                            </svg>
                        </div>

                    </div>
                </div>

                {{-- Chiffre d'affaires --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Chiffre d'affaires
                            </p>

                            <p class="mt-2 text-2xl font-bold tracking-tight text-slate-900">
                                {{ number_format($summary['total_revenue'], 0, ',', ' ') }}
                                <span class="text-sm font-semibold text-slate-400">
                                    F
                                </span>
                            </p>
                        </div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-accent-500/10 text-accent-600">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V6m0 12v-2m0 2c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>

                    </div>
                </div>

                {{-- Ventes payées --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Ventes payées
                            </p>

                            <p class="mt-2 text-2xl font-bold tracking-tight text-slate-900">
                                {{ $summary['paid_sales'] }}
                            </p>
                        </div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                        </div>

                    </div>
                </div>

                {{-- Ventes impayées --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Ventes impayées
                            </p>

                            <p class="mt-2 text-2xl font-bold tracking-tight text-slate-900">
                                {{ $summary['unpaid_sales'] }}
                            </p>
                        </div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>

                    </div>
                </div>

                {{-- Paiements partiels --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Paiements partiels
                            </p>

                            <p class="mt-2 text-2xl font-bold text-slate-900">
                                {{ $summary['partial_sales'] }}
                            </p>
                        </div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>

                    </div>

                </div>

                {{-- Ventes annulées --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Ventes annulées
                            </p>

                            <p class="mt-2 text-2xl font-bold text-slate-900">
                                {{ $summary['cancelled_sales'] }}
                            </p>
                        </div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-50 text-red-600">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </div>

                    </div>

                </div>

                {{-- Reste à encaisser --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Reste à encaisser
                            </p>

                            <p class="mt-2 text-2xl font-bold text-amber-600">
                                {{ number_format($summary['total_remaining'], 0, ',', ' ') }}
                                FCFA
                            </p>
                        </div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 8c-1.657 0-3 1.12-3 2.5S10.343 13 12 13s3 1.12 3 2.5S13.657 18 12 18m0-10V6m0 12v-2m0 2a9 9 0 100-18 9 9 0 000 18z"
                                />
                            </svg>
                        </div>

                    </div>

                </div>

            </div>

            {{-- Liste --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-6 py-5">

                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                        <div>
                            <h3 class="font-semibold text-slate-900">
                                Historique des ventes
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Les ventes les plus récentes apparaissent en premier.
                            </p>
                        </div>

                        <div class="text-sm text-slate-400">
                            {{ $summary ['total_sales'] }}
                            {{ $summary ['total_sales'] > 1 ? 'ventes' : 'vente' }}
                        </div>

                    </div>

                </div>

                @if($sales->isEmpty())

                    {{-- État vide --}}
                    <div class="px-6 py-16 text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                            <svg
                                class="h-8 w-8"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 14l2 2 4-4m5-3V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-3"
                                />
                            </svg>
                        </div>

                        <h3 class="mt-5 text-base font-semibold text-slate-900">
                            Aucune vente enregistrée
                        </h3>

                        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                            Commencez à enregistrer vos ventes pour suivre votre activité commerciale.
                        </p>

                        <a
                            href="{{ route('sales.create') }}"
                            class="mt-6 inline-flex items-center gap-2 rounded-xl bg-sellia-700 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-sellia-800"
                        >
                            <svg
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 4v16m8-8H4"
                                />
                            </svg>

                            Enregistrer une vente
                        </a>

                    </div>

                @else

                    {{-- Desktop --}}
                    <div class="hidden overflow-x-auto md:block">

                        <table class="min-w-full divide-y divide-slate-100">

                            <thead class="bg-slate-50">
                                <tr>

                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Vente
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Client
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Produits
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Montant
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Paiement
                                    </th>

                                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Statut
                                    </th>

                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100 bg-white">

                                @foreach($sales as $sale)

                                    <tr class="transition hover:bg-slate-50">

                                        {{-- Référence --}}
                                        <td class="whitespace-nowrap px-6 py-5">

                                            <div>
                                                <a
                                                    href="{{ route('sales.show', $sale) }}"
                                                    class="group inline-block"
                                                >
                                                    <span class="block font-semibold text-sellia-700 transition group-hover:text-sellia-500">
                                                        {{ $sale->reference }}
                                                    </span>

                                                    <span class="mt-1 block text-xs text-slate-400 transition group-hover:text-slate-500">
                                                        Voir le détail
                                                    </span>
                                                </a>

                                                <p class="mt-1 text-xs text-slate-400">
                                                    {{ $sale->sold_at?->format('d/m/Y à H:i') }}
                                                </p>
                                            </div>

                                        </td>

                                        {{-- Client --}}
                                        <td class="px-6 py-5">

                                            @if($sale->customer)

                                                <div class="flex items-center gap-3">

                                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-sellia-50 text-xs font-bold text-sellia-700">
                                                        {{ strtoupper(substr($sale->customer->name, 0, 1)) }}
                                                    </div>

                                                    <div class="min-w-0">

                                                        <p class="truncate text-sm font-medium text-slate-800">
                                                            {{ $sale->customer->name }}
                                                        </p>

                                                        @if($sale->customer->phone)
                                                            <p class="mt-0.5 text-xs text-slate-400">
                                                                {{ $sale->customer->phone }}
                                                            </p>
                                                        @endif

                                                    </div>

                                                </div>

                                            @else

                                                <span class="text-sm text-slate-400">
                                                    Client comptoir
                                                </span>

                                            @endif

                                        </td>

                                        {{-- Produits --}}
                                        <td class="px-6 py-5">

                                            <div class="space-y-1">

                                                @foreach($sale->items->take(2) as $item)

                                                    <p class="text-sm text-slate-700">
                                                        <span class="font-medium">
                                                            {{ $item->quantity }}×
                                                        </span>

                                                        {{ $item->product->name }}
                                                    </p>

                                                @endforeach

                                                @if($sale->items->count() > 2)

                                                    <p class="text-xs font-medium text-slate-400">
                                                        + {{ $sale->items->count() - 2 }}
                                                        autre{{ $sale->items->count() - 2 > 1 ? 's' : '' }}
                                                    </p>

                                                @endif

                                            </div>

                                        </td>

                                        {{-- Montant --}}
                                        <td class="whitespace-nowrap px-6 py-5">

                                            <p class="text-sm font-bold text-slate-900">
                                                {{ number_format($sale->total, 0, ',', ' ') }}
                                                <span class="text-xs font-medium text-slate-400">
                                                    F
                                                </span>
                                            </p>

                                            @if($sale->discount > 0)

                                                <p class="mt-1 text-xs text-slate-400">
                                                    Remise :
                                                    {{ number_format($sale->discount, 0, ',', ' ') }} F
                                                </p>

                                            @endif

                                        </td>

                                        {{-- Paiement --}}
                                        <td class="whitespace-nowrap px-6 py-5">

                                            @switch($sale->payment_status)

                                                @case('paid')
                                                    <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                                        Payée
                                                    </span>
                                                    @break

                                                @case('partial')
                                                    <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                                        Partiellement payée
                                                    </span>
                                                    @break

                                                @default
                                                    <span class="inline-flex items-center rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">
                                                        Impayée
                                                    </span>

                                            @endswitch

                                        </td>

                                        {{-- Statut --}}
                                        <td class="whitespace-nowrap px-6 py-5 text-right">

                                            @if($sale->status === 'completed')

                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">

                                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                                    Terminée
                                                </span>

                                            @else

                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">

                                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>

                                                    Annulée
                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    {{-- Mobile --}}
                    <div class="divide-y divide-slate-100 md:hidden">

                        @foreach($sales as $sale)

                            <div class="p-5">

                                <div class="flex items-start justify-between gap-4">

                                    <div class="min-w-0">

                                        <a
                                            href="{{ route('sales.show', $sale) }}"
                                            class="group inline-block"
                                        >
                                            <span class="block font-semibold text-sellia-700 transition group-hover:text-sellia-500">
                                                {{ $sale->reference }}
                                            </span>

                                            <span class="mt-1 block text-xs text-slate-400 transition group-hover:text-slate-500">
                                                Voir le détail
                                            </span>
                                        </a>

                                        <p class="mt-1 text-xs text-slate-400">
                                            {{ $sale->sold_at?->format('d/m/Y à H:i') }}
                                        </p>

                                    </div>

                                    <p class="whitespace-nowrap text-sm font-bold text-slate-900">
                                        {{ number_format($sale->total, 0, ',', ' ') }} F
                                    </p>

                                </div>

                                <div class="mt-4 flex items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-sellia-50 text-xs font-bold text-sellia-700">

                                        @if($sale->customer)
                                            {{ strtoupper(substr($sale->customer->name, 0, 1)) }}
                                        @else
                                            C
                                        @endif

                                    </div>

                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-medium text-slate-700">

                                            @if($sale->customer)
                                                {{ $sale->customer->name }}
                                            @else
                                                Client comptoir
                                            @endif

                                        </p>

                                        <p class="text-xs text-slate-400">
                                            {{ $sale->items->count() }}
                                            {{ $sale->items->count() > 1 ? 'produits' : 'produit' }}
                                        </p>

                                    </div>

                                </div>

                                <div class="mt-4 space-y-1">

                                    @foreach($sale->items->take(3) as $item)

                                        <p class="text-sm text-slate-600">
                                            <span class="font-semibold">
                                                {{ $item->quantity }}×
                                            </span>

                                            {{ $item->product->name }}
                                        </p>

                                    @endforeach

                                    @if($sale->items->count() > 3)

                                        <p class="text-xs font-medium text-slate-400">
                                            + {{ $sale->items->count() - 3 }} autre{{ $sale->items->count() - 3 > 1 ? 's' : '' }}
                                        </p>

                                    @endif

                                </div>

                                <div class="mt-4 flex flex-wrap items-center gap-2">

                                    @switch($sale->payment_status)

                                        @case('paid')
                                            <span class="inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                                Payée
                                            </span>
                                            @break

                                        @case('partial')
                                            <span class="inline-flex rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                                Partiellement payée
                                            </span>
                                            @break

                                        @default
                                            <span class="inline-flex rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">
                                                Impayée
                                            </span>

                                    @endswitch

                                    @if($sale->status === 'completed')

                                        <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                                            Terminée
                                        </span>

                                    @else

                                        <span class="inline-flex rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">
                                            Annulée
                                        </span>

                                    @endif

                                </div>

                            </div>

                        @endforeach

                    </div>

                @endif

            </section>

        </div>

    </div>

</x-app-layout>

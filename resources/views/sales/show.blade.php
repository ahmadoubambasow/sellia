<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <div class="flex items-center gap-3">

                    <a
                        href="{{ route('sales.index') }}"
                        class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:bg-slate-50 hover:text-slate-700"
                        aria-label="Retour aux ventes"
                    >
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
                                d="M15 19l-7-7 7-7"
                            />
                        </svg>
                    </a>

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Détail de la vente
                        </p>

                        <h2 class="mt-1 text-xl font-bold text-slate-900">
                            {{ $sale->reference }}
                        </h2>
                    </div>

                </div>
            </div>

            <div class="flex items-center gap-2">

                @if($sale->status === 'completed')
                    <x-cancel-sale-dialog
                        :action="route('sales.cancel', $sale)"
                    />
                @endif
                <a
                    href="{{ route('sales.index') }}"
                    class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50"
                >
                    Retour aux ventes
                </a>

            </div>

        </div>

    </x-slot>

    <div class="min-h-screen bg-slate-50">

        <div class="mx-auto max-w-6xl space-y-6 px-4 py-8 sm:px-6 lg:px-8">

            {{-- Informations générales --}}
            <div class="grid gap-6 lg:grid-cols-3">

                {{-- Référence --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Référence
                            </p>

                            <p class="mt-2 text-lg font-bold text-slate-900">
                                {{ $sale->reference }}
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
                                    d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.087.88-1.968 1.968-1.968h10.064A1.968 1.968 0 0120 4.757z"
                                />
                            </svg>

                        </div>

                    </div>

                    <p class="mt-4 text-sm text-slate-500">
                        {{ $sale->sold_at->format('d/m/Y à H:i') }}
                    </p>

                </div>

                {{-- Client --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Client
                    </p>

                    <div class="mt-3 flex items-center gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-slate-100 text-sm font-bold text-slate-600">
                            {{ strtoupper(substr($sale->customer?->name ?? 'C', 0, 1)) }}
                        </div>

                        <div class="min-w-0">

                            <p class="truncate font-semibold text-slate-900">
                                {{ $sale->customer?->name ?? 'Client de passage' }}
                            </p>

                            @if($sale->customer?->phone)
                                <p class="mt-1 text-sm text-slate-500">
                                    {{ $sale->customer->phone }}
                                </p>
                            @endif

                        </div>

                    </div>

                </div>

                {{-- Vendeur --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Vendeur
                    </p>

                    <div class="mt-3 flex items-center gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-sellia-50 text-sm font-bold text-sellia-700">
                            {{ strtoupper(substr($sale->user->name, 0, 1)) }}
                        </div>

                        <div>
                            <p class="font-semibold text-slate-900">
                                {{ $sale->user->name }}
                            </p>

                            <p class="mt-1 text-sm text-slate-500">
                                Vente enregistrée
                            </p>
                        </div>

                    </div>

                </div>

            </div>

            {{-- Statuts --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h3 class="text-base font-bold text-slate-900">
                            État de la vente
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Situation actuelle de la vente et du paiement.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2">

                        @if($sale->status === 'completed')

                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                                Vente terminée
                            </span>

                        @else

                            <span class="inline-flex items-center rounded-full bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700">
                                Vente annulée
                            </span>

                        @endif

                        @if($sale->payment_status === 'paid')

                            <span class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700">
                                Paiement complet
                            </span>

                        @elseif($sale->payment_status === 'partial')

                            <span class="inline-flex items-center rounded-full bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700">
                                Paiement partiel
                            </span>

                        @else

                            <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600">
                                Non payée
                            </span>

                        @endif

                    </div>

                </div>

            </div>

            {{-- Produits --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-6 py-5">

                    <h3 class="text-base font-bold text-slate-900">
                        Produits vendus
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $sale->items->sum('quantity') }} unité(s) · {{ $sale->items->count() }} ligne(s)
                    </p>

                </div>

                {{-- Desktop --}}
                <div class="hidden overflow-x-auto md:block">

                    <table class="min-w-full divide-y divide-slate-100">

                        <thead class="bg-slate-50">

                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Produit
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Quantité
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Prix unitaire
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Total
                                </th>
                            </tr>

                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @foreach($sale->items as $item)

                                <tr>

                                    <td class="px-6 py-4">

                                        <div>
                                            <p class="font-semibold text-slate-900">
                                                {{ $item->product->name }}
                                            </p>

                                            @if($item->product->sku)
                                                <p class="mt-1 text-xs text-slate-400">
                                                    SKU : {{ $item->product->sku }}
                                                </p>
                                            @endif
                                        </div>

                                    </td>

                                    <td class="px-6 py-4 text-right text-sm font-medium text-slate-700">
                                        {{ $item->quantity }}
                                    </td>

                                    <td class="px-6 py-4 text-right text-sm text-slate-600">
                                        {{ number_format($item->unit_price, 0, ',', ' ') }} FCFA
                                    </td>

                                    <td class="px-6 py-4 text-right text-sm font-bold text-slate-900">
                                        {{ number_format($item->total, 0, ',', ' ') }} FCFA
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                {{-- Mobile --}}
                <div class="divide-y divide-slate-100 md:hidden">

                    @foreach($sale->items as $item)

                        <div class="p-5">

                            <div class="flex items-start justify-between gap-4">

                                <div class="min-w-0">

                                    <p class="font-semibold text-slate-900">
                                        {{ $item->product->name }}
                                    </p>

                                    @if($item->product->sku)
                                        <p class="mt-1 text-xs text-slate-400">
                                            SKU : {{ $item->product->sku }}
                                        </p>
                                    @endif

                                </div>

                                <p class="shrink-0 font-bold text-slate-900">
                                    {{ number_format($item->total, 0, ',', ' ') }}
                                    FCFA
                                </p>

                            </div>

                            <div class="mt-3 flex justify-between text-sm text-slate-500">

                                <span>
                                    {{ $item->quantity }} ×
                                    {{ number_format($item->unit_price, 0, ',', ' ') }}
                                    FCFA
                                </span>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

            {{-- Paiement et résumé --}}
            <div class="grid gap-6 lg:grid-cols-3">

                {{-- Informations paiement --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm lg:col-span-2">

                    <h3 class="text-base font-bold text-slate-900">
                        Informations de paiement
                    </h3>

                    <div class="mt-5 grid gap-4 sm:grid-cols-2">

                        <div class="rounded-xl bg-slate-50 p-4">

                            <p class="text-xs font-medium text-slate-500">
                                Mode de paiement
                            </p>

                            <p class="mt-2 font-semibold text-slate-900">

                                @switch($sale->payment_method)

                                    @case('cash')
                                        Espèces
                                        @break

                                    @case('wave')
                                        Wave
                                        @break

                                    @case('orange_money')
                                        Orange Money
                                        @break

                                    @case('card')
                                        Carte bancaire
                                        @break

                                    @case('other')
                                        Autre
                                        @break

                                    @default
                                        Aucun paiement
                                @endswitch

                            </p>

                        </div>

                        <div class="rounded-xl bg-slate-50 p-4">

                            <p class="text-xs font-medium text-slate-500">
                                Montant payé
                            </p>

                            <p class="mt-2 font-semibold text-slate-900">
                                {{ number_format($sale->amount_paid, 0, ',', ' ') }}
                                FCFA
                            </p>

                        </div>

                        <div class="rounded-xl bg-slate-50 p-4 sm:col-span-2">

                            <p class="text-xs font-medium text-slate-500">
                                Reste à payer
                            </p>

                            @php
                                $remaining = max(
                                    0,
                                    (float) $sale->total - (float) $sale->amount_paid
                                );
                            @endphp

                            <p class="mt-2 text-xl font-bold {{ $remaining > 0 ? 'text-amber-600' : 'text-emerald-600' }}">
                                {{ number_format($remaining, 0, ',', ' ') }}
                                FCFA
                            </p>

                        </div>

                    </div>

                </div>

                {{-- Résumé financier --}}
                <div class="rounded-2xl bg-sellia-700 p-6 text-white shadow-sm">

                    <h3 class="text-base font-bold">
                        Résumé
                    </h3>

                    <div class="mt-6 space-y-4">

                        <div class="flex items-center justify-between text-sm text-blue-100">
                            <span>Sous-total</span>

                            <span class="font-medium text-white">
                                {{ number_format($sale->subtotal, 0, ',', ' ') }}
                                FCFA
                            </span>
                        </div>

                        <div class="flex items-center justify-between text-sm text-blue-100">
                            <span>Remise</span>

                            <span class="font-medium text-white">
                                - {{ number_format($sale->discount, 0, ',', ' ') }}
                                FCFA
                            </span>
                        </div>

                        <div class="border-t border-white/20 pt-4">

                            <div class="flex items-center justify-between">

                                <span class="text-sm font-medium text-blue-100">
                                    Total
                                </span>

                                <span class="text-2xl font-bold">
                                    {{ number_format($sale->total, 0, ',', ' ') }}
                                    FCFA
                                </span>

                            </div>

                        </div>

                        <div class="border-t border-white/20 pt-4">

                            <div class="flex items-center justify-between text-sm">

                                <span class="text-blue-100">
                                    Payé
                                </span>

                                <span class="font-semibold">
                                    {{ number_format($sale->amount_paid, 0, ',', ' ') }}
                                    FCFA
                                </span>

                            </div>

                            <div class="mt-2 flex items-center justify-between text-sm">

                                <span class="text-blue-100">
                                    Reste
                                </span>

                                <span class="font-semibold">
                                    {{ number_format($remaining, 0, ',', ' ') }}
                                    FCFA
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Notes --}}
            @if($sale->notes)

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <h3 class="text-base font-bold text-slate-900">
                        Notes
                    </h3>

                    <p class="mt-3 whitespace-pre-line text-sm leading-6 text-slate-600">
                        {{ $sale->notes }}
                    </p>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Ticket {{ $sale->reference }} — {{ $sale->shop->name }}
    </title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>

        @media print {

            @page {
                size: 80mm auto;
                margin: 0;
            }

            html,
            body {
                width: 80mm;
                margin: 0;
                padding: 0;
                background: white !important;
            }

            .no-print {
                display: none !important;
            }

            .receipt {
                width: 80mm !important;
                max-width: 80mm !important;
                margin: 0 !important;
                padding: 5mm !important;
                box-shadow: none !important;
                border: none !important;
            }

        }

        @media screen {

            body {
                background: #f1f5f9;
            }

            .receipt {
                width: 380px;
                max-width: calc(100% - 32px);
            }

        }

    </style>

</head>


<body class="min-h-screen">

    {{-- Actions écran --}}
    <div class="no-print mx-auto flex max-w-[380px] gap-3 px-4 py-5">

        <button
            type="button"
            onclick="window.print()"
            class="flex-1 rounded-xl bg-blue-800 px-4 py-3
                text-sm font-bold text-white shadow-sm
                transition hover:bg-blue-900"
        >
            Imprimer le ticket
        </button>

        <a
            href="{{ route('sales.show', $sale) }}"
            class="rounded-xl border border-slate-200
                bg-white px-4 py-3 text-sm font-semibold
                text-slate-700 shadow-sm
                transition hover:bg-slate-50"
        >
            Retour
        </a>

    </div>


    {{-- Ticket --}}
    <main
        class="receipt mx-auto mb-8
            rounded-lg border border-slate-200
            bg-white p-5 shadow-sm"
    >

        {{-- En-tête boutique --}}
        <header class="text-center">

            <div
                class="mx-auto flex h-12 w-12 items-center justify-center
                    rounded-xl bg-blue-800 text-lg font-black text-white"
            >
                S
            </div>

            <h1 class="mt-3 text-lg font-extrabold tracking-tight text-slate-900">
                {{ $sale->shop->name }}
            </h1>

            @if ($sale->shop->address)
                <p class="mt-1 text-xs text-slate-500">
                    {{ $sale->shop->address }}
                </p>
            @endif

            @if ($sale->shop->phone)
                <p class="text-xs text-slate-500">
                    Tél. {{ $sale->shop->phone }}
                </p>
            @endif

        </header>


        {{-- Séparateur --}}
        <div class="my-4 border-t border-dashed border-slate-300"></div>


        {{-- Informations vente --}}
        <section class="space-y-1 text-xs">

            <div class="flex justify-between gap-4">
                <span class="text-slate-500">
                    Référence
                </span>

                <span class="font-semibold text-slate-900">
                    {{ $sale->reference }}
                </span>
            </div>

            <div class="flex justify-between gap-4">
                <span class="text-slate-500">
                    Date
                </span>

                <span class="font-medium text-slate-700">
                    {{ $sale->sold_at->format('d/m/Y H:i') }}
                </span>
            </div>

            @if ($sale->customer)

                <div class="flex justify-between gap-4">
                    <span class="text-slate-500">
                        Client
                    </span>

                    <span class="max-w-[60%] text-right font-medium text-slate-700">
                        {{ $sale->customer->name }}
                    </span>
                </div>

                @if ($sale->customer->phone)

                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">
                            Téléphone
                        </span>

                        <span class="font-medium text-slate-700">
                            {{ $sale->customer->phone }}
                        </span>
                    </div>

                @endif

            @endif

        </section>


        {{-- Séparateur --}}
        <div class="my-4 border-t border-dashed border-slate-300"></div>


        {{-- Articles --}}
        <section>

            <div
                class="mb-3 grid grid-cols-[1fr_auto_auto]
                    gap-2 text-[10px] font-bold uppercase
                    tracking-wide text-slate-400"
            >

                <span>
                    Article
                </span>

                <span>
                    Qté
                </span>

                <span>
                    Total
                </span>

            </div>


            <div class="space-y-3">

                @foreach ($sale->items as $item)

                    <div
                        class="grid grid-cols-[1fr_auto_auto]
                            items-start gap-2"
                    >

                        <div class="min-w-0">

                            <p class="break-words text-xs font-semibold text-slate-800">
                                {{ $item->product->name }}
                            </p>

                            <p class="mt-0.5 text-[10px] text-slate-400">
                                {{ number_format($item->unit_price, 0, ',', ' ') }}
                                FCFA / unité
                            </p>

                        </div>

                        <span class="text-xs text-slate-600">
                            {{ $item->quantity }}
                        </span>

                        <span class="text-right text-xs font-semibold text-slate-800">
                            {{ number_format($item->total, 0, ',', ' ') }}
                        </span>

                    </div>

                @endforeach

            </div>

        </section>


        {{-- Totaux --}}
        <div class="my-4 border-t border-dashed border-slate-300"></div>

        <section class="space-y-2 text-xs">

            <div class="flex justify-between">
                <span class="text-slate-500">
                    Sous-total
                </span>

                <span class="font-medium text-slate-700">
                    {{ number_format($sale->subtotal, 0, ',', ' ') }}
                    FCFA
                </span>
            </div>


            @if ($sale->discount > 0)

                <div class="flex justify-between">

                    <span class="text-slate-500">
                        Remise
                    </span>

                    <span class="font-medium text-slate-700">
                        - {{ number_format($sale->discount, 0, ',', ' ') }}
                        FCFA
                    </span>

                </div>

            @endif


            <div
                class="flex items-center justify-between
                    border-t border-slate-200 pt-3"
            >

                <span class="text-sm font-bold text-slate-900">
                    TOTAL
                </span>

                <span class="text-base font-extrabold text-blue-800">
                    {{ number_format($sale->total, 0, ',', ' ') }}
                    FCFA
                </span>

            </div>

        </section>


        {{-- Paiement --}}
        <div class="my-4 border-t border-dashed border-slate-300"></div>

        <section class="space-y-2 text-xs">

            <div class="flex justify-between">

                <span class="text-slate-500">
                    Montant payé
                </span>

                <span class="font-semibold text-slate-700">
                    {{ number_format($sale->amount_paid, 0, ',', ' ') }}
                    FCFA
                </span>

            </div>


            @php
                $remaining = max(
                    0,
                    (float) $sale->total - (float) $sale->amount_paid
                );
            @endphp


            @if ($remaining > 0)

                <div class="flex justify-between">

                    <span class="text-slate-500">
                        Reste à payer
                    </span>

                    <span class="font-bold text-red-600">
                        {{ number_format($remaining, 0, ',', ' ') }}
                        FCFA
                    </span>

                </div>

            @else

                <div class="flex justify-between">

                    <span class="text-slate-500">
                        Reste à payer
                    </span>

                    <span class="font-bold text-emerald-600">
                        0 FCFA
                    </span>

                </div>

            @endif


            @if ($sale->payment_method)

                <div class="flex justify-between">

                    <span class="text-slate-500">
                        Paiement
                    </span>

                    <span class="font-semibold text-slate-700">

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

                            @default
                                Autre

                        @endswitch

                    </span>

                </div>

            @endif


            <div class="pt-1 text-center">

                @if ($sale->payment_status === 'paid')

                    <span
                        class="inline-flex rounded-full
                            bg-emerald-50 px-3 py-1
                            text-[10px] font-bold
                            uppercase tracking-wide text-emerald-700"
                    >
                        Paiement complet
                    </span>

                @elseif ($sale->payment_status === 'partial')

                    <span
                        class="inline-flex rounded-full
                            bg-amber-50 px-3 py-1
                            text-[10px] font-bold
                            uppercase tracking-wide text-amber-700"
                    >
                        Paiement partiel
                    </span>

                @else

                    <span
                        class="inline-flex rounded-full
                            bg-red-50 px-3 py-1
                            text-[10px] font-bold
                            uppercase tracking-wide text-red-700"
                    >
                        Non payé
                    </span>

                @endif

            </div>

        </section>


        {{-- Notes --}}
        @if ($sale->notes)

            <div class="my-4 border-t border-dashed border-slate-300"></div>

            <section>

                <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                    Note
                </p>

                <p class="mt-1 text-xs leading-5 text-slate-600">
                    {{ $sale->notes }}
                </p>

            </section>

        @endif


        {{-- Pied du ticket --}}
        <div class="my-5 border-t border-dashed border-slate-300"></div>

        <footer class="text-center">

            <p class="text-xs font-semibold text-slate-800">
                Merci pour votre confiance !
            </p>

            <p class="mt-1 text-[10px] text-slate-400">
                Gérez. Vendez. Progressez.
            </p>

            <p class="mt-3 text-[9px] text-slate-300">
                Ticket généré par SELLIA
            </p>

        </footer>

    </main>

</body>

</html>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <title>
        Ticket {{ $sale->reference }}
    </title>

    <style>

        @page {
            margin: 12px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
            color: #1e293b;
        }

        .ticket {
            width: 100%;
        }

        .center {
            text-align: center;
        }

        .shop-name {
            margin-top: 6px;
            font-size: 15px;
            font-weight: bold;
        }

        .muted {
            color: #64748b;
        }

        .small {
            font-size: 8px;
        }

        .separator {
            margin: 10px 0;
            border-top: 1px dashed #cbd5e1;
        }

        .row {
            width: 100%;
            margin-bottom: 4px;
        }

        .row td {
            vertical-align: top;
        }

        .label {
            color: #64748b;
        }

        .right {
            text-align: right;
        }

        .items {
            width: 100%;
            border-collapse: collapse;
        }

        .items th {
            padding-bottom: 6px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 8px;
            text-transform: uppercase;
            color: #64748b;
        }

        .items td {
            padding: 6px 0;
            vertical-align: top;
            border-bottom: 1px solid #f1f5f9;
        }

        .product {
            font-weight: bold;
        }

        .price {
            color: #64748b;
            font-size: 8px;
            margin-top: 2px;
        }

        .totals {
            width: 100%;
            border-collapse: collapse;
        }

        .totals td {
            padding: 3px 0;
        }

        .total {
            border-top: 1px solid #cbd5e1;
            padding-top: 7px !important;
            font-size: 12px;
            font-weight: bold;
        }

        .payment {
            margin-top: 8px;
        }

        .paid {
            color: #047857;
            font-weight: bold;
        }

        .remaining {
            color: #b45309;
            font-weight: bold;
        }

        .footer {
            margin-top: 15px;
            text-align: center;
        }

        .thanks {
            font-weight: bold;
            font-size: 10px;
        }

    </style>

</head>


<body>

<div class="ticket">

    {{-- Boutique --}}
    <div class="center">

        <div class="shop-name">
            {{ $sale->shop->name }}
        </div>

        @if($sale->shop->address)
            <div class="muted small">
                {{ $sale->shop->address }}
            </div>
        @endif

        @if($sale->shop->phone)
            <div class="muted small">
                Tél. {{ $sale->shop->phone }}
            </div>
        @endif

    </div>


    <div class="separator"></div>


    {{-- Vente --}}
    <table class="row">

        <tr>

            <td class="label">
                Référence
            </td>

            <td class="right">
                <strong>{{ $sale->reference }}</strong>
            </td>

        </tr>

        <tr>

            <td class="label">
                Date
            </td>

            <td class="right">
                {{ $sale->sold_at->format('d/m/Y H:i') }}
            </td>

        </tr>

        @if($sale->customer)

            <tr>

                <td class="label">
                    Client
                </td>

                <td class="right">
                    {{ $sale->customer->name }}
                </td>

            </tr>

        @endif

    </table>


    <div class="separator"></div>


    {{-- Produits --}}
    <table class="items">

        <thead>

            <tr>

                <th style="text-align:left;">
                    Article
                </th>

                <th style="text-align:right;">
                    Qté
                </th>

                <th style="text-align:right;">
                    Total
                </th>

            </tr>

        </thead>


        <tbody>

            @foreach($sale->items as $item)

                <tr>

                    <td>

                        <div class="product">
                            {{ $item->product->name }}
                        </div>

                        <div class="price">
                            {{ number_format($item->unit_price, 0, ',', ' ') }}
                            FCFA / unité
                        </div>

                    </td>

                    <td class="right">
                        {{ $item->quantity }}
                    </td>

                    <td class="right">
                        <strong>
                            {{ number_format($item->total, 0, ',', ' ') }}
                        </strong>
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>


    <div class="separator"></div>


    {{-- Totaux --}}
    <table class="totals">

        <tr>

            <td class="label">
                Sous-total
            </td>

            <td class="right">
                {{ number_format($sale->subtotal, 0, ',', ' ') }}
                FCFA
            </td>

        </tr>


        @if($sale->discount > 0)

            <tr>

                <td class="label">
                    Remise
                </td>

                <td class="right">
                    -
                    {{ number_format($sale->discount, 0, ',', ' ') }}
                    FCFA
                </td>

            </tr>

        @endif


        <tr>

            <td class="total">
                TOTAL
            </td>

            <td class="right total">
                {{ number_format($sale->total, 0, ',', ' ') }}
                FCFA
            </td>

        </tr>

    </table>


    <div class="separator"></div>


    {{-- Paiement --}}
    @php
        $remaining = max(
            0,
            (float) $sale->total - (float) $sale->amount_paid
        );
    @endphp

    <table class="totals payment">

        <tr>

            <td class="label">
                Montant payé
            </td>

            <td class="right paid">
                {{ number_format($sale->amount_paid, 0, ',', ' ') }}
                FCFA
            </td>

        </tr>


        <tr>

            <td class="label">
                Reste à payer
            </td>

            <td class="right {{ $remaining > 0 ? 'remaining' : 'paid' }}">
                {{ number_format($remaining, 0, ',', ' ') }}
                FCFA
            </td>

        </tr>


        @if($sale->payment_method)

            <tr>

                <td class="label">
                    Paiement
                </td>

                <td class="right">

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

                </td>

            </tr>

        @endif

    </table>


    @if($sale->notes)

        <div class="separator"></div>

        <div>

            <strong>
                Note
            </strong>

            <div class="muted">
                {{ $sale->notes }}
            </div>

        </div>

    @endif


    {{-- Pied --}}
    <div class="footer">

        <div class="thanks">
            Merci pour votre confiance !
        </div>

        <div class="muted small">
            Gérez. Vendez. Progressez.
        </div>

        <div class="muted small" style="margin-top:5px;">
            Ticket généré par SELLIA
        </div>

    </div>

</div>

</body>

</html>
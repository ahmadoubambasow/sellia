<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-bold tracking-tight text-slate-900">
                    Tableau de bord
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Vue d’ensemble de votre activité commerciale.
                </p>
            </div>

            <a
                href="{{ route('sales.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-sellia-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-sellia-800"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
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

        <div class="mx-auto max-w-7xl space-y-8 px-4 py-6 sm:px-6 lg:px-8">

            {{-- ========================================================= --}}
            {{-- 1. INDICATEURS PRINCIPAUX                                --}}
            {{-- ========================================================= --}}

            <section>
                <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

                    {{-- Chiffre d'affaires --}}
                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-500">
                                    Chiffre d'affaires
                                </p>

                                <p class="mt-2 text-2xl font-bold tracking-tight text-slate-900">
                                    {{ number_format($overview['today']['revenue'], 0, ',', ' ') }}
                                    <span class="text-sm font-semibold text-slate-500">
                                        FCFA
                                    </span>
                                </p>
                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-sellia-50 text-sellia-700">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.1 0 2.034.402 2.598 1M12 8V6m0 12v-2m0 2c-1.1 0-2.034-.402-2.598-1M12 18c-3.314 0-6-1.343-6-3V9c0-1.657 2.686-3 6-3s6 1.343 6 3v6c0 1.657-2.686 3-6 3Z"
                                    />
                                </svg>
                            </div>
                        </div>

                        <x-dashboard.evolution
                            :value="$overview['evolution']['today_vs_yesterday']"
                            label="vs hier"
                        />

                    </div>

                    {{-- Ventes --}}
                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-500">
                                    Ventes
                                </p>

                                <p class="mt-2 text-2xl font-bold tracking-tight text-slate-900">
                                    {{ $overview['today']['sales_count'] }}
                                </p>
                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-accent-500/10 text-accent-600">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13 5 5m2 8-1 5h12m-9 3h.01M17 21h.01"
                                    />
                                </svg>
                            </div>
                        </div>

                        <p class="mt-4 text-xs text-slate-500">
                            Vente(s) réalisée(s) aujourd'hui
                        </p>

                    </div>

                    {{-- Montant encaissé --}}
                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-500">
                                    Montant encaissé
                                </p>

                                <p class="mt-2 text-2xl font-bold tracking-tight text-slate-900">
                                    {{ number_format($overview['today']['amount_paid'], 0, ',', ' ') }}
                                    <span class="text-sm font-semibold text-slate-500">
                                        FCFA
                                    </span>
                                </p>
                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.1 0 2.034.402 2.598 1M12 8V6m0 12v-2m0 2c-1.1 0-2.034-.402-2.598-1M12 18c-3.314 0-6-1.343-6-3V9c0-1.657 2.686-3 6-3s6 1.343 6 3v6c0 1.657-2.686 3-6 3Z"
                                    />
                                </svg>
                            </div>
                        </div>

                        <p class="mt-4 text-xs text-slate-500">
                            Paiements reçus aujourd'hui
                        </p>

                    </div>

                    {{-- À encaisser --}}
                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-500">
                                    À encaisser
                                </p>

                                <p class="mt-2 text-2xl font-bold tracking-tight text-slate-900">
                                    {{ number_format($overview['today']['remaining'], 0, ',', ' ') }}
                                    <span class="text-sm font-semibold text-slate-500">
                                        FCFA
                                    </span>
                                </p>
                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"
                                    />
                                </svg>
                            </div>
                        </div>

                        <p class="mt-4 text-xs text-slate-500">
                            Reste à percevoir aujourd'hui
                        </p>

                    </div>

                </div>
            </section>


            {{-- ========================================================= --}}
            {{-- 2. ÉVOLUTION DU CHIFFRE D'AFFAIRES                       --}}
            {{-- ========================================================= --}}

            <section>

                <x-dashboard.revenue-chart
                    :data="$overview['revenue_last_seven_days']"
                />

            </section>


            {{-- ========================================================= --}}
            {{-- 3. ACTIVITÉ RÉCENTE + SITUATION DES PAIEMENTS             --}}
            {{-- ========================================================= --}}

            <section class="grid gap-6 lg:grid-cols-2">

                {{-- Activité récente --}}
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-5 py-4">
                        <h3 class="font-semibold text-slate-900">
                            Activité récente
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Comparez vos ventes sur les trois derniers jours.
                        </p>
                    </div>

                    <div class="divide-y divide-slate-100">

                        @foreach([
                            'today' => "Aujourd'hui",
                            'yesterday' => 'Hier',
                            'day_before_yesterday' => 'Avant-hier',
                        ] as $period => $label)

                            <div class="flex items-center justify-between px-5 py-4">

                                <div>
                                    <p class="font-medium text-slate-900">
                                        {{ $label }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        {{ $overview[$period]['sales_count'] }} vente(s)
                                    </p>
                                </div>

                                <div class="text-right">

                                    <p class="font-semibold text-sellia-700">
                                        {{ number_format($overview[$period]['revenue'], 0, ',', ' ') }}
                                        FCFA
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        encaissé :
                                        {{ number_format($overview[$period]['amount_paid'], 0, ',', ' ') }}
                                        FCFA
                                    </p>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>


                {{-- Situation des paiements --}}
                <x-dashboard.payment-chart
                    :summary="$overview['sales']"
                />

            </section>


            {{-- ========================================================= --}}
            {{-- 4. PERFORMANCE MENSUELLE                                 --}}
            {{-- ========================================================= --}}

            <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-5 py-4">

                    <h3 class="font-semibold text-slate-900">
                        Performance mensuelle
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Suivez l'évolution de votre activité commerciale.
                    </p>

                </div>

                <div class="grid gap-4 p-5 sm:grid-cols-3">

                    {{-- Ce mois --}}
                    <div class="rounded-xl bg-sellia-50 p-5">

                        <p class="text-sm font-medium text-sellia-700">
                            Ce mois
                        </p>

                        <p class="mt-3 text-2xl font-bold text-sellia-900">
                            {{ number_format($overview['current_month']['revenue'], 0, ',', ' ') }}
                            <span class="text-sm font-semibold">
                                FCFA
                            </span>
                        </p>

                        <p class="mt-2 text-xs text-sellia-700">
                            {{ $overview['current_month']['sales_count'] }}
                            vente(s)
                        </p>

                        <x-dashboard.evolution
                            :value="$overview['evolution']['current_month_vs_previous_month']"
                            label="vs mois précédent"
                        />

                    </div>


                    {{-- Mois précédent --}}
                    <div class="rounded-xl bg-slate-50 p-5">

                        <p class="text-sm font-medium text-slate-600">
                            Mois précédent
                        </p>

                        <p class="mt-3 text-2xl font-bold text-slate-900">
                            {{ number_format($overview['previous_month']['revenue'], 0, ',', ' ') }}
                            <span class="text-sm font-semibold text-slate-500">
                                FCFA
                            </span>
                        </p>

                        <p class="mt-2 text-xs text-slate-500">
                            {{ $overview['previous_month']['sales_count'] }}
                            vente(s)
                        </p>

                    </div>


                    {{-- Cette année --}}
                    <div class="rounded-xl bg-slate-50 p-5">

                        <p class="text-sm font-medium text-slate-600">
                            Depuis le début de l'année
                        </p>

                        <p class="mt-3 text-2xl font-bold text-slate-900">
                            {{ number_format($overview['current_year']['revenue'], 0, ',', ' ') }}
                            <span class="text-sm font-semibold text-slate-500">
                                FCFA
                            </span>
                        </p>

                        <p class="mt-2 text-xs text-slate-500">
                            {{ $overview['current_year']['sales_count'] }}
                            vente(s)
                        </p>

                    </div>

                </div>

            </section>


            {{-- ========================================================= --}}
            {{-- 5. PRODUITS + GRAPHIQUE PRODUITS                         --}}
            {{-- ========================================================= --}}

            <section class="grid gap-6 lg:grid-cols-2">

                {{-- Graphique produits --}}
                <x-dashboard.top-products-chart
                    :products="$overview['top_products']"
                />


                {{-- Liste des produits --}}
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">

                        <div>
                            <h3 class="font-semibold text-slate-900">
                                Détail des produits
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Les produits qui génèrent le plus de ventes.
                            </p>
                        </div>

                        <a
                            href="{{ route('products.index') }}"
                            class="text-sm font-semibold text-sellia-700 transition hover:text-sellia-500"
                        >
                            Voir les produits
                        </a>

                    </div>

                    @if($overview['top_products']->isNotEmpty())

                        <div class="divide-y divide-slate-100">

                            @foreach($overview['top_products'] as $index => $product)

                                <div class="flex items-center gap-4 px-5 py-4">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-sellia-50 text-sm font-bold text-sellia-700">
                                        {{ $index + 1 }}
                                    </div>

                                    <div class="min-w-0 flex-1">

                                        <p class="truncate font-medium text-slate-900">
                                            {{ $product->name }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            {{ $product->sold_quantity ?? 0 }}
                                            unité(s) vendue(s)
                                        </p>

                                    </div>

                                    <div class="text-right">

                                        <p class="font-semibold text-slate-900">
                                            {{ number_format($product->sold_revenue ?? 0, 0, ',', ' ') }}
                                            FCFA
                                        </p>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="px-5 py-10 text-center">

                            <p class="text-sm font-medium text-slate-700">
                                Aucune vente enregistrée
                            </p>

                            <p class="mt-1 text-sm text-slate-500">
                                Les produits les plus vendus apparaîtront ici.
                            </p>

                        </div>

                    @endif

                </div>

            </section>


            {{-- ========================================================= --}}
            {{-- 6. ÉTAT DU STOCK                                         --}}
            {{-- ========================================================= --}}

            <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">

                    <div>
                        <h3 class="font-semibold text-slate-900">
                            État du stock
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Surveillez les produits nécessitant votre attention.
                        </p>
                    </div>

                    <a
                        href="{{ route('stock-movements.index') }}"
                        class="text-sm font-semibold text-sellia-700 transition hover:text-sellia-500"
                    >
                        Voir le stock
                    </a>

                </div>


                {{-- Statistiques --}}
                <div class="grid grid-cols-3 divide-x divide-slate-100">

                    <div class="p-5 text-center">

                        <p class="text-2xl font-bold text-slate-900">
                            {{ $overview['stock']['total_products'] }}
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            Produits actifs
                        </p>

                    </div>

                    <div class="p-5 text-center">

                        <p class="text-2xl font-bold text-amber-600">
                            {{ $overview['stock']['low_stock'] }}
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            Stock faible
                        </p>

                    </div>

                    <div class="p-5 text-center">

                        <p class="text-2xl font-bold text-red-600">
                            {{ $overview['stock']['out_of_stock'] }}
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            Rupture
                        </p>

                    </div>

                </div>


                {{-- Alertes --}}
                @if($overview['low_stock_products']->isNotEmpty())

                    <div class="border-t border-slate-100">

                        <div class="px-5 py-3">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Alertes stock
                            </p>
                        </div>

                        <div class="divide-y divide-slate-100">

                            @foreach($overview['low_stock_products'] as $product)

                                <div class="flex items-center justify-between px-5 py-3">

                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-medium text-slate-800">
                                            {{ $product->name }}
                                        </p>

                                        <p class="mt-0.5 text-xs text-slate-500">
                                            Seuil :
                                            {{ $product->low_stock_threshold }}
                                        </p>

                                    </div>

                                    <span class="ml-4 shrink-0 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                        {{ $product->stock_quantity }} restant(s)
                                    </span>

                                </div>

                            @endforeach

                        </div>

                    </div>

                @else

                    <div class="border-t border-slate-100 px-5 py-8 text-center">

                        <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m5 12 4 4L19 6"
                                />
                            </svg>

                        </div>

                        <p class="mt-3 text-sm font-medium text-slate-700">
                            Stock en bonne santé
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            Aucun produit n'est actuellement en stock faible.
                        </p>

                    </div>

                @endif

            </section>


            {{-- ========================================================= --}}
            {{-- 7. RÉSUMÉ DES PAIEMENTS                                  --}}
            {{-- ========================================================= --}}

            <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-5 py-4">

                    <h3 class="font-semibold text-slate-900">
                        Résumé des paiements
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Vue globale des ventes et de leur état de paiement.
                    </p>

                </div>

                <div class="grid gap-4 p-5 sm:grid-cols-2 lg:grid-cols-4">

                    <div class="rounded-xl bg-emerald-50 p-4">

                        <p class="text-sm font-medium text-emerald-700">
                            Payées
                        </p>

                        <p class="mt-2 text-2xl font-bold text-emerald-900">
                            {{ $overview['sales']['paid_sales'] }}
                        </p>

                        <p class="mt-1 text-xs text-emerald-700">
                            vente(s)
                        </p>

                    </div>

                    <div class="rounded-xl bg-amber-50 p-4">

                        <p class="text-sm font-medium text-amber-700">
                            Partiellement payées
                        </p>

                        <p class="mt-2 text-2xl font-bold text-amber-900">
                            {{ $overview['sales']['partial_sales'] }}
                        </p>

                        <p class="mt-1 text-xs text-amber-700">
                            vente(s)
                        </p>

                    </div>

                    <div class="rounded-xl bg-slate-100 p-4">

                        <p class="text-sm font-medium text-slate-600">
                            Impayées
                        </p>

                        <p class="mt-2 text-2xl font-bold text-slate-900">
                            {{ $overview['sales']['unpaid_sales'] }}
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            vente(s)
                        </p>

                    </div>

                    <div class="rounded-xl bg-red-50 p-4">

                        <p class="text-sm font-medium text-red-700">
                            Annulées
                        </p>

                        <p class="mt-2 text-2xl font-bold text-red-900">
                            {{ $overview['sales']['cancelled_sales'] }}
                        </p>

                        <p class="mt-1 text-xs text-red-700">
                            vente(s)
                        </p>

                    </div>

                </div>

            </section>

        </div>

    </div>

</x-app-layout>
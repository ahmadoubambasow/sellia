<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">

            <div>
                <p class="text-sm font-medium text-sellia-700">
                    Tableau de bord
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                    {{ auth()->user()->shop->name }}
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Gérez votre activité et suivez vos performances.
                </p>
            </div>

            <div class="text-sm text-slate-500">
                {{ auth()->user()->shop->currency === 'XOF' ? 'FCFA' : auth()->user()->shop->currency }}
            </div>

        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-10 sm:py-12">

        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Bienvenue --}}
            <div class="overflow-hidden rounded-3xl bg-sellia-700 shadow-sm">

                <div class="relative px-6 py-8 sm:px-8">

                    <div class="relative max-w-2xl">

                        <p class="text-sm font-medium text-blue-100">
                            Bienvenue sur SELLIA
                        </p>

                        <h1 class="mt-2 text-2xl font-bold tracking-tight text-white sm:text-3xl">
                            {{ auth()->user()->shop->name }}
                        </h1>

                        <p class="mt-3 max-w-xl text-sm leading-6 text-blue-100">
                            Gérez vos produits, vos ventes, vos clients et votre stock
                            depuis un seul espace.
                        </p>

                    </div>

                </div>

            </div>

            {{-- Statistiques --}}
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">
                        Ventes aujourd'hui
                    </p>

                    <p class="mt-3 text-2xl font-bold text-slate-900">
                        0 FCFA
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Aucune vente enregistrée
                    </p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">
                        Ventes ce mois
                    </p>

                    <p class="mt-3 text-2xl font-bold text-slate-900">
                        0 FCFA
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Ce mois-ci
                    </p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">
                        Produits
                    </p>

                    <p class="mt-3 text-2xl font-bold text-slate-900">
                        0
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Aucun produit enregistré
                    </p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">
                        Clients
                    </p>

                    <p class="mt-3 text-2xl font-bold text-slate-900">
                        0
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Aucun client enregistré
                    </p>
                </div>

            </div>

            {{-- Prochaines fonctionnalités --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">

                <div>
                    <p class="text-sm font-medium text-sellia-700">
                        Votre espace de gestion
                    </p>

                    <h3 class="mt-1 text-xl font-bold text-slate-900">
                        Commencez à développer votre activité
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Ajoutez vos catégories et vos produits pour commencer
                        à enregistrer vos ventes.
                    </p>
                </div>

                <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">

                    <div class="rounded-2xl border border-slate-200 p-5">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sellia-50">
                            <span class="text-lg">📦</span>
                        </div>

                        <h4 class="mt-4 font-semibold text-slate-900">
                            Produits
                        </h4>

                        <p class="mt-1 text-sm text-slate-500">
                            Gérez vos produits, prix et niveaux de stock.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 p-5">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sellia-50">
                            <span class="text-lg">🛒</span>
                        </div>

                        <h4 class="mt-4 font-semibold text-slate-900">
                            Ventes
                        </h4>

                        <p class="mt-1 text-sm text-slate-500">
                            Enregistrez et suivez toutes vos ventes.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 p-5">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sellia-50">
                            <span class="text-lg">👥</span>
                        </div>

                        <h4 class="mt-4 font-semibold text-slate-900">
                            Clients
                        </h4>

                        <p class="mt-1 text-sm text-slate-500">
                            Centralisez les informations de vos clients.
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
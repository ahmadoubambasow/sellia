<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-slate-900">
                Recherche
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Recherchez rapidement dans votre activité commerciale.
            </p>
        </div>
    </x-slot>

    <div class="space-y-6">

        {{-- Recherche --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <form
                method="GET"
                action="{{ route('search') }}"
                class="flex flex-col gap-3 sm:flex-row"
            >

                <div class="relative flex-1">

                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg
                            class="h-5 w-5 text-slate-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z"
                            />
                        </svg>
                    </div>

                    <input
                        type="search"
                        name="q"
                        value="{{ $term }}"
                        placeholder="Produit, client, vente, catégorie..."
                        autofocus
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-sellia-500 focus:bg-white focus:ring-2 focus:ring-sellia-500/20"
                    >

                </div>

                <button
                    type="submit"
                    class="rounded-xl bg-sellia-700 px-6 py-3 text-sm font-semibold text-white transition hover:bg-sellia-800 focus:outline-none focus:ring-2 focus:ring-sellia-500 focus:ring-offset-2"
                >
                    Rechercher
                </button>

            </form>

        </div>


        @if($term !== '')

            {{-- Produits --}}
            @if($results['products']->isNotEmpty())

                <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-5 py-4">
                        <h3 class="font-semibold text-slate-900">
                            Produits
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Produits correspondant à votre recherche.
                        </p>
                    </div>

                    <div class="divide-y divide-slate-100">

                        @foreach($results['products'] as $product)

                            <a
                                href="{{ route('products.edit', $product) }}"
                                class="flex items-center justify-between gap-4 px-5 py-4 transition hover:bg-slate-50"
                            >

                                <div class="flex min-w-0 items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-sellia-50 text-sellia-700">
                                        📦
                                    </div>

                                    <div class="min-w-0">
                                        <p class="truncate font-medium text-slate-900">
                                            {{ $product->name }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            @if($product->sku)
                                                SKU : {{ $product->sku }}
                                            @else
                                                Aucun SKU
                                            @endif
                                        </p>
                                    </div>

                                </div>

                                <div class="shrink-0 text-right">

                                    <p class="font-semibold text-slate-900">
                                        {{ number_format($product->selling_price, 0, ',', ' ') }}
                                        F CFA
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Stock : {{ $product->stock_quantity }}
                                    </p>

                                </div>

                            </a>

                        @endforeach

                    </div>

                </section>

            @endif


            {{-- Clients --}}
            @if($results['customers']->isNotEmpty())

                <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-5 py-4">

                        <h3 class="font-semibold text-slate-900">
                            Clients
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Clients correspondant à votre recherche.
                        </p>

                    </div>

                    <div class="divide-y divide-slate-100">

                        @foreach($results['customers'] as $customer)

                            <a
                                href="{{ route('customers.edit', $customer) }}"
                                class="flex items-center gap-3 px-5 py-4 transition hover:bg-slate-50"
                            >

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-accent-500 text-sm font-bold text-white">
                                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                                </div>

                                <div class="min-w-0">

                                    <p class="truncate font-medium text-slate-900">
                                        {{ $customer->name }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        {{ $customer->phone ?: $customer->email ?: 'Aucune information de contact' }}
                                    </p>

                                </div>

                            </a>

                        @endforeach

                    </div>

                </section>

            @endif


            {{-- Ventes --}}
            @if($results['sales']->isNotEmpty())

                <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-5 py-4">

                        <h3 class="font-semibold text-slate-900">
                            Ventes
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Ventes correspondant à votre recherche.
                        </p>

                    </div>

                    <div class="divide-y divide-slate-100">

                        @foreach($results['sales'] as $sale)

                            <a
                                href="{{ route('sales.show', $sale) }}"
                                class="flex items-center justify-between gap-4 px-5 py-4 transition hover:bg-slate-50"
                            >

                                <div>

                                    <p class="font-semibold text-sellia-700">
                                        {{ $sale->reference }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        {{ $sale->customer?->name ?? 'Client comptant' }}
                                        ·
                                        {{ $sale->sold_at->format('d/m/Y H:i') }}
                                    </p>

                                </div>

                                <div class="text-right">

                                    <p class="font-semibold text-slate-900">
                                        {{ number_format($sale->total, 0, ',', ' ') }}
                                        F CFA
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Voir la vente →
                                    </p>

                                </div>

                            </a>

                        @endforeach

                    </div>

                </section>

            @endif


            {{-- Catégories --}}
            @if($results['categories']->isNotEmpty())

                <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-5 py-4">

                        <h3 class="font-semibold text-slate-900">
                            Catégories
                        </h3>

                    </div>

                    <div class="divide-y divide-slate-100">

                        @foreach($results['categories'] as $category)

                            <a
                                href="{{ route('categories.edit', $category) }}"
                                class="flex items-center gap-3 px-5 py-4 transition hover:bg-slate-50"
                            >

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100">
                                    🗂️
                                </div>

                                <p class="font-medium text-slate-900">
                                    {{ $category->name }}
                                </p>

                            </a>

                        @endforeach

                    </div>

                </section>

            @endif


            {{-- Aucun résultat --}}
            @if(
                $results['products']->isEmpty() &&
                $results['customers']->isEmpty() &&
                $results['sales']->isEmpty() &&
                $results['categories']->isEmpty()
            )

                <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-2xl">
                        🔎
                    </div>

                    <h3 class="mt-4 font-semibold text-slate-900">
                        Aucun résultat
                    </h3>

                    <p class="mx-auto mt-2 max-w-md text-sm text-slate-500">
                        Aucun élément ne correspond à
                        <span class="font-medium text-slate-700">
                            « {{ $term }} »
                        </span>.
                    </p>

                </div>

            @endif

        @else

            {{-- État initial --}}
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-sellia-50 text-sellia-700">
                    <svg
                        class="h-8 w-8"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z"
                        />
                    </svg>
                </div>

                <h3 class="mt-5 text-lg font-semibold text-slate-900">
                    Recherchez dans SELLIA
                </h3>

                <p class="mx-auto mt-2 max-w-md text-sm text-slate-500">
                    Retrouvez rapidement vos produits, clients, ventes
                    et catégories.
                </p>

            </div>

        @endif

    </div>

</x-app-layout>
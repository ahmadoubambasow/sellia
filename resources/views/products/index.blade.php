<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-sellia-700">
                    Gestion commerciale
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                    Produits
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Gérez les produits, les prix et les niveaux de stock de votre boutique.
                </p>
            </div>

            <a
                href="{{ route('products.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-sellia-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-sellia-800 focus:outline-none focus:ring-2 focus:ring-sellia-500 focus:ring-offset-2"
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
                        d="M12 5v14m-7-7h14"
                    />
                </svg>

                Nouveau produit
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8 sm:py-10">

        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Statistiques rapides --}}
            <div class="grid gap-4 sm:grid-cols-3">

                {{-- Total produits --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Produits
                            </p>

                            <p class="mt-1 text-2xl font-bold text-slate-900">
                                {{ $products->count() }}
                            </p>
                        </div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-sellia-50 text-sellia-700">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M20 7.5L12 3 4 7.5m16 0v9L12 21l-8-4.5v-9m16 0L12 12 4 7.5M12 12v9"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Produits actifs --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Produits actifs
                            </p>

                            <p class="mt-1 text-2xl font-bold text-slate-900">
                                {{ $products->where('is_active', true)->count() }}
                            </p>
                        </div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
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

                {{-- Stock faible --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Stock faible
                            </p>

                            <p class="mt-1 text-2xl font-bold text-slate-900">
                                {{ $products->filter(fn ($product) => $product->isLowStock())->count() }}
                            </p>
                        </div>

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 9v3.75m0 3.75h.007M10.29 3.86l-7.04 12.2A2 2 0 0 0 4.98 19h14.04a2 2 0 0 0 1.73-2.94l-7.04-12.2a2 2 0 0 0-3.42 0Z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Liste --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- En-tête --}}
                <div class="flex flex-col gap-4 border-b border-slate-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h3 class="text-base font-semibold text-slate-900">
                            Liste des produits
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $products->count() }}
                            {{ $products->count() > 1 ? 'produits enregistrés' : 'produit enregistré' }}
                        </p>
                    </div>

                </div>

                @if ($products->isEmpty())

                    {{-- État vide --}}
                    <div class="px-6 py-16 text-center">

                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-sellia-50 text-sellia-700">
                            <svg
                                class="h-7 w-7"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.7"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M20 7.5L12 3 4 7.5m16 0v9L12 21l-8-4.5v-9m16 0L12 12 4 7.5M12 12v9"
                                />
                            </svg>
                        </div>

                        <h3 class="mt-5 text-base font-semibold text-slate-900">
                            Aucun produit
                        </h3>

                        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                            Commencez par ajouter votre premier produit afin de
                            gérer votre catalogue et votre stock.
                        </p>

                        <a
                            href="{{ route('products.create') }}"
                            class="mt-6 inline-flex items-center gap-2 rounded-xl bg-sellia-700 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-sellia-800"
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
                                    d="M12 5v14m-7-7h14"
                                />
                            </svg>

                            Ajouter un produit
                        </a>

                    </div>

                @else

                    {{-- Tableau desktop --}}
                    <div class="hidden overflow-x-auto md:block">

                        <table class="min-w-full divide-y divide-slate-100">

                            <thead class="bg-slate-50">
                                <tr>

                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Produit
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Catégorie
                                    </th>

                                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Prix de vente
                                    </th>

                                    <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Stock
                                    </th>

                                    <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Statut
                                    </th>

                                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Actions
                                    </th>

                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100 bg-white">

                                @foreach ($products as $product)

                                    <tr class="transition hover:bg-slate-50/70">

                                        {{-- Produit --}}
                                        <td class="px-6 py-4">
                                            <div>
                                                <p class="font-semibold text-slate-900">
                                                    {{ $product->name }}
                                                </p>

                                                @if ($product->sku)
                                                    <p class="mt-1 text-xs text-slate-400">
                                                        Réf. {{ $product->sku }}
                                                    </p>
                                                @endif
                                            </div>
                                        </td>

                                        {{-- Catégorie --}}
                                        <td class="px-6 py-4">
                                            @if ($product->category)
                                                <span class="inline-flex rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600">
                                                    {{ $product->category->name }}
                                                </span>
                                            @else
                                                <span class="text-sm text-slate-400">
                                                    Sans catégorie
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Prix --}}
                                        <td class="px-6 py-4 text-right">
                                            <span class="font-semibold text-slate-900">
                                                {{ number_format($product->selling_price, 0, ',', ' ') }}
                                            </span>

                                            <span class="ml-1 text-xs text-slate-400">
                                                FCFA
                                            </span>
                                        </td>

                                        {{-- Stock --}}
                                        <td class="px-6 py-4 text-center">
                                            @if ($product->isLowStock())
                                                <span class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                                    {{ $product->stock_quantity }}
                                                </span>
                                            @else
                                                <span class="text-sm font-semibold text-slate-700">
                                                    {{ $product->stock_quantity }}
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Statut --}}
                                        <td class="px-6 py-4 text-center">
                                            @if ($product->is_active)
                                                <span class="inline-flex rounded-lg bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                                    Actif
                                                </span>
                                            @else
                                                <span class="inline-flex rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-500">
                                                    Inactif
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Actions --}}
                                        <td class="px-6 py-4">
                                            <div class="flex justify-end gap-2">

                                                <a
                                                    href="{{ route('products.edit', $product) }}"
                                                    class="rounded-lg px-3 py-2 text-sm font-medium text-sellia-700 transition hover:bg-sellia-50"
                                                >
                                                    Modifier
                                                </a>

                                                {{-- Suppression --}}
                                                <div
                                                    x-data="{ open: false }"
                                                    @keydown.escape.window="open = false"
                                                >
                                                    <button
                                                        type="button"
                                                        @click="open = true"
                                                        class="rounded-lg px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50"
                                                    >
                                                        Supprimer
                                                    </button>

                                                    <div
                                                        x-show="open"
                                                        x-cloak
                                                        class="fixed inset-0 z-50 overflow-y-auto"
                                                        role="dialog"
                                                        aria-modal="true"
                                                    >
                                                        <div
                                                            x-show="open"
                                                            x-transition.opacity
                                                            @click="open = false"
                                                            class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm"
                                                        ></div>

                                                        <div class="flex min-h-full items-center justify-center p-4">

                                                            <div
                                                                x-show="open"
                                                                x-transition:enter="ease-out duration-200"
                                                                x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                                                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                                                x-transition:leave="ease-in duration-150"
                                                                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                                                x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                                                                @click.stop
                                                                class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-xl"
                                                            >

                                                                <div class="p-6">

                                                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-red-50">
                                                                        <svg
                                                                            class="h-6 w-6 text-red-600"
                                                                            fill="none"
                                                                            viewBox="0 0 24 24"
                                                                            stroke="currentColor"
                                                                            stroke-width="1.8"
                                                                        >
                                                                            <path
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                d="M12 9v3.75m0 3.75h.007M10.29 3.86l-7.04 12.2A2 2 0 0 0 4.98 19h14.04a2 2 0 0 0 1.73-2.94l-7.04-12.2a2 2 0 0 0-3.42 0Z"
                                                                            />
                                                                        </svg>
                                                                    </div>

                                                                    <div class="mt-5">
                                                                        <h3 class="text-lg font-semibold text-slate-900">
                                                                            Supprimer ce produit ?
                                                                        </h3>

                                                                        <p class="mt-2 text-sm leading-6 text-slate-500">
                                                                            Vous êtes sur le point de supprimer
                                                                            <span class="font-semibold text-slate-700">
                                                                                « {{ $product->name }} »
                                                                            </span>.
                                                                            Cette action est irréversible.
                                                                        </p>
                                                                    </div>

                                                                </div>

                                                                <div class="flex items-center justify-end gap-3 border-t border-slate-100 bg-slate-50 px-6 py-4">

                                                                    <button
                                                                        type="button"
                                                                        @click="open = false"
                                                                        class="rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-200"
                                                                    >
                                                                        Annuler
                                                                    </button>

                                                                    <form
                                                                        method="POST"
                                                                        action="{{ route('products.destroy', $product) }}"
                                                                    >
                                                                        @csrf
                                                                        @method('DELETE')

                                                                        <button
                                                                            type="submit"
                                                                            class="rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                                                        >
                                                                            Oui, supprimer
                                                                        </button>
                                                                    </form>

                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    {{-- Version mobile --}}
                    <div class="divide-y divide-slate-100 md:hidden">

                        @foreach ($products as $product)

                            <div class="p-5">

                                <div class="flex items-start justify-between gap-4">

                                    <div class="min-w-0">
                                        <h3 class="font-semibold text-slate-900">
                                            {{ $product->name }}
                                        </h3>

                                        @if ($product->sku)
                                            <p class="mt-1 text-xs text-slate-400">
                                                Réf. {{ $product->sku }}
                                            </p>
                                        @endif
                                    </div>

                                    @if ($product->is_active)
                                        <span class="shrink-0 rounded-lg bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                            Actif
                                        </span>
                                    @else
                                        <span class="shrink-0 rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-500">
                                            Inactif
                                        </span>
                                    @endif

                                </div>

                                <div class="mt-4 grid grid-cols-2 gap-4">

                                    <div>
                                        <p class="text-xs font-medium text-slate-400">
                                            Catégorie
                                        </p>

                                        <p class="mt-1 text-sm font-medium text-slate-700">
                                            {{ $product->category?->name ?? 'Sans catégorie' }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-xs font-medium text-slate-400">
                                            Prix de vente
                                        </p>

                                        <p class="mt-1 text-sm font-semibold text-slate-900">
                                            {{ number_format($product->selling_price, 0, ',', ' ') }}
                                            FCFA
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-xs font-medium text-slate-400">
                                            Stock
                                        </p>

                                        <p class="mt-1 text-sm font-semibold {{ $product->isLowStock() ? 'text-amber-600' : 'text-slate-700' }}">
                                            {{ $product->stock_quantity }}

                                            @if ($product->isLowStock())
                                                <span class="text-xs font-medium">
                                                    · Stock faible
                                                </span>
                                            @endif
                                        </p>
                                    </div>

                                </div>

                                <div class="mt-5 flex items-center gap-2 border-t border-slate-100 pt-4">

                                    <a
                                        href="{{ route('products.edit', $product) }}"
                                        class="flex-1 rounded-xl border border-slate-200 px-4 py-2.5 text-center text-sm font-semibold text-sellia-700 transition hover:bg-sellia-50"
                                    >
                                        Modifier
                                    </a>

                                    <x-delete-dialog
                                        :action="route('products.destroy', $product)"
                                        title="Supprimer le produit ?"
                                        :message="'Vous êtes sur le point de supprimer « ' . $product->name . ' ». Cette action est irréversible.'"
                                    />

                                </div>

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>
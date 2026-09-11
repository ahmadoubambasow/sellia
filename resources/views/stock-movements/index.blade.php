<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-sellia-700">
                    Gestion commerciale
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                    Mouvements de stock
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Suivez toutes les entrées, sorties et corrections de stock.
                </p>
            </div>

            <a
                href="{{ route('stock-movements.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-sellia-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-sellia-800"
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
                        d="M12 4v16m8-8H4"
                    />
                </svg>

                Nouveau mouvement
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8 sm:py-10">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Statistiques --}}
            <div class="grid gap-4 sm:grid-cols-3">

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">
                        Total des mouvements
                    </p>

                    <p class="mt-2 text-2xl font-bold text-slate-900">
                        {{ $movements->count() }}
                    </p>
                </div>

                <div class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">
                        Entrées
                    </p>

                    <p class="mt-2 text-2xl font-bold text-emerald-600">
                        {{ $movements->where('type', 'entry')->count() }}
                    </p>
                </div>

                <div class="rounded-2xl border border-red-100 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">
                        Sorties
                    </p>

                    <p class="mt-2 text-2xl font-bold text-red-600">
                        {{ $movements->where('type', 'exit')->count() }}
                    </p>
                </div>

            </div>

            {{-- Liste --}}
            <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                @if ($movements->isEmpty())

                    <div class="px-6 py-16 text-center">

                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-500">
                            <svg
                                class="h-7 w-7"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 016 0M9 5h6"
                                />
                            </svg>
                        </div>

                        <h3 class="mt-4 text-lg font-semibold text-slate-900">
                            Aucun mouvement de stock
                        </h3>

                        <p class="mx-auto mt-2 max-w-md text-sm text-slate-500">
                            Les entrées, sorties et ajustements de stock
                            apparaîtront ici.
                        </p>

                        <a
                            href="{{ route('stock-movements.create') }}"
                            class="mt-6 inline-flex items-center rounded-xl bg-sellia-700 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-sellia-800"
                        >
                            Ajouter un mouvement
                        </a>

                    </div>

                @else

                    {{-- Desktop --}}
                    <div class="hidden overflow-x-auto md:block">

                        <table class="min-w-full divide-y divide-slate-100">

                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Produit
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Type
                                    </th>

                                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Quantité
                                    </th>

                                    <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Stock
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Motif
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Utilisateur
                                    </th>

                                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Date
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100">

                                @foreach ($movements as $movement)

                                    <tr class="transition hover:bg-slate-50">

                                        <td class="whitespace-nowrap px-6 py-4">
                                            <div class="font-semibold text-slate-900">
                                                {{ $movement->product->name }}
                                            </div>

                                            @if ($movement->product->sku)
                                                <div class="mt-0.5 text-xs text-slate-400">
                                                    {{ $movement->product->sku }}
                                                </div>
                                            @endif
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4">

                                            @if ($movement->type === 'entry')

                                                <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                                    Entrée
                                                </span>

                                            @elseif ($movement->type === 'exit')

                                                <span class="inline-flex items-center rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">
                                                    Sortie
                                                </span>

                                            @else

                                                <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                                    Ajustement
                                                </span>

                                            @endif

                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4 text-right">

                                            @if ($movement->type === 'entry')
                                                <span class="font-semibold text-emerald-600">
                                                    +{{ $movement->quantity }}
                                                </span>
                                            @elseif ($movement->type === 'exit')
                                                <span class="font-semibold text-red-600">
                                                    -{{ $movement->quantity }}
                                                </span>
                                            @else
                                                <span class="font-semibold text-amber-600">
                                                    {{ $movement->quantity }}
                                                </span>
                                            @endif

                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4 text-center">
                                            <div class="text-sm text-slate-500">
                                                {{ $movement->stock_before }}
                                                <span class="mx-1 text-slate-300">→</span>
                                                <span class="font-semibold text-slate-900">
                                                    {{ $movement->stock_after }}
                                                </span>
                                            </div>
                                        </td>

                                        <td class="max-w-48 px-6 py-4">
                                            <div class="truncate text-sm text-slate-600">
                                                {{ $movement->reason ?: '—' }}
                                            </div>
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4">
                                            <span class="text-sm font-medium text-slate-700">
                                                {{ $movement->user->name }}
                                            </span>
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4 text-right">
                                            <span class="text-sm text-slate-500">
                                                {{ $movement->created_at->format('d/m/Y H:i') }}
                                            </span>
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    {{-- Mobile --}}
                    <div class="divide-y divide-slate-100 md:hidden">

                        @foreach ($movements as $movement)

                            <div class="p-5">

                                <div class="flex items-start justify-between gap-4">

                                    <div class="min-w-0">
                                        <h3 class="truncate font-semibold text-slate-900">
                                            {{ $movement->product->name }}
                                        </h3>

                                        <p class="mt-1 text-xs text-slate-400">
                                            {{ $movement->created_at->format('d/m/Y à H:i') }}
                                        </p>
                                    </div>

                                    @if ($movement->type === 'entry')
                                        <span class="shrink-0 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                            Entrée
                                        </span>
                                    @elseif ($movement->type === 'exit')
                                        <span class="shrink-0 rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">
                                            Sortie
                                        </span>
                                    @else
                                        <span class="shrink-0 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                            Ajustement
                                        </span>
                                    @endif

                                </div>

                                <div class="mt-4 grid grid-cols-2 gap-4">

                                    <div>
                                        <p class="text-xs text-slate-400">
                                            Quantité
                                        </p>

                                        <p class="mt-1 font-semibold text-slate-900">
                                            {{ $movement->quantity }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-xs text-slate-400">
                                            Stock
                                        </p>

                                        <p class="mt-1 font-semibold text-slate-900">
                                            {{ $movement->stock_before }}
                                            <span class="text-slate-300">→</span>
                                            {{ $movement->stock_after }}
                                        </p>
                                    </div>

                                </div>

                                @if ($movement->reason)
                                    <div class="mt-4">
                                        <p class="text-xs text-slate-400">
                                            Motif
                                        </p>

                                        <p class="mt-1 text-sm text-slate-600">
                                            {{ $movement->reason }}
                                        </p>
                                    </div>
                                @endif

                                <div class="mt-4 border-t border-slate-100 pt-4">
                                    <p class="text-xs text-slate-400">
                                        Effectué par
                                    </p>

                                    <p class="mt-1 text-sm font-medium text-slate-700">
                                        {{ $movement->user->name }}
                                    </p>
                                </div>

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>
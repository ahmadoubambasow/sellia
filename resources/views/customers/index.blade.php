<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold tracking-tight text-slate-900">
                    Clients
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Gérez les clients de votre boutique.
                </p>
            </div>

            <a
                href="{{ route('customers.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-sellia-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-sellia-800 focus:outline-none focus:ring-2 focus:ring-sellia-500 focus:ring-offset-2"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>

                Nouveau client
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Statistique --}}
            <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-sellia-50 text-sellia-700">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1m-4 6H3v-2a4 4 0 014-4h4a4 4 0 014 4v2zm-2-10a4 4 0 11-8 0 4 4 0 018 0zm7 1a3 3 0 10-2.83-4" />
                        </svg>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">
                            Total des clients
                        </p>

                        <p class="text-2xl font-bold text-slate-900">
                            {{ $customers->count() }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Recherche --}}
            <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <form
                    method="GET"
                    action="{{ route('customers.index') }}"
                    class="flex flex-col gap-3 sm:flex-row"
                >
                    <div class="relative flex-1">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />
                            </svg>
                        </div>

                        <input
                            type="search"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Rechercher par nom, téléphone ou e-mail..."
                            class="w-full rounded-xl border-slate-200 py-2.5 pl-10 pr-4 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                        >
                    </div>

                    <button
                        type="submit"
                        class="rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800"
                    >
                        Rechercher
                    </button>

                    @if($search)
                        <a
                            href="{{ route('customers.index') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                        >
                            Réinitialiser
                        </a>
                    @endif
                </form>
            </div>

            {{-- Tableau desktop --}}
            <div class="hidden overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm md:block">

                @if($customers->isEmpty())

                    <div class="px-6 py-16 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M17 20h5v-2a4 4 0 00-4-4h-1m-4 6H3v-2a4 4 0 014-4h4a4 4 0 014 4v2zm-2-10a4 4 0 11-8 0 4 4 0 018 0zm7 1a3 3 0 10-2.83-4" />
                            </svg>
                        </div>

                        <h3 class="mt-5 text-lg font-semibold text-slate-900">
                            {{ $search ? 'Aucun client trouvé' : 'Aucun client pour le moment' }}
                        </h3>

                        <p class="mx-auto mt-2 max-w-md text-sm text-slate-500">
                            {{ $search
                                ? 'Essayez une autre recherche.'
                                : 'Ajoutez votre premier client pour commencer à constituer votre fichier client.'
                            }}
                        </p>

                        @if(!$search)
                            <a
                                href="{{ route('customers.create') }}"
                                class="mt-6 inline-flex items-center gap-2 rounded-xl bg-sellia-700 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-sellia-800"
                            >
                                Ajouter un client
                            </a>
                        @endif
                    </div>

                @else

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-100">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Client
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Téléphone
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        E-mail
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Adresse
                                    </th>

                                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100">
                                @foreach($customers as $customer)
                                    <tr class="transition hover:bg-slate-50">

                                        <td class="whitespace-nowrap px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-sellia-50 text-sm font-bold text-sellia-700">
                                                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                                                </div>

                                                <div>
                                                    <p class="font-semibold text-slate-900">
                                                        {{ $customer->name }}
                                                    </p>

                                                    @if($customer->notes)
                                                        <p class="mt-0.5 max-w-xs truncate text-xs text-slate-400">
                                                            {{ $customer->notes }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">
                                            {{ $customer->phone ?: '—' }}
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">
                                            {{ $customer->email ?: '—' }}
                                        </td>

                                        <td class="max-w-xs truncate px-6 py-4 text-sm text-slate-600">
                                            {{ $customer->address ?: '—' }}
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-4">
                                            <div class="flex items-center justify-end gap-2">
                                                <a
                                                    href="{{ route('customers.edit', $customer) }}"
                                                    class="rounded-lg px-3 py-2 text-sm font-medium text-sellia-700 transition hover:bg-sellia-50"
                                                >
                                                    Modifier
                                                </a>

                                                <x-delete-dialog
                                                    :action="route('customers.destroy', $customer)"
                                                    title="Supprimer le client ?"
                                                    :message="'Vous êtes sur le point de supprimer « ' . $customer->name . ' ». Cette action est irréversible.'"
                                                />
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                @endif

            </div>

            {{-- Cartes mobile --}}
            <div class="space-y-4 md:hidden">

                @forelse($customers as $customer)

                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                        <div class="flex items-start justify-between gap-4">
                            <div class="flex min-w-0 items-center gap-3">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-sellia-50 font-bold text-sellia-700">
                                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                                </div>

                                <div class="min-w-0">
                                    <h3 class="truncate font-semibold text-slate-900">
                                        {{ $customer->name }}
                                    </h3>

                                    @if($customer->phone)
                                        <p class="mt-1 text-sm text-slate-500">
                                            {{ $customer->phone }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 space-y-3 border-t border-slate-100 pt-4">

                            @if($customer->email)
                                <div class="flex gap-3 text-sm">
                                    <svg class="mt-0.5 h-4 w-4 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l9 6 9-6M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />
                                    </svg>

                                    <span class="break-all text-slate-600">
                                        {{ $customer->email }}
                                    </span>
                                </div>
                            @endif

                            @if($customer->address)
                                <div class="flex gap-3 text-sm">
                                    <svg class="mt-0.5 h-4 w-4 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21s7-4.35 7-10a7 7 0 10-14 0c0 5.65 7 10 7 10zm0-8a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>

                                    <span class="text-slate-600">
                                        {{ $customer->address }}
                                    </span>
                                </div>
                            @endif

                        </div>

                        <div class="mt-5 flex items-center justify-end gap-2 border-t border-slate-100 pt-4">
                            <a
                                href="{{ route('customers.edit', $customer) }}"
                                class="rounded-lg px-3 py-2 text-sm font-semibold text-sellia-700 transition hover:bg-sellia-50"
                            >
                                Modifier
                            </a>

                            <x-delete-dialog
                                :action="route('customers.destroy', $customer)"
                                title="Supprimer le client ?"
                                :message="'Vous êtes sur le point de supprimer « ' . $customer->name . ' ». Cette action est irréversible.'"
                            />
                        </div>

                    </div>

                @empty

                    <div class="rounded-2xl border border-slate-200 bg-white px-6 py-12 text-center shadow-sm">
                        <h3 class="font-semibold text-slate-900">
                            {{ $search ? 'Aucun client trouvé' : 'Aucun client pour le moment' }}
                        </h3>

                        <p class="mt-2 text-sm text-slate-500">
                            {{ $search
                                ? 'Essayez une autre recherche.'
                                : 'Commencez par ajouter votre premier client.'
                            }}
                        </p>
                    </div>

                @endforelse

            </div>

        </div>
    </div>

</x-app-layout>
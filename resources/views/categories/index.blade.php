<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-sm font-medium text-sellia-700">
                    Gestion commerciale
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                    Catégories
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Organisez vos produits par catégorie.
                </p>
            </div>

            <a
                href="{{ route('categories.create') }}"
                class="inline-flex items-center justify-center rounded-xl bg-sellia-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-sellia-800 focus:outline-none focus:ring-2 focus:ring-sellia-500 focus:ring-offset-2"
            >
                <svg
                    class="mr-2 h-4 w-4"
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

                Nouvelle catégorie
            </a>

        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-10 sm:py-12">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">


            @if($categories->isEmpty())

                <div class="rounded-3xl border border-slate-200 bg-white px-6 py-14 text-center shadow-sm">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-sellia-50">
                        <svg
                            class="h-7 w-7 text-sellia-700"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M20 13V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v7m16 0v5a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-5m16 0H4"
                            />
                        </svg>
                    </div>

                    <h3 class="mt-5 text-lg font-semibold text-slate-900">
                        Aucune catégorie
                    </h3>

                    <p class="mx-auto mt-2 max-w-md text-sm text-slate-500">
                        Commencez par créer une catégorie pour organiser
                        les produits de votre boutique.
                    </p>

                    <a
                        href="{{ route('categories.create') }}"
                        class="mt-6 inline-flex items-center rounded-xl bg-sellia-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-sellia-800"
                    >
                        Créer une catégorie
                    </a>

                </div>

            @else

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-6 py-5">
                        <p class="text-sm text-slate-500">
                            {{ $categories->count() }}
                            {{ $categories->count() > 1 ? 'catégories enregistrées' : 'catégorie enregistrée' }}
                        </p>
                    </div>

                    <div class="divide-y divide-slate-100">

                        @foreach($categories as $category)

                            <div class="flex flex-col gap-4 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                                <div class="flex items-center gap-4">

                                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-sellia-50">
                                        <svg
                                            class="h-5 w-5 text-sellia-700"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3 7.5A2.5 2.5 0 0 1 5.5 5H10l2 2h6.5A2.5 2.5 0 0 1 21 9.5v7a2.5 2.5 0 0 1-2.5 2.5h-13A2.5 2.5 0 0 1 3 16.5v-9Z"
                                            />
                                        </svg>
                                    </div>

                                    <div>
                                        <h3 class="font-semibold text-slate-900">
                                            {{ $category->name }}
                                        </h3>

                                        @if($category->description)
                                            <p class="mt-1 text-sm text-slate-500">
                                                {{ $category->description }}
                                            </p>
                                        @else
                                            <p class="mt-1 text-sm text-slate-400">
                                                Aucune description
                                            </p>
                                        @endif
                                    </div>

                                </div>

                                <div class="flex items-center gap-2">

                                    <a
                                        href="{{ route('categories.edit', $category) }}"
                                        class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100 hover:text-sellia-700"
                                    >
                                        Modifier
                                    </a>

                                    <div
                                        x-data="{ open: false }"
                                        @keydown.escape.window="open = false"
                                    >
                                        {{-- Bouton supprimer --}}
                                        <button
                                            type="button"
                                            @click="open = true"
                                            class="rounded-lg px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50"
                                        >
                                            Supprimer
                                        </button>

                                        {{-- Dialogue --}}
                                        <div
                                            x-show="open"
                                            x-cloak
                                            class="fixed inset-0 z-50 overflow-y-auto"
                                            aria-labelledby="delete-category-title"
                                            role="dialog"
                                            aria-modal="true"
                                        >
                                            {{-- Fond --}}
                                            <div
                                                x-show="open"
                                                x-transition.opacity
                                                @click="open = false"
                                                class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm"
                                            ></div>

                                            {{-- Conteneur --}}
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

                                                    {{-- Contenu --}}
                                                    <div class="p-6">

                                                        {{-- Icône --}}
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

                                                        {{-- Texte --}}
                                                        <div class="mt-5">

                                                            <h3
                                                                id="delete-category-title"
                                                                class="text-lg font-semibold text-slate-900"
                                                            >
                                                                Supprimer cette catégorie ?
                                                            </h3>

                                                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                                                Vous êtes sur le point de supprimer
                                                                <span class="font-semibold text-slate-700">
                                                                    « {{ $category->name }} »
                                                                </span>.
                                                                Cette action est irréversible.
                                                            </p>

                                                        </div>

                                                    </div>

                                                    {{-- Actions --}}
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
                                                            action="{{ route('categories.destroy', $category) }}"
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

                            </div>

                        @endforeach

                    </div>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>
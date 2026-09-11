<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-sm font-medium text-sellia-700">
                Gestion commerciale
            </p>

            <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                Nouvelle catégorie
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Créez une catégorie pour organiser vos produits.
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-10 sm:py-12">

        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">

            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                <form
                    method="POST"
                    action="{{ route('categories.store') }}"
                    class="space-y-6 p-6 sm:p-8"
                >
                    @csrf

                    <div>
                        <label
                            for="name"
                            class="block text-sm font-medium text-slate-700"
                        >
                            Nom de la catégorie
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            placeholder="Ex. Boissons"
                            class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                        >

                        @error('name')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label
                            for="description"
                            class="block text-sm font-medium text-slate-700"
                        >
                            Description
                            <span class="font-normal text-slate-400">
                                (facultatif)
                            </span>
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            placeholder="Décrivez cette catégorie..."
                            class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-6">

                        <a
                            href="{{ route('categories.index') }}"
                            class="rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-100"
                        >
                            Annuler
                        </a>

                        <button
                            type="submit"
                            class="rounded-xl bg-sellia-700 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-sellia-800 focus:outline-none focus:ring-2 focus:ring-sellia-500 focus:ring-offset-2"
                        >
                            Créer la catégorie
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
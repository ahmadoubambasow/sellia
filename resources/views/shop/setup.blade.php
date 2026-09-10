<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-sm font-medium text-sellia-700">
                Configuration de SELLIA
            </p>

            <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                Votre boutique
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Quelques informations suffisent pour commencer à gérer votre activité.
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-10 sm:py-14">

        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">

            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                {{-- En-tête --}}
                <div class="border-b border-slate-100 px-6 py-7 sm:px-8">

                    <div class="flex items-center gap-4">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-sellia-50">
                            <svg
                                class="h-6 w-6 text-sellia-700"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 10.5 12 4l9 6.5M5 9.5V20h14V9.5M9 20v-6h6v6"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-slate-900">
                                Configurez votre boutique
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Cette boutique sera votre espace de gestion commerciale.
                            </p>
                        </div>

                    </div>

                </div>

                {{-- Formulaire --}}
                <form
                    method="POST"
                    action="{{ route('shop.store') }}"
                    class="space-y-6 px-6 py-7 sm:px-8"
                >
                    @csrf

                    {{-- Nom --}}
                    <div>
                        <label
                            for="name"
                            class="block text-sm font-medium text-slate-700"
                        >
                            Nom de la boutique
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            placeholder="Ex. Boutique Abdou"
                            class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                        >

                        @error('name')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div>
                        <label
                            for="description"
                            class="block text-sm font-medium text-slate-700"
                        >
                            Description
                            <span class="font-normal text-slate-400">(facultatif)</span>
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            placeholder="Présentez brièvement votre activité..."
                            class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Téléphone --}}
                    <div>
                        <label
                            for="phone"
                            class="block text-sm font-medium text-slate-700"
                        >
                            Téléphone
                            <span class="font-normal text-slate-400">(facultatif)</span>
                        </label>

                        <input
                            id="phone"
                            name="phone"
                            type="text"
                            value="{{ old('phone') }}"
                            placeholder="Ex. 77 000 00 00"
                            class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                        >

                        @error('phone')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Adresse --}}
                    <div>
                        <label
                            for="address"
                            class="block text-sm font-medium text-slate-700"
                        >
                            Adresse
                            <span class="font-normal text-slate-400">(facultatif)</span>
                        </label>

                        <input
                            id="address"
                            name="address"
                            type="text"
                            value="{{ old('address') }}"
                            placeholder="Ex. Thiès, Sénégal"
                            class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                        >

                        @error('address')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Devise --}}
                    <div>
                        <label
                            for="currency"
                            class="block text-sm font-medium text-slate-700"
                        >
                            Devise
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="currency"
                            name="currency"
                            required
                            class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                        >
                            <option
                                value="XOF"
                                {{ old('currency', 'XOF') === 'XOF' ? 'selected' : '' }}
                            >
                                FCFA — Franc CFA (XOF)
                            </option>
                        </select>

                        <p class="mt-2 text-xs text-slate-500">
                            Cette devise sera utilisée pour vos prix, ventes et statistiques.
                        </p>

                        @error('currency')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Bouton --}}
                    <div class="flex items-center justify-end border-t border-slate-100 pt-6">

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-sellia-700 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-sellia-800 focus:outline-none focus:ring-2 focus:ring-sellia-500 focus:ring-offset-2"
                        >
                            Créer ma boutique
                        </button>

                    </div>

                </form>

            </div>

            <p class="mt-5 text-center text-xs text-slate-400">
                SELLIA — Gérez. Vendez. Progressez.
            </p>

        </div>

    </div>

</x-app-layout>
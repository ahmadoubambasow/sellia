<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-sm font-medium text-sellia-700">
                Gestion du stock
            </p>

            <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                Nouveau mouvement
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Enregistrez une entrée, une sortie ou un ajustement de stock.
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8 sm:py-10">

        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

            <form
                method="POST"
                action="{{ route('stock-movements.store') }}"
                x-data="{
                    type: '{{ old('type', 'entry') }}',
                    quantity: {{ old('quantity', 1) }},
                    stock: null,

                    get label() {
                        if (this.type === 'entry') {
                            return 'Entrée de stock';
                        }

                        if (this.type === 'exit') {
                            return 'Sortie de stock';
                        }

                        return 'Ajustement de stock';
                    }
                }"
                class="space-y-6"
            >

                @csrf

                {{-- Informations --}}
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-6 py-5">
                        <h3 class="font-semibold text-slate-900">
                            Informations du mouvement
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Choisissez le produit et le type d'opération.
                        </p>
                    </div>

                    <div class="space-y-6 p-6">

                        {{-- Produit --}}
                        <div>
                            <label
                                for="product_id"
                                class="block text-sm font-semibold text-slate-700"
                            >
                                Produit
                            </label>

                            <select
                                id="product_id"
                                name="product_id"
                                required
                                class="mt-2 block w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                            >
                                <option value="">
                                    Sélectionner un produit
                                </option>

                                @foreach ($products as $product)
                                    <option
                                        value="{{ $product->id }}"
                                        {{ old('product_id') == $product->id ? 'selected' : '' }}
                                    >
                                        {{ $product->name }}
                                        — Stock actuel : {{ $product->stock_quantity }}
                                    </option>
                                @endforeach
                            </select>

                            @error('product_id')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Type --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700">
                                Type de mouvement
                            </label>

                            <div class="mt-3 grid gap-3 sm:grid-cols-3">

                                <label class="cursor-pointer">
                                    <input
                                        type="radio"
                                        name="type"
                                        value="entry"
                                        class="peer sr-only"
                                        x-model="type"
                                        {{ old('type', 'entry') === 'entry' ? 'checked' : '' }}
                                    >

                                    <div class="rounded-xl border border-slate-200 p-4 transition peer-checked:border-emerald-500 peer-checked:bg-emerald-50">
                                        <p class="font-semibold text-slate-900">
                                            Entrée
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            Ajouter du stock
                                        </p>
                                    </div>
                                </label>

                                <label class="cursor-pointer">
                                    <input
                                        type="radio"
                                        name="type"
                                        value="exit"
                                        class="peer sr-only"
                                        x-model="type"
                                        {{ old('type') === 'exit' ? 'checked' : '' }}
                                    >

                                    <div class="rounded-xl border border-slate-200 p-4 transition peer-checked:border-red-500 peer-checked:bg-red-50">
                                        <p class="font-semibold text-slate-900">
                                            Sortie
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            Retirer du stock
                                        </p>
                                    </div>
                                </label>

                                <label class="cursor-pointer">
                                    <input
                                        type="radio"
                                        name="type"
                                        value="adjustment"
                                        class="peer sr-only"
                                        x-model="type"
                                        {{ old('type') === 'adjustment' ? 'checked' : '' }}
                                    >

                                    <div class="rounded-xl border border-slate-200 p-4 transition peer-checked:border-amber-500 peer-checked:bg-amber-50">
                                        <p class="font-semibold text-slate-900">
                                            Ajustement
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            Définir le nouveau stock
                                        </p>
                                    </div>
                                </label>

                            </div>

                            @error('type')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Quantité --}}
                        <div>
                            <label
                                for="quantity"
                                class="block text-sm font-semibold text-slate-700"
                                x-text="type === 'adjustment'
                                    ? 'Nouveau stock'
                                    : 'Quantité'"
                            >
                            </label>

                            <div class="relative mt-2">
                                <input
                                    id="quantity"
                                    name="quantity"
                                    type="number"
                                    min="1"
                                    required
                                    value="{{ old('quantity', 1) }}"
                                    class="block w-full rounded-xl border-slate-300 pr-20 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                                >

                                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-sm text-slate-400">
                                    unités
                                </span>
                            </div>

                            @error('quantity')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                            <p class="mt-2 text-xs text-slate-400">
                                Pour un ajustement, indiquez directement la nouvelle quantité en stock.
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Détails --}}
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-6 py-5">
                        <h3 class="font-semibold text-slate-900">
                            Détails
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Ces informations permettent de retrouver l'origine de l'opération.
                        </p>
                    </div>

                    <div class="space-y-6 p-6">

                        <div>
                            <label
                                for="reason"
                                class="block text-sm font-semibold text-slate-700"
                            >
                                Motif
                            </label>

                            <input
                                id="reason"
                                name="reason"
                                type="text"
                                maxlength="255"
                                value="{{ old('reason') }}"
                                placeholder="Ex. Réapprovisionnement, vente, inventaire..."
                                class="mt-2 block w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                            >

                            @error('reason')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="reference"
                                class="block text-sm font-semibold text-slate-700"
                            >
                                Référence
                                <span class="font-normal text-slate-400">
                                    (facultatif)
                                </span>
                            </label>

                            <input
                                id="reference"
                                name="reference"
                                type="text"
                                maxlength="255"
                                value="{{ old('reference') }}"
                                placeholder="Ex. BL-2026-001"
                                class="mt-2 block w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                            >

                            @error('reference')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="notes"
                                class="block text-sm font-semibold text-slate-700"
                            >
                                Notes
                                <span class="font-normal text-slate-400">
                                    (facultatif)
                                </span>
                            </label>

                            <textarea
                                id="notes"
                                name="notes"
                                rows="4"
                                maxlength="2000"
                                placeholder="Ajoutez une information complémentaire..."
                                class="mt-2 block w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                            >{{ old('notes') }}</textarea>

                            @error('notes')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('stock-movements.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                    >
                        Annuler
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-sellia-700 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-sellia-800"
                    >
                        Enregistrer le mouvement
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>
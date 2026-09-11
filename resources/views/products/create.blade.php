<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-sm font-medium text-sellia-700">
                Gestion commerciale
            </p>

            <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                Nouveau produit
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Ajoutez un produit à votre catalogue et définissez ses informations de stock et de prix.
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8 sm:py-10">

        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            <form
                method="POST"
                action="{{ route('products.store') }}"
                x-data="{
                    purchasePrice: {{ old('purchase_price', 0) }},
                    sellingPrice: {{ old('selling_price', 0) }},

                    get margin() {
                        return Math.max(
                            0,
                            Number(this.sellingPrice || 0) -
                            Number(this.purchasePrice || 0)
                        );
                    },

                    get marginRate() {
                        const purchase = Number(this.purchasePrice || 0);

                        if (purchase <= 0) {
                            return 0;
                        }

                        return (this.margin / purchase) * 100;
                    }
                }"
            >

                @csrf

                <div class="space-y-6">

                    {{-- Informations générales --}}
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                        <div class="border-b border-slate-100 px-6 py-5">
                            <h3 class="text-base font-semibold text-slate-900">
                                Informations générales
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Les informations principales de votre produit.
                            </p>
                        </div>

                        <div class="space-y-6 p-6">

                            {{-- Nom + SKU --}}
                            <div class="grid gap-6 md:grid-cols-2">

                                <div>
                                    <x-input-label
                                        for="name"
                                        value="Nom du produit"
                                    />

                                    <x-text-input
                                        id="name"
                                        name="name"
                                        type="text"
                                        class="mt-2 block w-full"
                                        :value="old('name')"
                                        placeholder="Ex. Riz parfumé 25 kg"
                                        required
                                        autofocus
                                    />

                                    <x-input-error
                                        :messages="$errors->get('name')"
                                        class="mt-2"
                                    />
                                </div>

                                <div>
                                    <x-input-label
                                        for="sku"
                                        value="Référence / SKU"
                                    />

                                    <x-text-input
                                        id="sku"
                                        name="sku"
                                        type="text"
                                        class="mt-2 block w-full"
                                        :value="old('sku')"
                                        placeholder="Ex. RIZ-25KG-001"
                                    />

                                    <p class="mt-1.5 text-xs text-slate-400">
                                        Facultatif. Utilisez une référence unique pour identifier rapidement le produit.
                                    </p>

                                    <x-input-error
                                        :messages="$errors->get('sku')"
                                        class="mt-2"
                                    />
                                </div>

                            </div>

                            {{-- Catégorie --}}
                            <div>

                                <x-input-label
                                    for="category_id"
                                    value="Catégorie"
                                />

                                <select
                                    id="category_id"
                                    name="category_id"
                                    class="mt-2 block w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                                >
                                    <option value="">
                                        Sans catégorie
                                    </option>

                                    @foreach ($categories as $category)
                                        <option
                                            value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                                        >
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <p class="mt-1.5 text-xs text-slate-400">
                                    Vous pourrez modifier la catégorie plus tard.
                                </p>

                                <x-input-error
                                    :messages="$errors->get('category_id')"
                                    class="mt-2"
                                />

                            </div>

                            {{-- Description --}}
                            <div>

                                <x-input-label
                                    for="description"
                                    value="Description"
                                />

                                <textarea
                                    id="description"
                                    name="description"
                                    rows="4"
                                    class="mt-2 block w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                                    placeholder="Décrivez brièvement le produit..."
                                >{{ old('description') }}</textarea>

                                <x-input-error
                                    :messages="$errors->get('description')"
                                    class="mt-2"
                                />

                            </div>

                        </div>

                    </div>

                    {{-- Prix --}}
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                        <div class="border-b border-slate-100 px-6 py-5">
                            <h3 class="text-base font-semibold text-slate-900">
                                Tarification
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Définissez le prix d'achat et le prix de vente du produit.
                            </p>
                        </div>

                        <div class="p-6">

                            <div class="grid gap-6 md:grid-cols-2">

                                {{-- Prix achat --}}
                                <div>
                                    <x-input-label
                                        for="purchase_price"
                                        value="Prix d'achat"
                                    />

                                    <div class="relative mt-2">
                                        <x-text-input
                                            id="purchase_price"
                                            name="purchase_price"
                                            type="number"
                                            min="0"
                                            step="0.01"
                                            class="block w-full pr-20"
                                            x-model.number="purchasePrice"
                                            placeholder="0"
                                            required
                                        />

                                        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-sm font-medium text-slate-400">
                                            FCFA
                                        </span>
                                    </div>

                                    <x-input-error
                                        :messages="$errors->get('purchase_price')"
                                        class="mt-2"
                                    />
                                </div>

                                {{-- Prix vente --}}
                                <div>
                                    <x-input-label
                                        for="selling_price"
                                        value="Prix de vente"
                                    />

                                    <div class="relative mt-2">
                                        <x-text-input
                                            id="selling_price"
                                            name="selling_price"
                                            type="number"
                                            min="0"
                                            step="0.01"
                                            class="block w-full pr-20"
                                            x-model.number="sellingPrice"
                                            placeholder="0"
                                            required
                                        />

                                        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-sm font-medium text-slate-400">
                                            FCFA
                                        </span>
                                    </div>

                                    <x-input-error
                                        :messages="$errors->get('selling_price')"
                                        class="mt-2"
                                    />
                                </div>

                            </div>

                            {{-- Aperçu marge --}}
                            <div class="mt-6 rounded-2xl border border-sellia-100 bg-sellia-50 p-5">

                                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                                    <div>
                                        <p class="text-sm font-semibold text-slate-900">
                                            Aperçu de la marge
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            Estimation basée sur les prix renseignés.
                                        </p>
                                    </div>

                                    <div class="text-left sm:text-right">
                                        <p
                                            class="text-xl font-bold text-sellia-700"
                                            x-text="
                                                new Intl.NumberFormat('fr-FR').format(margin)
                                                + ' FCFA'
                                            "
                                        ></p>

                                        <p
                                            class="mt-1 text-xs font-medium text-slate-500"
                                            x-text="
                                                'Taux de marge : '
                                                + marginRate.toFixed(1)
                                                + ' %'
                                            "
                                        ></p>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Stock --}}
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                        <div class="border-b border-slate-100 px-6 py-5">
                            <h3 class="text-base font-semibold text-slate-900">
                                Gestion du stock
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Indiquez la quantité disponible et le niveau à partir duquel SELLIA doit signaler un stock faible.
                            </p>
                        </div>

                        <div class="space-y-6 p-6">

                            <div class="grid gap-6 md:grid-cols-2">

                                {{-- Quantité --}}
                                <div>
                                    <x-input-label
                                        for="stock_quantity"
                                        value="Quantité en stock"
                                    />

                                    <x-text-input
                                        id="stock_quantity"
                                        name="stock_quantity"
                                        type="number"
                                        min="0"
                                        step="1"
                                        class="mt-2 block w-full"
                                        :value="old('stock_quantity', 0)"
                                        required
                                    />

                                    <x-input-error
                                        :messages="$errors->get('stock_quantity')"
                                        class="mt-2"
                                    />
                                </div>

                                {{-- Seuil --}}
                                <div>
                                    <x-input-label
                                        for="low_stock_threshold"
                                        value="Seuil de stock faible"
                                    />

                                    <x-text-input
                                        id="low_stock_threshold"
                                        name="low_stock_threshold"
                                        type="number"
                                        min="0"
                                        step="1"
                                        class="mt-2 block w-full"
                                        :value="old('low_stock_threshold', 5)"
                                        required
                                    />

                                    <p class="mt-1.5 text-xs text-slate-400">
                                        Une alerte sera affichée lorsque le stock sera inférieur ou égal à ce seuil.
                                    </p>

                                    <x-input-error
                                        :messages="$errors->get('low_stock_threshold')"
                                        class="mt-2"
                                    />
                                </div>

                            </div>

                            {{-- Statut --}}
                            <div class="rounded-xl border border-slate-200 p-4">

                                <label class="flex cursor-pointer items-start gap-3">

                                    <input
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        class="mt-0.5 rounded border-slate-300 text-sellia-700 shadow-sm focus:ring-sellia-500"
                                        {{ old('is_active', true) ? 'checked' : '' }}
                                    >

                                    <span>
                                        <span class="block text-sm font-semibold text-slate-800">
                                            Produit actif
                                        </span>

                                        <span class="mt-1 block text-xs leading-5 text-slate-500">
                                            Un produit actif peut être utilisé dans les futures ventes.
                                        </span>
                                    </span>

                                </label>

                            </div>

                        </div>

                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                        <a
                            href="{{ route('products.index') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:bg-slate-50"
                        >
                            Annuler
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-sellia-700 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-sellia-800 focus:outline-none focus:ring-2 focus:ring-sellia-500 focus:ring-offset-2"
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

                            Créer le produit
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>
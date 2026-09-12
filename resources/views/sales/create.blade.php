<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="text-xl font-bold tracking-tight text-slate-900">
                Nouvelle vente
            </h2>

            <p class="text-sm text-slate-500">
                Enregistrez une nouvelle vente et mettez automatiquement le stock à jour.
            </p>
        </div>
    </x-slot>

    <div
        x-data="saleForm()"
        class="min-h-screen bg-slate-50"
    >
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

            {{-- Retour --}}
            <div class="mb-6">
                <a
                    href="{{ route('sales.index') }}"
                    class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-sellia-700"
                >
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>

                    Retour aux ventes
                </a>
            </div>

            <form
                method="POST"
                action="{{ route('sales.store') }}"
                @submit="prepareSubmit"
            >
                @csrf

                <div class="grid gap-6 lg:grid-cols-3">

                    {{-- ===================================================== --}}
                    {{-- COLONNE PRINCIPALE --}}
                    {{-- ===================================================== --}}

                    <div class="space-y-6 lg:col-span-2">

                        {{-- Client --}}
                        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                            <div class="border-b border-slate-100 px-6 py-5">
                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sellia-50 text-sellia-700">
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
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                            />
                                        </svg>
                                    </div>

                                    <div>
                                        <h3 class="font-semibold text-slate-900">
                                            Client
                                        </h3>

                                        <p class="text-sm text-slate-500">
                                            Le client est facultatif.
                                        </p>
                                    </div>

                                </div>
                            </div>

                            <div class="p-6">

                                <label
                                    for="customer_id"
                                    class="mb-2 block text-sm font-medium text-slate-700"
                                >
                                    Client
                                </label>

                                <select
                                    id="customer_id"
                                    name="customer_id"
                                    class="w-full rounded-xl border-slate-300 text-sm shadow-sm transition focus:border-sellia-500 focus:ring-sellia-500"
                                >
                                    <option value="">
                                        Vente comptoir / client non enregistré
                                    </option>

                                    @foreach($customers as $customer)
                                        <option
                                            value="{{ $customer->id }}"
                                            @selected(old('customer_id') == $customer->id)
                                        >
                                            {{ $customer->name }}

                                            @if($customer->phone)
                                                — {{ $customer->phone }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>

                                @error('customer_id')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </section>


                        {{-- Produits --}}
                        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                            <div class="border-b border-slate-100 px-6 py-5">

                                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-accent-500/10 text-accent-600">
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
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                                                />
                                            </svg>
                                        </div>

                                        <div>
                                            <h3 class="font-semibold text-slate-900">
                                                Produits
                                            </h3>

                                            <p class="text-sm text-slate-500">
                                                Ajoutez les produits vendus.
                                            </p>
                                        </div>

                                    </div>

                                    <button
                                        type="button"
                                        @click="addItem()"
                                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-sellia-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-sellia-800 focus:outline-none focus:ring-2 focus:ring-sellia-500 focus:ring-offset-2"
                                    >
                                        <svg
                                            class="h-4 w-4"
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

                                        Ajouter un produit
                                    </button>

                                </div>

                            </div>

                            <div class="p-6">

                                {{-- Aucun produit --}}
                                <template x-if="items.length === 0">

                                    <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-6 py-12 text-center">

                                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-slate-400 shadow-sm">

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
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                                                />
                                            </svg>

                                        </div>

                                        <h4 class="mt-4 font-semibold text-slate-900">
                                            Aucun produit ajouté
                                        </h4>

                                        <p class="mt-1 text-sm text-slate-500">
                                            Commencez par ajouter un produit à cette vente.
                                        </p>

                                        <button
                                            type="button"
                                            @click="addItem()"
                                            class="mt-5 text-sm font-semibold text-sellia-700 hover:text-sellia-800"
                                        >
                                            + Ajouter un produit
                                        </button>

                                    </div>

                                </template>


                                {{-- Produits --}}
                                <div
                                    x-show="items.length > 0"
                                    class="space-y-4"
                                >

                                    <template
                                        x-for="(item, index) in items"
                                        :key="item.key"
                                    >

                                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">

                                            <div class="grid gap-4 md:grid-cols-12 md:items-end">

                                                {{-- Produit --}}
                                                <div class="md:col-span-5">

                                                    <label
                                                        class="mb-2 block text-sm font-medium text-slate-700"
                                                    >
                                                        Produit
                                                    </label>

                                                    <select
                                                        x-model.number="item.product_id"
                                                        @change="updateItem(index)"
                                                        :name="`items[${index}][product_id]`"
                                                        class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                                                    >

                                                        <option value="">
                                                            Sélectionner un produit
                                                        </option>

                                                        @foreach($products as $product)

                                                            <option value="{{ $product->id }}">
                                                                {{ $product->name }}
                                                                —
                                                                {{ number_format($product->selling_price, 0, ',', ' ') }}
                                                                F
                                                            </option>

                                                        @endforeach

                                                    </select>

                                                    <template x-if="item.product_id">

                                                        <p class="mt-2 text-xs text-slate-500">
                                                            Stock disponible :

                                                            <span
                                                                class="font-semibold text-slate-700"
                                                                x-text="getProduct(item.product_id)?.stock_quantity ?? 0"
                                                            ></span>
                                                        </p>

                                                    </template>

                                                </div>


                                                {{-- Quantité --}}
                                                <div class="md:col-span-2">

                                                    <label
                                                        class="mb-2 block text-sm font-medium text-slate-700"
                                                    >
                                                        Quantité
                                                    </label>

                                                    <input
                                                        type="number"
                                                        min="1"
                                                        x-model.number="item.quantity"
                                                        :name="`items[${index}][quantity]`"
                                                        @input="calculate()"
                                                        class="w-full rounded-xl border-slate-300 bg-white text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                                                    >

                                                </div>


                                                {{-- Prix --}}
                                                <div class="md:col-span-2">

                                                    <label
                                                        class="mb-2 block text-sm font-medium text-slate-700"
                                                    >
                                                        Prix unitaire
                                                    </label>

                                                    <div class="flex h-[42px] items-center rounded-xl border border-slate-200 bg-slate-100 px-3 text-sm font-medium text-slate-700">

                                                        <span x-text="formatMoney(item.unit_price)"></span>

                                                        <span class="ml-1 text-xs text-slate-400">
                                                            F
                                                        </span>

                                                    </div>

                                                </div>


                                                {{-- Total ligne --}}
                                                <div class="md:col-span-2">

                                                    <label
                                                        class="mb-2 block text-sm font-medium text-slate-700"
                                                    >
                                                        Total
                                                    </label>

                                                    <div class="flex h-[42px] items-center rounded-xl bg-white px-3 text-sm font-bold text-slate-900 ring-1 ring-slate-200">

                                                        <span x-text="formatMoney(item.total)"></span>

                                                        <span class="ml-1 text-xs font-medium text-slate-400">
                                                            F
                                                        </span>

                                                    </div>

                                                </div>


                                                {{-- Supprimer --}}
                                                <div class="md:col-span-1">

                                                    <button
                                                        type="button"
                                                        @click="removeItem(index)"
                                                        class="flex h-[42px] w-full items-center justify-center rounded-xl border border-red-200 bg-white text-red-600 transition hover:bg-red-50"
                                                        title="Retirer le produit"
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
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h12"
                                                            />
                                                        </svg>

                                                    </button>

                                                </div>

                                            </div>

                                        </div>

                                    </template>

                                </div>


                                @error('items')
                                    <p class="mt-4 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                                @error('items.*.product_id')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                                @error('items.*.quantity')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </section>


                        {{-- Notes --}}
                        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                            <div class="border-b border-slate-100 px-6 py-5">

                                <h3 class="font-semibold text-slate-900">
                                    Notes
                                </h3>

                                <p class="mt-1 text-sm text-slate-500">
                                    Ajoutez une information complémentaire si nécessaire.
                                </p>

                            </div>

                            <div class="p-6">

                                <textarea
                                    name="notes"
                                    rows="4"
                                    maxlength="2000"
                                    placeholder="Ex. Commande spéciale, livraison, remarque..."
                                    class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                                >{{ old('notes') }}</textarea>

                                @error('notes')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </section>

                    </div>


                    {{-- ===================================================== --}}
                    {{-- RÉSUMÉ --}}
                    {{-- ===================================================== --}}

                    <aside class="lg:col-span-1">

                        <div class="sticky top-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                            <div class="border-b border-slate-100 px-6 py-5">

                                <h3 class="font-semibold text-slate-900">
                                    Résumé de la vente
                                </h3>

                                <p class="mt-1 text-sm text-slate-500">
                                    Vérifiez les montants avant validation.
                                </p>

                            </div>


                            <div class="space-y-5 p-6">

                                {{-- Sous-total --}}
                                <div class="flex items-center justify-between">

                                    <span class="text-sm text-slate-500">
                                        Sous-total
                                    </span>

                                    <span class="font-semibold text-slate-900">
                                        <span x-text="formatMoney(subtotal)"></span>
                                        F
                                    </span>

                                </div>


                                {{-- Remise --}}
                                <div>

                                    <label
                                        for="discount"
                                        class="mb-2 block text-sm font-medium text-slate-700"
                                    >
                                        Remise
                                    </label>

                                    <div class="relative">

                                        <input
                                            id="discount"
                                            name="discount"
                                            type="number"
                                            min="0"
                                            step="0.01"
                                            value="{{ old('discount', 0) }}"
                                            x-model.number="discount"
                                            @input="calculate()"
                                            class="w-full rounded-xl border-slate-300 pr-10 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                                        >

                                        <span class="absolute inset-y-0 right-3 flex items-center text-xs font-medium text-slate-400">
                                            F
                                        </span>

                                    </div>

                                    @error('discount')
                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- Total --}}
                                <div class="rounded-2xl bg-sellia-50 p-5">

                                    <p class="text-sm font-medium text-sellia-700">
                                        Total à payer
                                    </p>

                                    <p class="mt-1 text-3xl font-bold tracking-tight text-sellia-800">

                                        <span x-text="formatMoney(total)"></span>

                                        <span class="text-lg">
                                            F
                                        </span>

                                    </p>

                                </div>


                                {{-- Montant payé --}}
                                <div>

                                    <label
                                        for="amount_paid"
                                        class="mb-2 block text-sm font-medium text-slate-700"
                                    >
                                        Montant payé
                                    </label>

                                    <div class="relative">

                                        <input
                                            id="amount_paid"
                                            name="amount_paid"
                                            type="number"
                                            min="0"
                                            step="0.01"
                                            value="{{ old('amount_paid', 0) }}"
                                            x-model.number="amountPaid"
                                            @input="calculate()"
                                            class="w-full rounded-xl border-slate-300 pr-10 text-sm font-semibold shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                                        >

                                        <span class="absolute inset-y-0 right-3 flex items-center text-xs font-medium text-slate-400">
                                            F
                                        </span>

                                    </div>

                                    @error('amount_paid')
                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- Reste --}}
                                <div
                                    class="rounded-xl border p-4"
                                    :class="remaining > 0
                                        ? 'border-amber-200 bg-amber-50'
                                        : 'border-emerald-200 bg-emerald-50'"
                                >

                                    <div class="flex items-center justify-between">

                                        <span
                                            class="text-sm font-medium"
                                            :class="remaining > 0
                                                ? 'text-amber-700'
                                                : 'text-emerald-700'"
                                        >
                                            Reste à payer
                                        </span>

                                        <span
                                            class="font-bold"
                                            :class="remaining > 0
                                                ? 'text-amber-800'
                                                : 'text-emerald-800'"
                                        >
                                            <span x-text="formatMoney(remaining)"></span>
                                            F
                                        </span>

                                    </div>

                                </div>


                                {{-- Mode de paiement --}}
                                <div>

                                    <label
                                        for="payment_method"
                                        class="mb-2 block text-sm font-medium text-slate-700"
                                    >
                                        Mode de paiement
                                    </label>

                                    <select
                                        id="payment_method"
                                        name="payment_method"
                                        x-model="paymentMethod"
                                        class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                                    >

                                        <option value="">
                                            Sélectionner un mode
                                        </option>

                                        <option value="cash">
                                            Espèces
                                        </option>

                                        <option value="wave">
                                            Wave
                                        </option>

                                        <option value="orange_money">
                                            Orange Money
                                        </option>

                                        <option value="card">
                                            Carte bancaire
                                        </option>

                                        <option value="other">
                                            Autre
                                        </option>

                                    </select>

                                    @error('payment_method')
                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- Statut --}}
                                <div class="border-t border-slate-100 pt-5">

                                    <div class="flex items-center justify-between">

                                        <span class="text-sm text-slate-500">
                                            Statut du paiement
                                        </span>

                                        <span
                                            x-show="paymentStatus === 'paid'"
                                            class="inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700"
                                        >
                                            Payée
                                        </span>

                                        <span
                                            x-show="paymentStatus === 'partial'"
                                            class="inline-flex rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700"
                                        >
                                            Partiellement payée
                                        </span>

                                        <span
                                            x-show="paymentStatus === 'unpaid'"
                                            class="inline-flex rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700"
                                        >
                                            Impayée
                                        </span>

                                    </div>

                                </div>


                                {{-- Information paiement --}}
                                <div class="rounded-xl bg-slate-50 p-4">

                                    <div class="flex items-start gap-3">

                                        <svg
                                            class="mt-0.5 h-5 w-5 shrink-0 text-sellia-600"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M13 16h-1v-4h-1m1-4h.01M12 22a10 10 0 100-20 10 10 0 000 20z"
                                            />
                                        </svg>

                                        <p class="text-xs leading-5 text-slate-500">
                                            Le statut du paiement est calculé automatiquement
                                            selon le montant réellement encaissé.
                                        </p>

                                    </div>

                                </div>


                                {{-- Actions --}}
                                <div class="space-y-3">

                                    <button
                                        type="submit"
                                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-sellia-700 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-sellia-800 focus:outline-none focus:ring-2 focus:ring-sellia-500 focus:ring-offset-2"
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
                                                d="M5 13l4 4L19 7"
                                            />
                                        </svg>

                                        Enregistrer la vente

                                    </button>

                                    <a
                                        href="{{ route('sales.index') }}"
                                        class="flex w-full items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                                    >
                                        Annuler
                                    </a>

                                </div>

                            </div>

                        </div>

                    </aside>

                </div>

            </form>

        </div>
    </div>


    @push('scripts')

        <script>
            function saleForm() {
                return {

                    products: @js(
                        $products->map(fn ($product) => [
                            'id' => $product->id,
                            'name' => $product->name,
                            'selling_price' => (float) $product->selling_price,
                            'stock_quantity' => $product->stock_quantity,
                        ])->values()
                    ),

                    items: [],

                    discount: {{ old('discount', 0) }},

                    amountPaid: {{ old('amount_paid', 0) }},

                    paymentMethod: @js(old('payment_method', '')),

                    subtotal: 0,

                    total: 0,

                    remaining: 0,

                    paymentStatus: 'unpaid',


                    init() {

                        @if(old('items'))

                            const oldItems = @js(old('items'));

                            oldItems.forEach((item) => {

                                this.items.push({
                                    key: this.generateKey(),
                                    product_id: Number(item.product_id) || '',
                                    quantity: Number(item.quantity) || 1,
                                    unit_price: 0,
                                    total: 0,
                                });

                            });

                            this.items.forEach((item, index) => {
                                this.updateItem(index);
                            });

                        @else

                            this.addItem();

                        @endif

                        this.calculate();
                    },


                    generateKey() {
                        return Date.now() + Math.random();
                    },


                    addItem() {

                        this.items.push({
                            key: this.generateKey(),
                            product_id: '',
                            quantity: 1,
                            unit_price: 0,
                            total: 0,
                        });

                        this.calculate();
                    },


                    removeItem(index) {

                        this.items.splice(index, 1);

                        this.calculate();
                    },


                    getProduct(productId) {

                        return this.products.find(
                            product => Number(product.id) === Number(productId)
                        );
                    },


                    updateItem(index) {

                        const item = this.items[index];

                        if (!item) {
                            return;
                        }

                        const product = this.getProduct(item.product_id);

                        if (!product) {

                            item.unit_price = 0;
                            item.total = 0;

                            this.calculate();

                            return;
                        }

                        item.unit_price = Number(product.selling_price);

                        item.quantity = Math.max(
                            1,
                            Number(item.quantity) || 1
                        );

                        item.total =
                            item.unit_price * item.quantity;

                        this.calculate();
                    },


                    calculate() {

                        this.items.forEach((item) => {

                            item.quantity = Math.max(
                                1,
                                Number(item.quantity) || 1
                            );

                            item.total =
                                Number(item.unit_price || 0)
                                * Number(item.quantity || 0);

                        });


                        this.subtotal = this.items.reduce(
                            (sum, item) => {
                                return sum + Number(item.total || 0);
                            },
                            0
                        );


                        const remise = Math.max(
                            0,
                            Number(this.discount || 0)
                        );


                        this.total = Math.max(
                            0,
                            this.subtotal - remise
                        );


                        this.amountPaid = Math.max(
                            0,
                            Number(this.amountPaid || 0)
                        );


                        this.remaining = Math.max(
                            0,
                            this.total - this.amountPaid
                        );


                        if (this.amountPaid <= 0) {

                            this.paymentStatus = 'unpaid';

                        } else if (this.amountPaid < this.total) {

                            this.paymentStatus = 'partial';

                        } else {

                            this.paymentStatus = 'paid';

                        }

                    },


                    formatMoney(value) {

                        return new Intl.NumberFormat('fr-FR', {
                            maximumFractionDigits: 0,
                        }).format(
                            Number(value || 0)
                        );

                    },


                    prepareSubmit() {

                        this.calculate();

                    },

                };
            }
        </script>

    @endpush

</x-app-layout>
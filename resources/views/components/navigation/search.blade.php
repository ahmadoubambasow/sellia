<div
    x-data="globalSearch()"
    @click.outside="close()"
    @keydown.escape.window="close()"
    class="relative w-full max-w-xl"
>

    {{-- =========================================================
        FORMULAIRE DE RECHERCHE
    ========================================================== --}}
    <form
        method="GET"
        action="{{ route('search') }}"
        @submit="submitSearch"
        class="relative"
    >

        {{-- Icône --}}
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


        {{-- Champ --}}
        <input
            x-ref="input"
            x-model="query"
            @input.debounce.300ms="search()"
            @focus="handleFocus()"
            type="search"
            name="q"
            autocomplete="off"
            spellcheck="false"
            placeholder="Rechercher..."
            class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-11 pr-14 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-sellia-500 focus:bg-white focus:ring-2 focus:ring-sellia-500/20"
        >


        {{-- Chargement --}}
        <div
            x-show="loading"
            x-cloak
            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4"
        >

            <svg
                class="h-4 w-4 animate-spin text-sellia-600"
                fill="none"
                viewBox="0 0 24 24"
            >
                <circle
                    class="opacity-25"
                    cx="12"
                    cy="12"
                    r="10"
                    stroke="currentColor"
                    stroke-width="4"
                />

                <path
                    class="opacity-75"
                    fill="currentColor"
                    d="M4 12a8 8 0 0 1 8-8v4a4 4 0 0 0-4 4H4Z"
                />
            </svg>

        </div>


        {{-- Raccourci --}}
        <div
            x-show="!loading && !query"
            class="pointer-events-none absolute inset-y-0 right-0 hidden items-center pr-3 sm:flex"
        >

            <span class="rounded-md border border-slate-200 bg-white px-2 py-1 text-[11px] font-medium text-slate-400">
                /
            </span>

        </div>

    </form>


    {{-- =========================================================
        DROPDOWN DES SUGGESTIONS
    ========================================================== --}}
    <div
        x-cloak
        x-show="open"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 -translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute left-0 right-0 top-full z-50 mt-2 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl"
    >

        {{-- Chargement --}}
        <template x-if="loading">

            <div class="flex items-center gap-3 px-5 py-6">

                <svg
                    class="h-5 w-5 animate-spin text-sellia-600"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <circle
                        class="opacity-25"
                        cx="12"
                        cy="12"
                        r="10"
                        stroke="currentColor"
                        stroke-width="4"
                    />

                    <path
                        class="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 0 1 8-8v4a4 4 0 0 0-4 4H4Z"
                    />
                </svg>

                <span class="text-sm text-slate-500">
                    Recherche en cours...
                </span>

            </div>

        </template>


        {{-- Résultats --}}
        <div x-show="!loading">

            {{-- =================================================
                PRODUITS
            ================================================== --}}
            <template x-if="results.products.length > 0">

                <div>

                    <div class="border-b border-slate-100 bg-slate-50 px-4 py-2">

                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">
                            Produits
                        </p>

                    </div>


                    <template
                        x-for="product in results.products"
                        :key="'product-' + product.id"
                    >

                        <a
                            :href="product.url"
                            class="flex items-center gap-3 px-4 py-3 transition hover:bg-slate-50"
                        >

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-sellia-50 text-sellia-700">

                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M20 7.5 12 3 4 7.5m16 0v9L12 21l-8-4.5v-9m16 0-8 4.5m0 9v-9"
                                    />
                                </svg>

                            </div>


                            <div class="min-w-0 flex-1">

                                <p
                                    class="truncate text-sm font-medium text-slate-900"
                                    x-text="product.name"
                                ></p>

                                <p
                                    class="mt-0.5 truncate text-xs text-slate-400"
                                    x-text="product.sku ? 'SKU : ' + product.sku : 'Produit'"
                                ></p>

                            </div>


                            <span
                                class="shrink-0 text-xs text-slate-400"
                                x-text="'Stock : ' + product.stock"
                            ></span>

                        </a>

                    </template>

                </div>

            </template>


            {{-- =================================================
                CLIENTS
            ================================================== --}}
            <template x-if="results.customers.length > 0">

                <div>

                    <div class="border-b border-slate-100 bg-slate-50 px-4 py-2">

                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">
                            Clients
                        </p>

                    </div>


                    <template
                        x-for="customer in results.customers"
                        :key="'customer-' + customer.id"
                    >

                        <a
                            :href="customer.url"
                            class="flex items-center gap-3 px-4 py-3 transition hover:bg-slate-50"
                        >

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-accent-500 text-xs font-bold text-white">
                                <span
                                    x-text="customer.name.charAt(0).toUpperCase()"
                                ></span>
                            </div>


                            <div class="min-w-0 flex-1">

                                <p
                                    class="truncate text-sm font-medium text-slate-900"
                                    x-text="customer.name"
                                ></p>

                                <p
                                    class="mt-0.5 truncate text-xs text-slate-400"
                                    x-text="customer.phone || customer.email || 'Client'"
                                ></p>

                            </div>

                        </a>

                    </template>

                </div>

            </template>


            {{-- =================================================
                VENTES
            ================================================== --}}
            <template x-if="results.sales.length > 0">

                <div>

                    <div class="border-b border-slate-100 bg-slate-50 px-4 py-2">

                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">
                            Ventes
                        </p>

                    </div>


                    <template
                        x-for="sale in results.sales"
                        :key="'sale-' + sale.id"
                    >

                        <a
                            :href="sale.url"
                            class="flex items-center justify-between gap-4 px-4 py-3 transition hover:bg-slate-50"
                        >

                            <div class="min-w-0">

                                <p
                                    class="truncate text-sm font-semibold text-sellia-700"
                                    x-text="sale.reference"
                                ></p>

                                <p
                                    class="mt-0.5 truncate text-xs text-slate-400"
                                    x-text="(sale.customer || 'Client comptant') + ' · ' + sale.date"
                                ></p>

                            </div>


                            <p
                                class="shrink-0 text-sm font-semibold text-slate-900"
                                x-text="formatAmount(sale.total)"
                            ></p>

                        </a>

                    </template>

                </div>

            </template>


            {{-- =================================================
                CATÉGORIES
            ================================================== --}}
            <template x-if="results.categories.length > 0">

                <div>

                    <div class="border-b border-slate-100 bg-slate-50 px-4 py-2">

                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">
                            Catégories
                        </p>

                    </div>


                    <template
                        x-for="category in results.categories"
                        :key="'category-' + category.id"
                    >

                        <a
                            :href="category.url"
                            class="flex items-center gap-3 px-4 py-3 transition hover:bg-slate-50"
                        >

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500">

                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M4 6.5A2.5 2.5 0 0 1 6.5 4h4L20 13.5 13.5 20 4 10.5v-4ZM8 8h.01"
                                    />
                                </svg>

                            </div>


                            <p
                                class="text-sm font-medium text-slate-900"
                                x-text="category.name"
                            ></p>

                        </a>

                    </template>

                </div>

            </template>


            {{-- =================================================
                AUCUN RÉSULTAT
            ================================================== --}}
            <template x-if="!hasResults && query.trim() !== ''">

                <div class="px-5 py-8 text-center">

                    <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-400">

                        <svg
                            class="h-5 w-5"
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


                    <p class="mt-3 text-sm font-medium text-slate-700">
                        Aucun résultat
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Essayez avec un autre terme.
                    </p>

                </div>

            </template>


            {{-- =================================================
                VOIR TOUS LES RÉSULTATS
            ================================================== --}}
            <template x-if="hasResults">

                <a
                    :href="'{{ route('search') }}?q=' + encodeURIComponent(query)"
                    class="flex items-center justify-center gap-2 border-t border-slate-100 bg-slate-50 px-4 py-3 text-sm font-semibold text-sellia-700 transition hover:bg-sellia-50"
                >

                    Voir tous les résultats

                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m9 18 6-6-6-6"
                        />
                    </svg>

                </a>

            </template>

        </div>

    </div>

</div>


{{-- =============================================================
    ALPINE — RECHERCHE GLOBALE
============================================================= --}}
<script>
    function globalSearch() {
        return {
            query: '',
            open: false,
            loading: false,

            results: {
                products: [],
                customers: [],
                sales: [],
                categories: [],
            },

            controller: null,

            init() {
                window.addEventListener('keydown', (event) => {
                    if (
                        event.key === '/' &&
                        !['INPUT', 'TEXTAREA'].includes(
                            document.activeElement?.tagName
                        )
                    ) {
                        event.preventDefault();

                        this.$refs.input.focus();
                    }
                });
            },

            handleFocus() {
                if (this.query.trim() !== '') {
                    this.open = true;
                }
            },

            async search() {
                const term = this.query.trim();

                if (!term) {
                    this.close();

                    this.results = {
                        products: [],
                        customers: [],
                        sales: [],
                        categories: [],
                    };

                    return;
                }

                this.open = true;
                this.loading = true;

                /*
                 * Annule la requête précédente si l'utilisateur
                 * continue à taper.
                 */
                if (this.controller) {
                    this.controller.abort();
                }

                this.controller = new AbortController();

                try {
                    const response = await fetch(
                        `{{ route('search.suggestions') }}?q=${encodeURIComponent(term)}`,
                        {
                            method: 'GET',

                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                            },

                            signal: this.controller.signal,
                        }
                    );

                    if (!response.ok) {
                        throw new Error(
                            'La recherche a échoué.'
                        );
                    }

                    this.results = await response.json();

                } catch (error) {

                    /*
                     * AbortError est normal lorsque l'utilisateur
                     * tape rapidement plusieurs caractères.
                     */
                    if (error.name !== 'AbortError') {
                        console.error(
                            'Erreur recherche SELLIA :',
                            error
                        );

                        this.results = {
                            products: [],
                            customers: [],
                            sales: [],
                            categories: [],
                        };
                    }

                } finally {
                    this.loading = false;
                }
            },

            submitSearch(event) {
                if (!this.query.trim()) {
                    event.preventDefault();
                    return;
                }

                this.close();
            },

            close() {
                this.open = false;
            },

            formatAmount(amount) {
                return Number(amount).toLocaleString('fr-FR')
                    + ' F CFA';
            },

            get hasResults() {
                return (
                    this.results.products.length > 0 ||
                    this.results.customers.length > 0 ||
                    this.results.sales.length > 0 ||
                    this.results.categories.length > 0
                );
            },
        };
    }
</script>
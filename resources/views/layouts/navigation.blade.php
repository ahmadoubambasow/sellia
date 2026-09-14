<nav x-data="{ open: false }" class="border-b border-slate-200 bg-white">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="flex h-16 items-center justify-between gap-6">

            {{-- ==========================================================
                GAUCHE : LOGO + BOUTIQUE
            =========================================================== --}}

            <div class="flex shrink-0 items-center gap-4">

                {{-- Logo SELLIA --}}
                <a
                    href="{{ route('dashboard') }}"
                    class="flex items-center gap-2.5"
                >
                    <x-application-logo
                        class="h-9 w-9 fill-current text-sellia-700"
                    />

                    <div class="hidden sm:block">
                        <span class="block text-lg font-extrabold leading-none tracking-tight text-sellia-700">
                            SELLIA
                        </span>

                        <span class="mt-0.5 block text-[10px] font-medium uppercase tracking-wider text-slate-400">
                            Gestion commerciale
                        </span>
                    </div>
                </a>

                {{-- Séparateur --}}
                @if(auth()->user()->shop)
                    <div class="hidden h-8 w-px bg-slate-200 lg:block"></div>

                    {{-- Boutique --}}
                    <div class="hidden min-w-0 lg:block">
                        <p class="text-[10px] font-semibold uppercase tracking-wider text-slate-400">
                            Boutique
                        </p>

                        <p class="mt-0.5 max-w-40 truncate text-sm font-semibold text-slate-800">
                            {{ auth()->user()->shop->name }}
                        </p>
                    </div>
                @endif

            </div>


            {{-- ==========================================================
                CENTRE : NAVIGATION DESKTOP
            =========================================================== --}}

            <div class="hidden items-center gap-1 md:flex">

                <x-nav-link
                    :href="route('dashboard')"
                    :active="request()->routeIs('dashboard')"
                    class="px-3 py-2"
                >
                    Dashboard
                </x-nav-link>

                <x-nav-link
                    :href="route('categories.index')"
                    :active="request()->routeIs('categories.*')"
                    class="px-3 py-2"
                >
                    Catégories
                </x-nav-link>

                <x-nav-link
                    :href="route('products.index')"
                    :active="request()->routeIs('products.*')"
                    class="px-3 py-2"
                >
                    Produits
                </x-nav-link>

                <x-nav-link
                    :href="route('stock-movements.index')"
                    :active="request()->routeIs('stock-movements.*')"
                    class="px-3 py-2"
                >
                    Stock
                </x-nav-link>

                <x-nav-link
                    :href="route('customers.index')"
                    :active="request()->routeIs('customers.*')"
                    class="px-3 py-2"
                >
                    Clients
                </x-nav-link>

                <x-nav-link
                    :href="route('sales.index')"
                    :active="request()->routeIs('sales.*')"
                    class="px-3 py-2"
                >
                    Ventes
                </x-nav-link>

            </div>


            {{-- ==========================================================
                DROITE : UTILISATEUR
            =========================================================== --}}

            <div class="hidden shrink-0 items-center md:flex">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button
                            type="button"
                            class="inline-flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-sellia-500/20"
                        >

                            {{-- Avatar --}}
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-sellia-100 text-xs font-bold text-sellia-700">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>

                            {{-- Nom --}}
                            <span class="hidden lg:block max-w-32 truncate">
                                {{ Auth::user()->name }}
                            </span>

                            {{-- Chevron --}}
                            <svg
                                class="h-4 w-4 text-slate-400"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>

                        </button>

                    </x-slot>


                    <x-slot name="content">

                        {{-- Informations utilisateur --}}
                        <div class="border-b border-slate-100 px-4 py-3">

                            <p class="text-sm font-semibold text-slate-900">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="mt-0.5 truncate text-xs text-slate-500">
                                {{ Auth::user()->email }}
                            </p>

                        </div>

                        {{-- Profil --}}
                        <x-dropdown-link
                            :href="route('profile.edit')"
                        >
                            <span class="flex items-center gap-2">

                                <svg
                                    class="h-4 w-4 text-slate-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 19a6 6 0 00-12 0M9 13a4 4 0 100-8 4 4 0 000 8zM17 8v6m3-3h-6"
                                    />
                                </svg>

                                <span>Profil</span>

                            </span>
                        </x-dropdown-link>

                        {{-- Déconnexion --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                            >
                                <span class="flex items-center gap-2 text-red-600">

                                    <svg
                                        class="h-4 w-4"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15 12H3m0 0l4-4m-4 4l4 4M14 4h5a2 2 0 012 2v12a2 2 0 01-2 2h-5"
                                        />
                                    </svg>

                                    <span>Se déconnecter</span>

                                </span>
                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>


            {{-- ==========================================================
                MOBILE : BOUTON MENU
            =========================================================== --}}

            <div class="flex items-center md:hidden">

                <button
                    type="button"
                    @click="open = ! open"
                    class="inline-flex items-center justify-center rounded-xl p-2 text-slate-500 transition hover:bg-slate-100 hover:text-slate-700 focus:outline-none focus:ring-2 focus:ring-sellia-500/20"
                    aria-label="Ouvrir le menu"
                >

                    {{-- Menu --}}
                    <svg
                        x-show="!open"
                        class="h-6 w-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>

                    {{-- Fermer --}}
                    <svg
                        x-show="open"
                        x-cloak
                        class="h-6 w-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>

                </button>

            </div>

        </div>

    </div>


    {{-- ==============================================================
        MENU MOBILE
    =============================================================== --}}

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="border-t border-slate-100 bg-white md:hidden"
    >

        <div class="space-y-1 px-4 py-4">

            {{-- Boutique --}}
            @if(auth()->user()->shop)
                <div class="mb-4 rounded-xl bg-slate-50 px-4 py-3">

                    <p class="text-[10px] font-semibold uppercase tracking-wider text-slate-400">
                        Boutique
                    </p>

                    <p class="mt-1 truncate text-sm font-semibold text-slate-800">
                        {{ auth()->user()->shop->name }}
                    </p>

                </div>
            @endif


            {{-- Navigation --}}
            <x-responsive-nav-link
                :href="route('dashboard')"
                :active="request()->routeIs('dashboard')"
            >
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('categories.index')"
                :active="request()->routeIs('categories.*')"
            >
                Catégories
            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('products.index')"
                :active="request()->routeIs('products.*')"
            >
                Produits
            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('stock-movements.index')"
                :active="request()->routeIs('stock-movements.*')"
            >
                Stock
            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('customers.index')"
                :active="request()->routeIs('customers.*')"
            >
                Clients
            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('sales.index')"
                :active="request()->routeIs('sales.*')"
            >
                Ventes
            </x-responsive-nav-link>


            {{-- Séparateur --}}
            <div class="my-3 border-t border-slate-100"></div>


            {{-- Profil --}}
            <x-responsive-nav-link
                :href="route('profile.edit')"
                :active="request()->routeIs('profile.edit')"
            >
                Profil
            </x-responsive-nav-link>


            {{-- Déconnexion --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link
                    :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();"
                >
                    <span class="text-red-600">
                        Se déconnecter
                    </span>
                </x-responsive-nav-link>

            </form>

        </div>

    </div>

</nav>

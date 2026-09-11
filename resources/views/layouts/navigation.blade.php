<nav x-data="{ open: false }" class="border-b border-slate-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            {{-- Logo --}}
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}"
                   class="text-2xl font-extrabold tracking-tight text-sellia-700">
                    SELLIA
                </a>
            </div>

            @if(auth()->user()->shop)
                <div class="hidden items-center border-l border-slate-200 pl-4 sm:flex">
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Boutique
                        </p>

                        <p class="max-w-40 truncate text-sm font-semibold text-slate-800">
                            {{ auth()->user()->shop->name }}
                        </p>
                    </div>
                </div>
            @endif

            {{-- Navigation desktop --}}
            <div class="hidden items-center gap-8 sm:flex">

                <x-nav-link
                    :href="route('dashboard')"
                    :active="request()->routeIs('dashboard')"
                >
                    Dashboard
                </x-nav-link>

                <x-nav-link
                    :href="route('categories.index')"
                    :active="request()->routeIs('categories.*')"
                >
                    Catégories
                </x-nav-link>

                <x-nav-link
                    :href="route('products.index')"
                    :active="request()->routeIs('products.*')"
                >
                    Produits
                </x-nav-link>

                <x-nav-link
                    :href="route('stock-movements.index')"
                    :active="request()->routeIs('stock-movements.*')"
                >
                    Stock
                </x-nav-link>

            </div>

            {{-- Menu utilisateur desktop --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium
                                   text-slate-600 transition hover:bg-slate-50 hover:text-slate-900
                                   focus:outline-none"
                        >
                            <span>{{ Auth::user()->name }}</span>

                            <svg
                                class="h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            Profil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                            >
                                Se déconnecter
                            </x-dropdown-link>
                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            {{-- Bouton mobile --}}
            <div class="flex sm:hidden">

                <button
                    @click="open = ! open"
                    class="inline-flex items-center justify-center rounded-lg p-2 text-slate-500
                           transition hover:bg-slate-100 hover:text-slate-700
                           focus:outline-none"
                >
                    <svg
                        class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            :class="{ 'hidden': open, 'inline-flex': !open }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />

                        <path
                            :class="{ 'hidden': !open, 'inline-flex': open }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>

            </div>

        </div>
    </div>

    {{-- Navigation mobile --}}
    <div
        x-show="open"
        class="border-t border-slate-100 sm:hidden"
    >
        <div class="space-y-1 px-4 py-4">

            <x-responsive-nav-link
                :href="route('dashboard')"
                :active="request()->routeIs('dashboard')"
            >
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('profile.edit')"
                :active="request()->routeIs('profile.edit')"
            >
                Profil
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link
                    :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();"
                >
                    Se déconnecter
                </x-responsive-nav-link>
            </form>

        </div>
    </div>
</nav>
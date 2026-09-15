{{-- resources/views/components/navigation/mobile-menu.blade.php --}}

<div
    x-data="{ open: false }"
    @keydown.escape.window="open = false"
    class="lg:hidden"
>

    {{-- Bouton hamburger --}}
    <button
        type="button"
        @click="open = true"
        class="inline-flex h-10 w-10 items-center justify-center
            rounded-xl border border-slate-200
            bg-white text-slate-600
            shadow-sm transition
            hover:bg-slate-50
            hover:text-blue-800
            focus:outline-none
            focus:ring-2
            focus:ring-blue-600/20"
        aria-label="Ouvrir le menu"
    >
        <svg
            class="h-5 w-5"
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
    </button>


    {{-- Overlay --}}
    <div
        x-show="open"
        x-transition:enter="transition-opacity duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="open = false"
        class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm"
        style="display: none;"
    ></div>


    {{-- Menu mobile --}}
    <aside
        x-show="open"
        x-transition:enter="transform transition duration-300 ease-out"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition duration-200 ease-in"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed inset-y-0 left-0 z-50 flex w-[280px] max-w-[85vw]
            flex-col border-r border-slate-200 bg-white shadow-2xl"
        style="display: none;"
        @click.stop
    >

        {{-- En-tête --}}
        <div class="flex h-20 shrink-0 items-center justify-between border-b border-slate-100 px-5">

            <div class="flex items-center">

                <div
                    class="flex h-10 w-10 items-center justify-center
                        rounded-xl bg-blue-800
                        text-sm font-black text-white"
                >
                    S
                </div>

                <div class="ml-3">
                    <p class="text-lg font-extrabold tracking-tight text-blue-800">
                        SELLIA
                    </p>

                    <p class="text-[11px] font-medium text-slate-400">
                        Gestion commerciale
                    </p>
                </div>

            </div>


            {{-- Fermer --}}
            <button
                type="button"
                @click="open = false"
                class="flex h-9 w-9 items-center justify-center
                    rounded-lg text-slate-400
                    transition hover:bg-slate-100
                    hover:text-slate-700"
                aria-label="Fermer le menu"
            >
                <svg
                    class="h-5 w-5"
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


        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto px-4 py-5">

            {{-- Principal --}}
            <div class="mb-6">

                <p class="mb-2 px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    Principal
                </p>

                <a
                    href="{{ route('dashboard') }}"
                    @click="open = false"
                    class="flex items-center gap-3 rounded-xl px-3 py-3
                        text-sm font-semibold
                        {{ request()->routeIs('dashboard')
                            ? 'bg-blue-50 text-blue-800'
                            : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                >
                    <svg
                        class="h-5 w-5 shrink-0"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1V10"
                        />
                    </svg>

                    Tableau de bord
                </a>

            </div>


            {{-- Commerce --}}
            <div class="mb-6">

                <p class="mb-2 px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    Commerce
                </p>

                <div class="space-y-1">

                    <a
                        href="{{ route('sales.index') }}"
                        @click="open = false"
                        class="flex items-center gap-3 rounded-xl px-3 py-3
                            text-sm font-semibold
                            {{ request()->routeIs('sales.*')
                                ? 'bg-blue-50 text-blue-800'
                                : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                    >
                        <svg
                            class="h-5 w-5 shrink-0"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 3h18v18H3zM7 7h10M7 11h10M7 15h6"
                            />
                        </svg>

                        Ventes
                    </a>


                    <a
                        href="{{ route('customers.index') }}"
                        @click="open = false"
                        class="flex items-center gap-3 rounded-xl px-3 py-3
                            text-sm font-semibold
                            {{ request()->routeIs('customers.*')
                                ? 'bg-blue-50 text-blue-800'
                                : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                    >
                        <svg
                            class="h-5 w-5 shrink-0"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                            />
                        </svg>

                        Clients
                    </a>

                </div>

            </div>


            {{-- Catalogue --}}
            <div class="mb-6">

                <p class="mb-2 px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    Catalogue
                </p>

                <div class="space-y-1">

                    <a
                        href="{{ route('products.index') }}"
                        @click="open = false"
                        class="flex items-center gap-3 rounded-xl px-3 py-3
                            text-sm font-semibold
                            {{ request()->routeIs('products.*')
                                ? 'bg-blue-50 text-blue-800'
                                : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                    >
                        <svg
                            class="h-5 w-5 shrink-0"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7m16 0l-8 4m-8-4l8 4m0 0v10"
                            />
                        </svg>

                        Produits
                    </a>


                    <a
                        href="{{ route('categories.index') }}"
                        @click="open = false"
                        class="flex items-center gap-3 rounded-xl px-3 py-3
                            text-sm font-semibold
                            {{ request()->routeIs('categories.*')
                                ? 'bg-blue-50 text-blue-800'
                                : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                    >
                        <svg
                            class="h-5 w-5 shrink-0"
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

                        Catégories
                    </a>


                    <a
                        href="{{ route('stock-movements.index') }}"
                        @click="open = false"
                        class="flex items-center gap-3 rounded-xl px-3 py-3
                            text-sm font-semibold
                            {{ request()->routeIs('stock-movements.*')
                                ? 'bg-blue-50 text-blue-800'
                                : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                    >
                        <svg
                            class="h-5 w-5 shrink-0"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 3v18m9-9H3"
                            />
                        </svg>

                        Mouvements de stock
                    </a>

                </div>

            </div>


            {{-- Gestion --}}
            <div>

                <p class="mb-2 px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    Gestion
                </p>

                <div class="space-y-1">

                    <a
                        href="{{ route('notifications.index') }}"
                        @click="open = false"
                        class="flex items-center gap-3 rounded-xl px-3 py-3
                            text-sm font-semibold
                            {{ request()->routeIs('notifications.*')
                                ? 'bg-blue-50 text-blue-800'
                                : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                    >
                        <svg
                            class="h-5 w-5 shrink-0"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 17h5l-1.5-1.5A2 2 0 0118 14v-3a6 6 0 10-12 0v3a2 2 0 01-.5 1.5L4 17h5m6 0a3 3 0 01-6 0"
                            />
                        </svg>

                        Notifications

                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span
                                class="ml-auto flex h-5 min-w-5 items-center justify-center
                                    rounded-full bg-red-500 px-1.5
                                    text-[10px] font-bold text-white"
                            >
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif

                    </a>

                </div>

            </div>

        </nav>


        {{-- Profil / Déconnexion --}}
        <div class="shrink-0 border-t border-slate-100 p-4">

            <div class="mb-3 flex items-center gap-3 rounded-xl bg-slate-50 px-3 py-3">

                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center
                        rounded-full bg-blue-800
                        text-sm font-bold text-white"
                >
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="min-w-0">
                    <p class="truncate text-sm font-semibold text-slate-900">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="truncate text-xs text-slate-500">
                        {{ auth()->user()->email }}
                    </p>
                </div>

            </div>


            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="flex w-full items-center gap-3 rounded-xl
                        px-3 py-3 text-sm font-semibold
                        text-slate-600 transition
                        hover:bg-red-50 hover:text-red-600"
                >
                    <svg
                        class="h-5 w-5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5m5 5H3"
                        />
                    </svg>

                    Déconnexion
                </button>

            </form>

        </div>

    </aside>

</div>
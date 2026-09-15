<aside
    class="fixed inset-y-0 left-0 z-40 hidden w-64 flex-col border-r border-slate-200 bg-white lg:flex"
>
    {{-- Logo --}}
    <div class="flex h-20 shrink-0 items-center border-b border-slate-100 px-6">

        <a
            href="{{ route('dashboard') }}"
            class="flex items-center gap-3"
        >
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sellia-700 text-sm font-extrabold text-white shadow-sm">
                S
            </div>

            <div>
                <span class="block text-lg font-extrabold tracking-tight text-sellia-700">
                    SELLIA
                </span>

                <span class="block text-[10px] font-medium uppercase tracking-wider text-slate-400">
                    Gestion commerciale
                </span>
            </div>
        </a>

    </div>


    {{-- Navigation --}}
    <nav class="flex-1 space-y-7 overflow-y-auto px-4 py-6">

        {{-- Principal --}}
        <div>

            <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-widest text-slate-400">
                Principal
            </p>

            <a
                href="{{ route('dashboard') }}"
                class="{{ request()->routeIs('dashboard')
                    ? 'bg-sellia-50 text-sellia-700'
                    : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}
                    group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition"
            >

                <span
                    class="{{ request()->routeIs('dashboard')
                        ? 'bg-white text-sellia-700 shadow-sm'
                        : 'text-slate-400 group-hover:text-slate-600' }}
                        flex h-9 w-9 items-center justify-center rounded-lg transition"
                >
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
                            d="M3 12h7V3H3v9Zm11 9h7v-9h-7v9ZM3 21h7v-5H3v5Zm11-12h7V3h-7v6Z"
                        />
                    </svg>
                </span>

                Tableau de bord

            </a>

        </div>


        {{-- Commerce --}}
        <div>

            <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-widest text-slate-400">
                Commerce
            </p>

            <a
                href="{{ route('sales.index') }}"
                class="{{ request()->routeIs('sales.*')
                    ? 'bg-sellia-50 text-sellia-700'
                    : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}
                    group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition"
            >

                <span
                    class="{{ request()->routeIs('sales.*')
                        ? 'bg-white text-sellia-700 shadow-sm'
                        : 'text-slate-400 group-hover:text-slate-600' }}
                        flex h-9 w-9 items-center justify-center rounded-lg"
                >
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
                            d="M3 7h18M5 7v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7M8 11h8"
                        />
                    </svg>
                </span>

                Ventes

            </a>

        </div>


        {{-- Catalogue --}}
        <div>

            <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-widest text-slate-400">
                Catalogue
            </p>

            <div class="space-y-1">

                <a
                    href="{{ route('products.index') }}"
                    class="{{ request()->routeIs('products.*')
                        ? 'bg-sellia-50 text-sellia-700'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}
                        group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition"
                >

                    <span
                        class="{{ request()->routeIs('products.*')
                            ? 'bg-white text-sellia-700 shadow-sm'
                            : 'text-slate-400 group-hover:text-slate-600' }}
                            flex h-9 w-9 items-center justify-center rounded-lg"
                    >
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
                                d="M20 7.5 12 3 4 7.5m16 0v9L12 21l-8-4.5v-9m16 0-8 4.5m0 9v-9"
                            />
                        </svg>
                    </span>

                    Produits

                </a>


                <a
                    href="{{ route('categories.index') }}"
                    class="{{ request()->routeIs('categories.*')
                        ? 'bg-sellia-50 text-sellia-700'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}
                        group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition"
                >

                    <span
                        class="{{ request()->routeIs('categories.*')
                            ? 'bg-white text-sellia-700 shadow-sm'
                            : 'text-slate-400 group-hover:text-slate-600' }}
                            flex h-9 w-9 items-center justify-center rounded-lg"
                    >
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
                                d="M4 6.5A2.5 2.5 0 0 1 6.5 4h4L20 13.5 13.5 20 4 10.5v-4ZM8 8h.01"
                        />
                    </svg>
                </span>

                Catégories

                </a>

            </div>

        </div>


        {{-- Gestion --}}
        <div>

            <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-widest text-slate-400">
                Gestion
            </p>

            <div class="space-y-1">

                <a
                    href="{{ route('stock-movements.index') }}"
                    class="{{ request()->routeIs('stock-movements.*')
                        ? 'bg-sellia-50 text-sellia-700'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}
                        group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition"
                >

                    <span
                        class="{{ request()->routeIs('stock-movements.*')
                            ? 'bg-white text-sellia-700 shadow-sm'
                            : 'text-slate-400 group-hover:text-slate-600' }}
                            flex h-9 w-9 items-center justify-center rounded-lg"
                    >
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
                                d="M4 7h16M4 12h16M4 17h10"
                            />
                        </svg>
                    </span>

                    Stock

                </a>


                <a
                    href="{{ route('customers.index') }}"
                    class="{{ request()->routeIs('customers.*')
                        ? 'bg-sellia-50 text-sellia-700'
                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}
                        group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition"
                >

                    <span
                        class="{{ request()->routeIs('customers.*')
                            ? 'bg-white text-sellia-700 shadow-sm'
                            : 'text-slate-400 group-hover:text-slate-600' }}
                            flex h-9 w-9 items-center justify-center rounded-lg"
                    >
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
                                d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2m7-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm9 10v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"
                        />
                    </svg>
                </span>

                Clients

                </a>

            </div>

        </div>

    </nav>


    {{-- Bas de sidebar --}}
    <div class="border-t border-slate-100 p-4">

        <a
            href="{{ route('profile.edit') }}"
            class="flex items-center gap-3 rounded-xl px-3 py-3 transition hover:bg-slate-50"
        >

            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-sellia-700 text-sm font-bold text-white">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <div class="min-w-0">

                <p class="truncate text-sm font-semibold text-slate-900">
                    {{ auth()->user()->name }}
                </p>

                <p class="truncate text-xs text-slate-400">
                    Mon profil
                </p>

            </div>

        </a>


        <form
            method="POST"
            action="{{ route('logout') }}"
            class="mt-1"
        >
            @csrf

            <button
                type="submit"
                class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-500 transition hover:bg-red-50 hover:text-red-600"
            >
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
                        d="M10 17l5-5-5-5m5 5H3m10-9h5a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-5"
                    />
                </svg>

                Déconnexion
            </button>

        </form>

    </div>

</aside>
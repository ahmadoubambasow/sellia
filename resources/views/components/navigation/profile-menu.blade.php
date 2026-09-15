<div
    x-data="{ open: false }"
    class="relative"
>

    <button
        type="button"
        @click="open = !open"
        class="flex items-center gap-3 rounded-xl px-2 py-1.5 transition hover:bg-slate-50"
    >

        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-sellia-700 text-sm font-bold text-white">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        <div class="hidden text-left xl:block">

            <p class="max-w-32 truncate text-sm font-semibold text-slate-900">
                {{ auth()->user()->name }}
            </p>

            <p class="text-xs text-slate-400">
                Mon compte
            </p>

        </div>

        <svg
            class="hidden h-4 w-4 text-slate-400 transition xl:block"
            :class="{ 'rotate-180': open }"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m6 9 6 6 6-6"
            />
        </svg>

    </button>


    {{-- Menu --}}
    <div
        x-cloak
        x-show="open"
        @click.outside="open = false"
        x-transition
        class="absolute right-0 top-full z-50 mt-2 w-60 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl"
    >

        <div class="border-b border-slate-100 px-4 py-4">

            <p class="truncate text-sm font-semibold text-slate-900">
                {{ auth()->user()->name }}
            </p>

            <p class="mt-1 truncate text-xs text-slate-400">
                {{ auth()->user()->email }}
            </p>

        </div>


        <div class="p-2">

            <a
                href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
            >
                <svg
                    class="h-5 w-5 text-slate-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M15.5 4.5a2.5 2.5 0 1 1 4 3L9 18l-5 1 1-5 10.5-10.5ZM13 7l4 4"
                    />
                </svg>

                Mon profil
            </a>


            <form
                method="POST"
                action="{{ route('logout') }}"
            >
                @csrf

                <button
                    type="submit"
                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-red-50 hover:text-red-600"
                >

                    <svg
                        class="h-5 w-5 text-slate-400"
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

    </div>

</div>
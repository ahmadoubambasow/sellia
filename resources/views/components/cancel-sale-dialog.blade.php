@props(['action'])

<div
    x-data="{ open: false }"
    @keydown.escape.window="open = false"
>
    <button
        type="button"
        @click="open = true"
        class="rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-red-700"
    >
        Annuler la vente
    </button>

    <div
        x-show="open"
        x-cloak
        class="fixed inset-0 z-50 overflow-y-auto"
        role="dialog"
        aria-modal="true"
    >
        <div
            x-show="open"
            x-transition.opacity
            @click="open = false"
            class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm"
        ></div>

        <div class="flex min-h-full items-center justify-center p-4">

            <div
                x-show="open"
                x-transition
                @click.stop
                class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl"
            >

                <div class="p-6">

                    <div class="flex items-start gap-4">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-red-50 text-red-600">
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 9v4m0 4h.01M10.29 3.86l-8.82 15a2 2 0 001.71 2.14h17.64a2 2 0 001.71-2.14l-3.42-15z"
                                />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-lg font-semibold text-slate-900">
                                Annuler la vente ?
                            </h2>

                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Cette action annulera la vente et restaurera automatiquement les produits dans le stock.
                            </p>
                        </div>

                    </div>

                </div>

                <div class="flex items-center justify-end gap-3 border-t border-slate-100 bg-slate-50 px-6 py-4">

                    <button
                        type="button"
                        @click="open = false"
                        class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-100"
                    >
                        Retour
                    </button>

                    <form method="POST" action="{{ $action }}">
                        @csrf

                        <button
                            type="submit"
                            class="rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-red-700"
                        >
                            Confirmer l'annulation
                        </button>
                    </form>

                </div>

            </div>

        </div>

    </div>
</div>
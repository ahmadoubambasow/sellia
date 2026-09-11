@props([
    'action',
    'title' => 'Confirmer la suppression',
    'message' => 'Cette action est irréversible. Voulez-vous vraiment continuer ?',
])

<div
    x-data="{ open: false }"
    @keydown.escape.window="open = false"
>
    {{-- Bouton déclencheur --}}
    <button
        type="button"
        @click="open = true"
        {{ $attributes->merge([
            'class' => 'rounded-lg px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50'
        ]) }}
    >
        Supprimer
    </button>

    {{-- Dialog --}}
    <div
        x-show="open"
        x-cloak
        class="fixed inset-0 z-50 overflow-y-auto"
        role="dialog"
        aria-modal="true"
    >
        {{-- Overlay --}}
        <div
            x-show="open"
            x-transition.opacity
            @click="open = false"
            class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm"
        ></div>

        {{-- Contenu --}}
        <div class="flex min-h-full items-center justify-center p-4">
            <div
                x-show="open"
                x-transition:enter="ease-out duration-200"
                x-transition:enter-start="translate-y-4 scale-95 opacity-0 sm:translate-y-0"
                x-transition:enter-end="translate-y-0 scale-100 opacity-100"
                x-transition:leave="ease-in duration-150"
                x-transition:leave-start="translate-y-0 scale-100 opacity-100"
                x-transition:leave-end="translate-y-4 scale-95 opacity-0 sm:translate-y-0"
                @click.stop
                class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl"
            >
                {{-- Corps --}}
                <div class="p-6">
                    <div class="flex items-start gap-4">

                        {{-- Icône --}}
                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-red-50 text-red-600"
                        >
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
                                    d="M12 9v4m0 4h.01M10.29 3.86l-8.82 15a2 2 0 001.71 2.14h17.64a2 2 0 001.71-2.14l-8.82-15a2 2 0 00-3.42 0z"
                                />
                            </svg>
                        </div>

                        {{-- Texte --}}
                        <div class="min-w-0">
                            <h2 class="text-lg font-semibold text-slate-900">
                                {{ $title }}
                            </h2>

                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                {{ $message }}
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Actions --}}
                <div
                    class="flex items-center justify-end gap-3 border-t border-slate-100 bg-slate-50 px-6 py-4"
                >
                    <button
                        type="button"
                        @click="open = false"
                        class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                    >
                        Annuler
                    </button>

                    <form
                        method="POST"
                        action="{{ $action }}"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                        >
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
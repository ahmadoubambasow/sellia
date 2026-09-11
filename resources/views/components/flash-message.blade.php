@php
    $successMessage = session('success');
    $errorMessage = session('error');

    $type = $successMessage ? 'success' : ($errorMessage ? 'error' : null);
    $message = $successMessage ?? $errorMessage;
@endphp

@if ($message)
    <div
        x-data="{ show: true }"
        x-show="show"
        x-cloak
        x-transition:enter="transform ease-out duration-300 transition"
        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-init="setTimeout(() => show = false, 4000)"
        class="fixed right-4 top-20 z-50 w-full max-w-sm sm:right-6"
        role="alert"
    >
        <div
            class="overflow-hidden rounded-2xl border bg-white shadow-lg
                {{ $type === 'success'
                    ? 'border-emerald-100'
                    : 'border-red-100' }}"
        >
            <div class="flex items-start gap-3 p-4">

                {{-- Icône --}}
                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full
                        {{ $type === 'success'
                            ? 'bg-emerald-50 text-emerald-600'
                            : 'bg-red-50 text-red-600' }}"
                >
                    @if ($type === 'success')
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
                    @else
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
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    @endif
                </div>

                {{-- Message --}}
                <div class="min-w-0 flex-1 pt-0.5">
                    <p class="text-sm font-semibold text-slate-900">
                        {{ $type === 'success'
                            ? 'Opération réussie'
                            : 'Une erreur est survenue' }}
                    </p>

                    <p class="mt-1 text-sm leading-5 text-slate-500">
                        {{ $message }}
                    </p>
                </div>

                {{-- Fermer --}}
                <button
                    type="button"
                    @click="show = false"
                    class="rounded-lg p-1.5 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
                    aria-label="Fermer"
                >
                    <svg
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>

            {{-- Barre de progression --}}
            <div
                class="h-0.5 origin-left animate-[shrink_4s_linear_forwards]
                    {{ $type === 'success'
                        ? 'bg-emerald-500'
                        : 'bg-red-500' }}"
            ></div>
        </div>
    </div>
@endif
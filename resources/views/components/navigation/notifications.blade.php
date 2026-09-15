@php
    $unreadNotifications = auth()->user()
        ->unreadNotifications
        ->take(5);

    $unreadCount = auth()->user()
        ->unreadNotifications()
        ->count();
@endphp

<div
    x-data="{ open: false }"
    @click.outside="open = false"
    @keydown.escape.window="open = false"
    class="relative"
>

    {{-- =========================================================
        BOUTON NOTIFICATIONS
    ========================================================== --}}
    <button
        type="button"
        @click="open = !open"
        class="relative flex h-10 w-10 items-center justify-center rounded-xl text-slate-500 transition hover:bg-slate-100 hover:text-slate-700"
        aria-label="Notifications"
    >

        {{-- Cloche --}}
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
                d="M15 17h5l-1.5-2.5V10a6.5 6.5 0 0 0-13 0v4.5L4 17h5m6 0a3 3 0 0 1-6 0m6 0H9"
            />
        </svg>


        {{-- Compteur --}}
        @if ($unreadCount > 0)

            <span
                class="absolute right-1 top-1 flex h-4 min-w-4 items-center justify-center rounded-full bg-red-500 px-1 text-[9px] font-bold text-white ring-2 ring-white"
            >
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
            </span>

        @endif

    </button>


    {{-- =========================================================
        DROPDOWN
    ========================================================== --}}
    <div
        x-cloak
        x-show="open"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 -translate-y-1 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 -translate-y-1 scale-95"
        class="absolute right-0 top-full z-50 mt-2 w-96 origin-top-right overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl"
    >

        {{-- =====================================================
            EN-TÊTE
        ====================================================== --}}
        <div class="flex items-center justify-between border-b border-slate-100 px-4 py-4">

            <div>

                <h3 class="text-sm font-semibold text-slate-900">
                    Notifications
                </h3>

                @if ($unreadCount > 0)

                    <p class="mt-0.5 text-xs text-slate-400">
                        {{ $unreadCount }}
                        {{ $unreadCount > 1 ? 'notifications non lues' : 'notification non lue' }}
                    </p>

                @else

                    <p class="mt-0.5 text-xs text-slate-400">
                        Tout est à jour
                    </p>

                @endif

            </div>


            @if ($unreadCount > 0)

                <form
                    method="POST"
                    action="{{ route('notifications.read-all') }}"
                >
                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="text-xs font-semibold text-sellia-600 transition hover:text-sellia-800"
                    >
                        Tout lire
                    </button>

                </form>

            @endif

        </div>


        {{-- =====================================================
            NOTIFICATIONS
        ====================================================== --}}
        @if ($unreadNotifications->isNotEmpty())

            <div class="max-h-[360px] overflow-y-auto">

                @foreach ($unreadNotifications as $notification)

                    @php
                        $data = $notification->data;

                        $isCritical =
                            ($data['severity'] ?? null) === 'critical';
                    @endphp

                    <form
                        method="POST"
                        action="{{ route('notifications.read', $notification->id) }}"
                    >
                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="group flex w-full gap-3 border-b border-slate-100 px-4 py-4 text-left transition hover:bg-slate-50"
                        >

                        {{-- Icône --}}
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl
                            {{ $isCritical
                                ? 'bg-red-50 text-red-600'
                                : 'bg-amber-50 text-amber-600' }}"
                        >

                            @if ($isCritical)

                                {{-- Rupture --}}
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
                                        d="M12 9v4m0 4h.01M10.3 3.7 2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"
                                    />
                                </svg>

                            @else

                                {{-- Stock faible --}}
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

                            @endif

                        </div>


                        {{-- Contenu --}}
                        <div class="min-w-0 flex-1">

                            <div class="flex items-start justify-between gap-3">

                                <p class="text-sm font-semibold text-slate-900">
                                    {{ $data['title'] ?? 'Notification' }}
                                </p>

                                <span class="mt-1 h-2 w-2 shrink-0 rounded-full bg-sellia-500"></span>

                            </div>


                            <p class="mt-1 text-sm leading-5 text-slate-500">
                                {{ $data['message'] ?? '' }}
                            </p>


                            @if (isset($data['stock_after']))

                                <p class="mt-2 text-xs font-medium text-slate-400">
                                    Stock :
                                    <span class="text-slate-600">
                                        {{ $data['stock_after'] }}
                                    </span>

                                    <span class="mx-1">
                                        ·
                                    </span>

                                    Seuil :
                                    <span class="text-slate-600">
                                        {{ $data['threshold'] }}
                                    </span>
                                </p>

                            @endif

                        </div>

                    </form>

                @endforeach

            </div>

        @else

            {{-- =================================================
                AUCUNE NOTIFICATION
            ================================================== --}}
            <div class="px-5 py-10 text-center">

                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M15 17h5l-1.5-2.5V10a6.5 6.5 0 0 0-13 0v4.5L4 17h5m6 0a3 3 0 0 1-6 0"
                        />
                    </svg>

                </div>


                <p class="mt-3 text-sm font-semibold text-slate-700">
                    Aucune notification
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    SELLIA vous avertira lorsque le stock atteindra son seuil.
                </p>

            </div>

        @endif


        {{-- =====================================================
            PIED
        ====================================================== --}}
        <div class="border-t border-slate-100 bg-slate-50">

            <a
                href="{{ route('notifications.index') }}"
                class="flex items-center justify-center gap-2 px-4 py-3 text-sm font-semibold text-sellia-700 transition hover:bg-sellia-50"
                @click="open = false"
            >

                Voir toutes les notifications

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

        </div>

    </div>

</div>
<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col gap-1">

            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                Notifications
            </h1>

            <p class="text-sm text-slate-500">
                Suivez les alertes de stock de votre boutique.
            </p>

        </div>

    </x-slot>


    <div class="mx-auto max-w-4xl">

        {{-- Actions --}}
        <div class="mb-5 flex items-center justify-between">

            <p class="text-sm text-slate-500">
                {{ $notifications->total() }}
                notification(s)
            </p>


            @if (auth()->user()->unreadNotifications()->exists())

                <form
                    method="POST"
                    action="{{ route('notifications.read-all') }}"
                >
                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="text-sm font-semibold text-sellia-600 transition hover:text-sellia-800"
                    >
                        Tout marquer comme lu
                    </button>

                </form>

            @endif

        </div>


        {{-- Liste --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            @forelse ($notifications as $notification)

                @php
                    $data = $notification->data;

                    $isUnread = is_null($notification->read_at);

                    $isCritical =
                        ($data['severity'] ?? null) === 'critical';
                @endphp


                <div
                    class="border-b border-slate-100 last:border-b-0
                    {{ $isUnread ? 'bg-sellia-50/40' : 'bg-white' }}"
                >

                    <div class="flex gap-4 px-5 py-5 sm:px-6">

                        {{-- Icône --}}
                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl
                            {{ $isCritical
                                ? 'bg-red-50 text-red-600'
                                : 'bg-amber-50 text-amber-600' }}"
                        >

                            @if ($isCritical)

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

                            <div class="flex flex-wrap items-center gap-2">

                                <h2 class="text-sm font-semibold text-slate-900">
                                    {{ $data['title'] ?? 'Notification' }}
                                </h2>

                                @if ($isUnread)

                                    <span class="h-2 w-2 rounded-full bg-sellia-500"></span>

                                @endif

                            </div>


                            <p class="mt-1 text-sm text-slate-500">
                                {{ $data['message'] ?? '' }}
                            </p>


                            @if (isset($data['stock_after']))

                                <div class="mt-3 flex flex-wrap gap-4 text-xs text-slate-400">

                                    <span>
                                        Stock :
                                        <strong class="text-slate-600">
                                            {{ $data['stock_after'] }}
                                        </strong>
                                    </span>

                                    <span>
                                        Seuil :
                                        <strong class="text-slate-600">
                                            {{ $data['threshold'] }}
                                        </strong>
                                    </span>

                                </div>

                            @endif


                            <p class="mt-3 text-xs text-slate-400">
                                {{ $notification->created_at->diffForHumans() }}
                            </p>

                        </div>


                        {{-- Action --}}
                        @if (!empty($data['url']))

                            <div class="shrink-0">

                                <a
                                    href="{{ $data['url'] }}"
                                    class="inline-flex items-center gap-1 text-xs font-semibold text-sellia-600 hover:text-sellia-800"
                                >
                                    Voir

                                    <svg
                                        class="h-3.5 w-3.5"
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

                        @endif

                    </div>

                </div>

            @empty

                <div class="px-6 py-16 text-center">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                        <svg
                            class="h-7 w-7"
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

                    <h2 class="mt-4 text-sm font-semibold text-slate-800">
                        Aucune notification
                    </h2>

                    <p class="mt-1 text-sm text-slate-400">
                        Vous recevrez ici les alertes lorsque vos produits atteindront leur seuil.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- Pagination --}}
        @if ($notifications->hasPages())

            <div class="mt-6">
                {{ $notifications->links() }}
            </div>

        @endif

    </div>

</x-app-layout>
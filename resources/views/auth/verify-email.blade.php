<x-guest-layout>

    {{-- En-tête SELLIA --}}
    <div class="mb-8 text-center">

        <div class="flex items-center justify-center">

            <div
                class="flex h-12 w-12 items-center justify-center
                    rounded-2xl bg-blue-800
                    text-lg font-black text-white shadow-sm"
            >
                <span class="text-white">
                    S
                </span>
            </div>

            <div class="ml-3 text-left">
                <h1 class="text-2xl font-extrabold tracking-tight text-blue-800">
                    SELLIA
                </h1>

                <p class="text-xs font-medium text-slate-400">
                    Gestion commerciale
                </p>
            </div>

        </div>

        <p class="mt-6 text-sm text-slate-500">
            Gérez. Vendez. Progressez.
        </p>

    </div>


    {{-- Message principal --}}
    <div class="mb-7 text-center">

        <h2 class="text-xl font-bold tracking-tight text-slate-900">
            Vérifiez votre adresse e-mail
        </h2>

        <p class="mx-auto mt-3 max-w-md text-sm leading-6 text-slate-500">
            Merci de vous être inscrit sur SELLIA !
            Avant de commencer, veuillez vérifier votre adresse e-mail
            en cliquant sur le lien que nous venons de vous envoyer.
        </p>

        <p class="mx-auto mt-3 max-w-md text-sm leading-6 text-slate-500">
            Vous n'avez pas reçu l'e-mail ?
            Nous pouvons vous en envoyer un nouveau.
        </p>

    </div>


    {{-- Confirmation d'envoi --}}
    @if (session('status') == 'verification-link-sent')

        <div
            class="mb-6 rounded-xl border border-emerald-200
                bg-emerald-50 px-4 py-3
                text-center text-sm font-medium
                text-emerald-700"
        >
            Un nouveau lien de vérification vient d'être envoyé
            à l'adresse e-mail associée à votre compte.
        </div>

    @endif


    {{-- Actions --}}
    <div class="mt-7 space-y-4">

        {{-- Renvoyer l'e-mail --}}
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-primary-button
                class="group w-full justify-center rounded-xl
                    bg-blue-800 px-4 py-3.5
                    text-sm font-bold text-white
                    shadow-sm
                    transition-all duration-200
                    hover:-translate-y-0.5
                    hover:bg-blue-900
                    hover:shadow-md
                    focus:bg-blue-900
                    focus:ring-2
                    focus:ring-blue-600/30
                    focus:ring-offset-2
                    active:translate-y-0
                    active:bg-blue-950"
            >
                <span>
                    Renvoyer l'e-mail de vérification
                </span>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="ml-2 h-4 w-4 transition-transform
                        duration-200 group-hover:translate-x-0.5"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 8l9 6 9-6"
                    />

                    <rect
                        x="3"
                        y="5"
                        width="18"
                        height="14"
                        rx="2"
                    />
                </svg>

            </x-primary-button>

        </form>


        {{-- Déconnexion --}}
        <form
            method="POST"
            action="{{ route('logout') }}"
            class="text-center"
        >
            @csrf

            <button
                type="submit"
                class="rounded-lg px-3 py-2
                    text-sm font-semibold text-slate-500
                    transition
                    hover:bg-slate-100
                    hover:text-slate-800
                    focus:outline-none
                    focus:ring-2
                    focus:ring-blue-600/20
                    focus:ring-offset-2"
            >
                Se déconnecter
            </button>
        </form>

    </div>

</x-guest-layout>

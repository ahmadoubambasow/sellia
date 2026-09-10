<x-guest-layout>

    {{-- En-tête SELLIA --}}
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-extrabold tracking-tight text-sellia-700">
            SELLIA
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Gérez. Vendez. Progressez.
        </p>
    </div>

    {{-- Message principal --}}
    <div class="mb-6 text-center">
        <h2 class="text-xl font-semibold text-slate-900">
            Vérifiez votre adresse e-mail
        </h2>

        <p class="mt-3 text-sm leading-6 text-slate-500">
            Merci de vous être inscrit sur SELLIA !
            Avant de commencer, veuillez vérifier votre adresse e-mail
            en cliquant sur le lien que nous venons de vous envoyer.
        </p>

        <p class="mt-3 text-sm leading-6 text-slate-500">
            Vous n'avez pas reçu l'e-mail ?
            Nous pouvons vous en envoyer un nouveau.
        </p>
    </div>

    {{-- Confirmation d'envoi --}}
    @if (session('status') == 'verification-link-sent')
        <div
            class="mb-6 rounded-lg border border-emerald-200
                bg-emerald-50 px-4 py-3 text-sm
                font-medium text-emerald-700"
        >
            Un nouveau lien de vérification vient d'être envoyé
            à l'adresse e-mail associée à votre compte.
        </div>
    @endif

    {{-- Actions --}}
    <div class="mt-6 space-y-4">

        {{-- Renvoyer l'e-mail --}}
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-primary-button
                class="w-full justify-center rounded-lg
                    bg-sellia-700 py-3 text-sm font-semibold
                    text-white shadow-sm transition
                    hover:bg-sellia-800
                    focus:bg-sellia-800
                    active:bg-sellia-900
                    focus:ring-2 focus:ring-sellia-500
                    focus:ring-offset-2"
            >
                Renvoyer l'e-mail de vérification
            </x-primary-button>
        </form>

        {{-- Déconnexion --}}
        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf

            <button
                type="submit"
                class="rounded text-sm font-medium text-slate-500
                    transition hover:text-slate-900 hover:underline
                    focus:outline-none focus:ring-2
                    focus:ring-sellia-500 focus:ring-offset-2"
            >
                Se déconnecter
            </button>
        </form>

    </div>

</x-guest-layout>

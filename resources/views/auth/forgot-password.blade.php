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


    {{-- Introduction --}}
    <div class="mb-7 text-center">

        <h2 class="text-xl font-bold tracking-tight text-slate-900">
            Mot de passe oublié ?
        </h2>

        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
            Aucun problème. Indiquez votre adresse e-mail et nous vous
            enverrons un lien pour réinitialiser votre mot de passe.
        </p>

    </div>


    {{-- Message de session --}}
    <x-auth-session-status
        class="mb-5"
        :status="session('status')"
    />


    {{-- Formulaire --}}
    <form
        method="POST"
        action="{{ route('password.email') }}"
        class="space-y-5"
    >
        @csrf

        {{-- Adresse e-mail --}}
        <div>

            <x-input-label
                for="email"
                :value="__('Adresse e-mail')"
                class="mb-1.5 text-sm font-semibold text-slate-700"
            />

            <x-text-input
                id="email"
                class="block w-full rounded-xl border-slate-200
                    bg-slate-50 px-4 py-3 text-sm
                    text-slate-900 shadow-sm
                    transition
                    placeholder:text-slate-400
                    hover:border-slate-300
                    focus:border-blue-600
                    focus:bg-white
                    focus:ring-2
                    focus:ring-blue-600/20"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                placeholder="vous@exemple.com"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />

        </div>


        {{-- Envoyer --}}
        <div class="pt-1">

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
                    Envoyer le lien de réinitialisation
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
                        d="M13 5l7 7-7 7M20 12H4"
                    />
                </svg>
            </x-primary-button>

        </div>

    </form>


    {{-- Retour connexion --}}
    <div class="mt-7">

        <div class="relative">

            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-slate-200"></div>
            </div>

            <div class="relative flex justify-center">
                <span class="bg-white px-3 text-xs font-medium text-slate-400">
                    Vous vous souvenez de votre mot de passe ?
                </span>
            </div>

        </div>

        <div class="mt-5 text-center">

            <a
                href="{{ route('login') }}"
                class="inline-flex items-center justify-center
                    rounded-xl border border-slate-200
                    bg-white px-5 py-2.5
                    text-sm font-semibold
                    text-slate-700
                    shadow-sm
                    transition
                    hover:border-blue-200
                    hover:bg-blue-50
                    hover:text-blue-800
                    focus:outline-none
                    focus:ring-2
                    focus:ring-blue-600/20
                    focus:ring-offset-2"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="mr-2 h-4 w-4"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M11 5l-7 7 7 7M4 12h16"
                    />
                </svg>

                Retour à la connexion
            </a>

        </div>

    </div>

</x-guest-layout>

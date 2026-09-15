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


    {{-- Message de sécurité --}}
    <div class="mb-7 text-center">

        <h2 class="text-xl font-bold tracking-tight text-slate-900">
            Confirmation de sécurité
        </h2>

        <p class="mx-auto mt-3 max-w-md text-sm leading-6 text-slate-500">
            Cette section est protégée.
            Veuillez confirmer votre mot de passe avant de continuer.
        </p>

    </div>


    {{-- Formulaire --}}
    <form
        method="POST"
        action="{{ route('password.confirm') }}"
        class="space-y-5"
    >
        @csrf

        {{-- Mot de passe --}}
        <div>

            <x-input-label
                for="password"
                :value="__('Mot de passe')"
                class="mb-1.5 text-sm font-semibold text-slate-700"
            />

            <x-text-input
                id="password"
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
                type="password"
                name="password"
                required
                autofocus
                autocomplete="current-password"
                placeholder="••••••••"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>


        {{-- Confirmation --}}
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
                <span>Confirmer</span>

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

</x-guest-layout>

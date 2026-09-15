<x-guest-layout>

    {{-- En-tête SELLIA --}}
    <div class="mb-8 text-center">

        {{-- Logo / nom --}}
        <div class="inline-flex items-center justify-center">
            <div
                class="relative z-10 flex h-12 w-12 items-center justify-center
                    rounded-2xl bg-blue-800
                    text-lg font-black text-white shadow-sm"
            >
                <span class="block text-white">
                    S
                </span>
            </div>

            <div class="ml-3 text-left">
                <h1 class="text-2xl font-extrabold tracking-tight text-sellia-700">
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


    {{-- Message de session --}}
    <x-auth-session-status
        class="mb-5"
        :status="session('status')"
    />


    {{-- Formulaire --}}
    <form
        method="POST"
        action="{{ route('login') }}"
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

            <div class="relative">

                {{-- Icône --}}
                <div
                    class="pointer-events-none absolute inset-y-0 left-0
                        flex items-center pl-3.5 text-slate-400"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
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
                </div>

                <x-text-input
                    id="email"
                    class="block w-full rounded-xl border-slate-200
                        bg-slate-50 py-3 pl-11 pr-4 text-sm
                        text-slate-900 shadow-sm
                        transition
                        placeholder:text-slate-400
                        hover:border-slate-300
                        focus:border-sellia-500
                        focus:bg-white
                        focus:ring-2
                        focus:ring-sellia-500/20"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="vous@exemple.com"
                />

            </div>

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />

        </div>


        {{-- Mot de passe --}}
        <div>

            <div class="mb-1.5 flex items-center justify-between">

                <x-input-label
                    for="password"
                    :value="__('Mot de passe')"
                    class="text-sm font-semibold text-slate-700"
                />

                @if (Route::has('password.request'))
                    <a
                        href="{{ route('password.request') }}"
                        class="rounded text-xs font-semibold
                            text-sellia-700 transition
                            hover:text-sellia-800
                            hover:underline
                            focus:outline-none
                            focus:ring-2
                            focus:ring-sellia-500
                            focus:ring-offset-2"
                    >
                        Mot de passe oublié ?
                    </a>
                @endif

            </div>


            <div class="relative">

                {{-- Icône --}}
                <div
                    class="pointer-events-none absolute inset-y-0 left-0
                        flex items-center pl-3.5 text-slate-400"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <rect
                            x="4"
                            y="10"
                            width="16"
                            height="10"
                            rx="2"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8 10V7a4 4 0 018 0v3"
                        />
                    </svg>
                </div>

                <x-text-input
                    id="password"
                    class="block w-full rounded-xl border-slate-200
                        bg-slate-50 py-3 pl-11 pr-4 text-sm
                        text-slate-900 shadow-sm
                        transition
                        placeholder:text-slate-400
                        hover:border-slate-300
                        focus:border-sellia-500
                        focus:bg-white
                        focus:ring-2
                        focus:ring-sellia-500/20"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Votre mot de passe"
                />

            </div>

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>


        {{-- Se souvenir de moi --}}
        <div class="flex items-center">

            <label
                for="remember_me"
                class="inline-flex cursor-pointer items-center"
            >
                <input
                    id="remember_me"
                    type="checkbox"
                    class="h-4 w-4 rounded border-slate-300
                        text-sellia-700 shadow-sm
                        focus:ring-2
                        focus:ring-sellia-500/30"
                    name="remember"
                >

                <span class="ml-2 text-sm text-slate-600">
                    Se souvenir de moi
                </span>
            </label>

        </div>


        {{-- Connexion --}}
        <div class="pt-1">

            <x-primary-button
                class="group w-full justify-center rounded-xl
                    bg-sellia-700 px-4 py-3.5
                    text-sm font-bold text-white
                    shadow-sm
                    transition-all duration-200
                    hover:-translate-y-0.5
                    hover:bg-sellia-800
                    hover:shadow-md
                    focus:bg-sellia-800
                    focus:ring-2
                    focus:ring-sellia-500/30
                    focus:ring-offset-2
                    active:translate-y-0
                    active:bg-sellia-900"
            >
                <span>Se connecter</span>

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


    {{-- Création de compte --}}
    @if (Route::has('register'))

        <div class="mt-7">

            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-200"></div>
                </div>

                <div class="relative flex justify-center">
                    <span class="bg-white px-3 text-xs font-medium text-slate-400">
                        Nouveau sur SELLIA ?
                    </span>
                </div>
            </div>


            <div class="mt-5 text-center">

                <a
                    href="{{ route('register') }}"
                    class="inline-flex items-center justify-center
                        rounded-xl border border-slate-200
                        bg-white px-5 py-2.5
                        text-sm font-semibold
                        text-slate-700
                        shadow-sm
                        transition
                        hover:border-sellia-200
                        hover:bg-sellia-50
                        hover:text-sellia-700
                        focus:outline-none
                        focus:ring-2
                        focus:ring-sellia-500/20
                        focus:ring-offset-2"
                >
                    Créer un compte

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="ml-2 h-4 w-4"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 5l7 7-7 7"
                        />
                    </svg>
                </a>

            </div>

        </div>

    @endif

</x-guest-layout>

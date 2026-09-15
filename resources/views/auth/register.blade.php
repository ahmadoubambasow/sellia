<x-guest-layout>

    {{-- En-tête SELLIA --}}
    <div class="mb-8 text-center">

        {{-- Identité SELLIA --}}
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

    </div>>


    {{-- Formulaire --}}
    <form
        method="POST"
        action="{{ route('register') }}"
        class="space-y-5"
    >
        @csrf


        {{-- Nom --}}
        <div>

            <x-input-label
                for="name"
                :value="__('Nom')"
                class="mb-1.5 text-sm font-semibold text-slate-700"
            />

            <div class="relative">

                {{-- Icône utilisateur --}}
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
                            d="M15 19a6 6 0 00-12 0"
                        />

                        <circle
                            cx="9"
                            cy="7"
                            r="4"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19 8v6M16 11h6"
                        />
                    </svg>
                </div>

                <x-text-input
                    id="name"
                    class="block w-full rounded-xl border-slate-200
                           bg-slate-50 py-3 pl-11 pr-4 text-sm
                           text-slate-900 shadow-sm transition
                           placeholder:text-slate-400
                           hover:border-slate-300
                           focus:border-sellia-500
                           focus:bg-white
                           focus:ring-2
                           focus:ring-sellia-500/20"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Votre nom"
                />

            </div>

            <x-input-error
                :messages="$errors->get('name')"
                class="mt-2"
            />

        </div>


        {{-- Adresse e-mail --}}
        <div>

            <x-input-label
                for="email"
                :value="__('Adresse e-mail')"
                class="mb-1.5 text-sm font-semibold text-slate-700"
            />

            <div class="relative">

                {{-- Icône e-mail --}}
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
                           text-slate-900 shadow-sm transition
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

            <x-input-label
                for="password"
                :value="__('Mot de passe')"
                class="mb-1.5 text-sm font-semibold text-slate-700"
            />

            <div class="relative">

                {{-- Icône cadenas --}}
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
                           text-slate-900 shadow-sm transition
                           placeholder:text-slate-400
                           hover:border-slate-300
                           focus:border-sellia-500
                           focus:bg-white
                           focus:ring-2
                           focus:ring-sellia-500/20"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                />

            </div>

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>


        {{-- Confirmation --}}
        <div>

            <x-input-label
                for="password_confirmation"
                :value="__('Confirmer le mot de passe')"
                class="mb-1.5 text-sm font-semibold text-slate-700"
            />

            <div class="relative">

                {{-- Icône cadenas --}}
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
                    id="password_confirmation"
                    class="block w-full rounded-xl border-slate-200
                           bg-slate-50 py-3 pl-11 pr-4 text-sm
                           text-slate-900 shadow-sm transition
                           placeholder:text-slate-400
                           hover:border-slate-300
                           focus:border-sellia-500
                           focus:bg-white
                           focus:ring-2
                           focus:ring-sellia-500/20"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                />

            </div>

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2"
            />

        </div>


        {{-- Création du compte --}}
        <div class="pt-1">

            <x-primary-button
                class="group w-full justify-center rounded-xl
                       bg-sellia-700 px-4 py-3.5
                       text-sm font-bold text-white
                       shadow-sm transition-all duration-200
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
                <span>Créer mon compte</span>

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


    {{-- Connexion --}}
    <div class="mt-7">

        <div class="relative">

            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-slate-200"></div>
            </div>

            <div class="relative flex justify-center">
                <span class="bg-white px-3 text-xs font-medium text-slate-400">
                    Déjà inscrit ?
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
                       shadow-sm transition
                       hover:border-sellia-200
                       hover:bg-sellia-50
                       hover:text-sellia-700
                       focus:outline-none
                       focus:ring-2
                       focus:ring-sellia-500/20
                       focus:ring-offset-2"
            >
                Se connecter

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

</x-guest-layout>

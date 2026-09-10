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

    {{-- Titre --}}
    <div class="mb-6 text-center">
        <h2 class="text-xl font-semibold text-slate-900">
            Réinitialiser votre mot de passe
        </h2>

        <p class="mt-2 text-sm leading-6 text-slate-500">
            Choisissez un nouveau mot de passe sécurisé pour accéder à votre compte SELLIA.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        {{-- Jeton de réinitialisation --}}
        <input
            type="hidden"
            name="token"
            value="{{ $request->route('token') }}"
        >

        {{-- Adresse e-mail --}}
        <div>
            <x-input-label
                for="email"
                :value="__('Adresse e-mail')"
                class="text-slate-700"
            />

            <x-text-input
                id="email"
                class="mt-1 block w-full rounded-lg border-slate-300
                    focus:border-sellia-500 focus:ring-sellia-500"
                type="email"
                name="email"
                :value="old('email', $request->email)"
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

        {{-- Nouveau mot de passe --}}
        <div>
            <x-input-label
                for="password"
                :value="__('Nouveau mot de passe')"
                class="text-slate-700"
            />

            <x-text-input
                id="password"
                class="mt-1 block w-full rounded-lg border-slate-300
                    focus:border-sellia-500 focus:ring-sellia-500"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="••••••••"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />
        </div>

        {{-- Confirmation --}}
        <div>
            <x-input-label
                for="password_confirmation"
                :value="__('Confirmer le nouveau mot de passe')"
                class="text-slate-700"
            />

            <x-text-input
                id="password_confirmation"
                class="mt-1 block w-full rounded-lg border-slate-300
                    focus:border-sellia-500 focus:ring-sellia-500"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="••••••••"
            />

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2"
            />
        </div>

        {{-- Réinitialisation --}}
        <div class="pt-2">
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
                Réinitialiser le mot de passe
            </x-primary-button>
        </div>

    </form>

    {{-- Retour connexion --}}
    <div class="mt-6 border-t border-slate-200 pt-6 text-center">
        <a
            href="{{ route('login') }}"
            class="text-sm font-semibold text-sellia-700
                transition hover:text-sellia-800 hover:underline"
        >
            ← Retour à la connexion
        </a>
    </div>

</x-guest-layout>

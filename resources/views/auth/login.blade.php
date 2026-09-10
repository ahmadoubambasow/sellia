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

{{-- Message de session --}}
<x-auth-session-status
    class="mb-4"
    :status="session('status')"
/>

<form method="POST" action="{{ route('login') }}" class="space-y-5">
    @csrf

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

    {{-- Mot de passe --}}
    <div>
        <div class="flex items-center justify-between">

            <x-input-label
                for="password"
                :value="__('Mot de passe')"
                class="text-slate-700"
            />

            @if (Route::has('password.request'))
                <a
                    href="{{ route('password.request') }}"
                    class="rounded text-sm font-medium text-sellia-700
                           transition hover:text-sellia-800 hover:underline
                           focus:outline-none focus:ring-2
                           focus:ring-sellia-500 focus:ring-offset-2"
                >
                    Mot de passe oublié ?
                </a>
            @endif

        </div>

        <x-text-input
            id="password"
            class="mt-1 block w-full rounded-lg border-slate-300
                   focus:border-sellia-500 focus:ring-sellia-500"
            type="password"
            name="password"
            required
            autocomplete="current-password"
            placeholder="••••••••"
        />

        <x-input-error
            :messages="$errors->get('password')"
            class="mt-2"
        />
    </div>

    {{-- Se souvenir de moi --}}
    <div>
        <label
            for="remember_me"
            class="inline-flex cursor-pointer items-center"
        >
            <input
                id="remember_me"
                type="checkbox"
                class="rounded border-slate-300
                       text-sellia-700 shadow-sm
                       focus:ring-sellia-500"
                name="remember"
            >

            <span class="ms-2 text-sm text-slate-600">
                Se souvenir de moi
            </span>
        </label>
    </div>

    {{-- Connexion --}}
    <div>
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
            Se connecter
        </x-primary-button>
    </div>

</form>

{{-- Création de compte --}}
@if (Route::has('register'))
    <div class="mt-6 border-t border-slate-200 pt-6 text-center">
        <p class="text-sm text-slate-500">
            Vous n'avez pas encore de compte ?

            <a
                href="{{ route('register') }}"
                class="font-semibold text-sellia-700
                       transition hover:text-sellia-800
                       hover:underline"
            >
                Créer un compte
            </a>
        </p>
    </div>
@endif

</x-guest-layout>

<x-guest-layout>

{{-- En-tête SELLIA --}}
<div class="mb-8 text-center">
    <h1 class="text-3xl font-extrabold tracking-tight text-sellia-700">
        SELLIA
    </h1>

    <p class="mt-2 text-sm text-slate-500">
        Gérez. Vendez. Progressez.
    </p>

    <p class="mt-4 text-sm text-slate-600">
        Créez votre compte et commencez à gérer votre activité simplement.
    </p>
</div>

<form method="POST" action="{{ route('register') }}" class="space-y-5">
    @csrf

    {{-- Nom --}}
    <div>
        <x-input-label
            for="name"
            :value="__('Nom')"
            class="text-slate-700"
        />

        <x-text-input
            id="name"
            class="mt-1 block w-full rounded-lg border-slate-300
                   focus:border-sellia-500 focus:ring-sellia-500"
            type="text"
            name="name"
            :value="old('name')"
            required
            autofocus
            autocomplete="name"
            placeholder="Votre nom"
        />

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
        <x-input-label
            for="password"
            :value="__('Mot de passe')"
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

    {{-- Confirmation du mot de passe --}}
    <div>
        <x-input-label
            for="password_confirmation"
            :value="__('Confirmer le mot de passe')"
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

    {{-- Actions --}}
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
            Créer mon compte
        </x-primary-button>
    </div>

</form>

{{-- Connexion --}}
<div class="mt-6 border-t border-slate-200 pt-6 text-center">
    <p class="text-sm text-slate-500">
        Vous avez déjà un compte ?

        <a
            href="{{ route('login') }}"
            class="font-semibold text-sellia-700
                   transition hover:text-sellia-800
                   hover:underline"
        >
            Se connecter
        </a>
    </p>
</div>

</x-guest-layout>

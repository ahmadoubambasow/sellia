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

    {{-- Message de sécurité --}}
    <div class="mb-6 text-center">
        <h2 class="text-xl font-semibold text-slate-900">
            Confirmation de sécurité
        </h2>

        <p class="mt-3 text-sm leading-6 text-slate-500">
            Cette section est protégée.
            Veuillez confirmer votre mot de passe avant de continuer.
        </p>
    </div>

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
                class="text-slate-700"
            />

            <x-text-input
                id="password"
                class="mt-1 block w-full rounded-lg border-slate-300
                    focus:border-sellia-500 focus:ring-sellia-500"
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

        {{-- Bouton --}}
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
                Confirmer
            </x-primary-button>
        </div>

    </form>

</x-guest-layout>

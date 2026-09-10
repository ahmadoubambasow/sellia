<section>

{{-- En-tête --}}
<header>
    <h2 class="text-lg font-semibold text-slate-900">
        Modifier le mot de passe
    </h2>

    <p class="mt-1 text-sm text-slate-500">
        Utilisez un mot de passe long et difficile à deviner
        pour renforcer la sécurité de votre compte.
    </p>
</header>

{{-- Formulaire --}}
<form
    method="post"
    action="{{ route('password.update') }}"
    class="mt-6 space-y-6"
>
    @csrf
    @method('put')

    {{-- Mot de passe actuel --}}
    <div>
        <x-input-label
            for="update_password_current_password"
            :value="__('Mot de passe actuel')"
            class="text-slate-700"
        />

        <x-text-input
            id="update_password_current_password"
            name="current_password"
            type="password"
            class="mt-1 block w-full rounded-lg border-slate-300
                   focus:border-sellia-500 focus:ring-sellia-500"
            autocomplete="current-password"
        />

        <x-input-error
            :messages="$errors->updatePassword->get('current_password')"
            class="mt-2"
        />
    </div>

    {{-- Nouveau mot de passe --}}
    <div>
        <x-input-label
            for="update_password_password"
            :value="__('Nouveau mot de passe')"
            class="text-slate-700"
        />

        <x-text-input
            id="update_password_password"
            name="password"
            type="password"
            class="mt-1 block w-full rounded-lg border-slate-300
                   focus:border-sellia-500 focus:ring-sellia-500"
            autocomplete="new-password"
        />

        <x-input-error
            :messages="$errors->updatePassword->get('password')"
            class="mt-2"
        />
    </div>

    {{-- Confirmation --}}
    <div>
        <x-input-label
            for="update_password_password_confirmation"
            :value="__('Confirmer le nouveau mot de passe')"
            class="text-slate-700"
        />

        <x-text-input
            id="update_password_password_confirmation"
            name="password_confirmation"
            type="password"
            class="mt-1 block w-full rounded-lg border-slate-300
                   focus:border-sellia-500 focus:ring-sellia-500"
            autocomplete="new-password"
        />

        <x-input-error
            :messages="$errors->updatePassword->get('password_confirmation')"
            class="mt-2"
        />
    </div>

    {{-- Actions --}}
    <div class="flex items-center gap-4">

        <x-primary-button
            class="rounded-lg bg-sellia-700 px-5 py-2.5
                   font-semibold text-white shadow-sm transition
                   hover:bg-sellia-800
                   focus:bg-sellia-800
                   active:bg-sellia-900
                   focus:ring-2 focus:ring-sellia-500
                   focus:ring-offset-2"
        >
            Enregistrer
        </x-primary-button>

        {{-- Confirmation --}}
        @if (session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm font-medium text-emerald-600"
            >
                Mot de passe mis à jour.
            </p>
        @endif

    </div>

</form>

</section>

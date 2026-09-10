<section>

    {{-- En-tête --}}
    <header>
        <h2 class="text-lg font-semibold text-slate-900">
            Informations du profil
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Modifiez les informations de votre compte et votre adresse e-mail.
        </p>
    </header>

    {{-- Formulaire de renvoi de vérification --}}
    <form
        id="send-verification"
        method="post"
        action="{{ route('verification.send') }}"
    >
        @csrf
    </form>

    {{-- Formulaire principal --}}
    <form
        method="post"
        action="{{ route('profile.update') }}"
        class="mt-6 space-y-6"
    >
        @csrf
        @method('patch')

        {{-- Nom --}}
        <div>
            <x-input-label
                for="name"
                :value="__('Nom')"
                class="text-slate-700"
            />

            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full rounded-lg border-slate-300
                    focus:border-sellia-500 focus:ring-sellia-500"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('name')"
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
                name="email"
                type="email"
                class="mt-1 block w-full rounded-lg border-slate-300
                    focus:border-sellia-500 focus:ring-sellia-500"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('email')"
            />

            {{-- Vérification de l'e-mail --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

                <div class="mt-3 rounded-lg border border-amber-200 bg-amber-50 p-4">

                    <p class="text-sm text-amber-800">
                        Votre adresse e-mail n'est pas encore vérifiée.
                    </p>

                    <button
                        form="send-verification"
                        class="mt-2 text-sm font-medium text-sellia-700
                            underline transition hover:text-sellia-800
                            focus:outline-none focus:ring-2
                            focus:ring-sellia-500 focus:ring-offset-2"
                    >
                        Renvoyer l'e-mail de vérification
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-emerald-600">
                            Un nouveau lien de vérification a été envoyé
                            à votre adresse e-mail.
                        </p>
                    @endif

                </div>

            @endif
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

            {{-- Confirmation de sauvegarde --}}
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-medium text-emerald-600"
                >
                    Modifications enregistrées.
                </p>
            @endif

        </div>

    </form>

</section>

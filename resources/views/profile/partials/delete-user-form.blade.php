<section class="space-y-6">

    {{-- En-tête --}}
    <header>
        <h2 class="text-lg font-semibold text-slate-900">
            Supprimer le compte
        </h2>

        <p class="mt-1 text-sm leading-6 text-slate-500">
            Une fois votre compte supprimé, toutes vos données et ressources
            seront définitivement supprimées. Avant de continuer, assurez-vous
            d'avoir sauvegardé les informations que vous souhaitez conserver.
        </p>
    </header>

    {{-- Bouton de suppression --}}
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="rounded-lg"
    >
        Supprimer mon compte
    </x-danger-button>

    {{-- Modal de confirmation --}}
    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable
    >
        <form
            method="post"
            action="{{ route('profile.destroy') }}"
            class="p-6"
        >
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-slate-900">
                Confirmer la suppression du compte
            </h2>

            <p class="mt-2 text-sm leading-6 text-slate-500">
                Êtes-vous certain de vouloir supprimer votre compte ?
                Cette action est définitive et toutes vos données seront
                supprimées. Saisissez votre mot de passe pour confirmer.
            </p>

            {{-- Mot de passe --}}
            <div class="mt-6">
                <x-input-label
                    for="password"
                    value="{{ __('Mot de passe') }}"
                    class="sr-only"
                />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full rounded-lg border-slate-300
                        focus:border-red-500 focus:ring-red-500"
                    placeholder="Mot de passe"
                />

                <x-input-error
                    :messages="$errors->userDeletion->get('password')"
                    class="mt-2"
                />
            </div>

            {{-- Actions --}}
            <div class="mt-6 flex justify-end">

                <x-secondary-button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="rounded-lg"
                >
                    Annuler
                </x-secondary-button>

                <x-danger-button class="ms-3 rounded-lg">
                    Supprimer définitivement
                </x-danger-button>

            </div>

        </form>
    </x-modal>

</section>

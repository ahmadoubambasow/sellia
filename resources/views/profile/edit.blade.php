<x-app-layout>

    {{-- En-tête --}}
    <x-slot name="header">
        <div>
            <p class="text-sm font-medium text-sellia-700">
                Votre compte
            </p>

            <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                Mon profil
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Gérez vos informations personnelles et la sécurité de votre compte.
            </p>
        </div>
    </x-slot>

    {{-- Contenu --}}
    <div class="min-h-screen bg-slate-50 py-10 sm:py-12">

        <div class="mx-auto max-w-5xl space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Informations du profil --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="p-6 sm:p-8">

                    <div class="max-w-2xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>

                </div>
            </div>

            {{-- Mot de passe --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="p-6 sm:p-8">

                    <div class="max-w-2xl">
                        @include('profile.partials.update-password-form')
                    </div>

                </div>
            </div>

            {{-- Suppression du compte --}}
            <div class="overflow-hidden rounded-2xl border border-red-100 bg-white shadow-sm">
                <div class="p-6 sm:p-8">

                    <div class="max-w-2xl">
                        @include('profile.partials.delete-user-form')
                    </div>

                </div>
            </div>

        </div>

    </div>

</x-app-layout>

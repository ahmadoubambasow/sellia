@props([
    'customer' => null,
])

<div class="space-y-6">

    {{-- Informations principales --}}
    <div>
        <h3 class="text-base font-semibold text-slate-900">
            Informations du client
        </h3>

        <p class="mt-1 text-sm text-slate-500">
            Les informations essentielles pour identifier et contacter votre client.
        </p>
    </div>

    <div class="grid gap-6 sm:grid-cols-2">

        {{-- Nom --}}
        <div class="sm:col-span-2">
            <x-input-label for="name" value="Nom complet *" />

            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full"
                :value="old('name', $customer?->name)"
                required
                autofocus
                placeholder="Ex. Amadou Diop"
            />

            <x-input-error
                :messages="$errors->get('name')"
                class="mt-2"
            />
        </div>

        {{-- Téléphone --}}
        <div>
            <x-input-label for="phone" value="Téléphone" />

            <x-text-input
                id="phone"
                name="phone"
                type="text"
                class="mt-1 block w-full"
                :value="old('phone', $customer?->phone)"
                placeholder="Ex. 77 123 45 67"
            />

            <x-input-error
                :messages="$errors->get('phone')"
                class="mt-2"
            />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" value="Adresse e-mail" />

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                :value="old('email', $customer?->email)"
                placeholder="client@example.com"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />
        </div>

        {{-- Adresse --}}
        <div class="sm:col-span-2">
            <x-input-label for="address" value="Adresse" />

            <x-text-input
                id="address"
                name="address"
                type="text"
                class="mt-1 block w-full"
                :value="old('address', $customer?->address)"
                placeholder="Ex. Thiès, Sénégal"
            />

            <x-input-error
                :messages="$errors->get('address')"
                class="mt-2"
            />
        </div>

        {{-- Notes --}}
        <div class="sm:col-span-2">
            <x-input-label for="notes" value="Notes" />

            <textarea
                id="notes"
                name="notes"
                rows="4"
                class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sellia-500 focus:ring-sellia-500"
                placeholder="Informations complémentaires sur ce client..."
            >{{ old('notes', $customer?->notes) }}</textarea>

            <x-input-error
                :messages="$errors->get('notes')"
                class="mt-2"
            />
        </div>

    </div>

</div>
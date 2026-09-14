<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center gap-4">

            <a
                href="{{ route('sales.show', $sale) }}"
                class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:bg-slate-50 hover:text-slate-700"
            >
                <svg
                    class="h-5 w-5"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>
            </a>

            <div>
                <h2 class="text-xl font-bold text-slate-900">
                    Enregistrer un paiement
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Vente {{ $sale->reference }}
                </p>
            </div>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">

            {{-- Résumé --}}
            <div class="mb-6 grid gap-4 sm:grid-cols-3">

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Total
                    </p>

                    <p class="mt-2 text-xl font-bold text-slate-900">
                        {{ number_format($sale->total, 0, ',', ' ') }}
                        FCFA
                    </p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Déjà payé
                    </p>

                    <p class="mt-2 text-xl font-bold text-emerald-600">
                        {{ number_format($sale->amount_paid, 0, ',', ' ') }}
                        FCFA
                    </p>
                </div>

                <div class="rounded-2xl border border-sellia-100 bg-sellia-50 p-5 shadow-sm">
                    <p class="text-xs font-medium uppercase tracking-wide text-sellia-600">
                        Reste à payer
                    </p>

                    <p class="mt-2 text-xl font-bold text-sellia-700">
                        {{ number_format($sale->total - $sale->amount_paid, 0, ',', ' ') }}
                        FCFA
                    </p>
                </div>

            </div>


            {{-- Formulaire --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">

                <div class="mb-6">

                    <h3 class="text-lg font-bold text-slate-900">
                        Nouveau paiement
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Enregistrez le montant reçu du client.
                    </p>

                </div>


                <x-flash-message />


                <form
                    method="POST"
                    action="{{ route('sales.payments.store', $sale) }}"
                    class="space-y-6"
                >
                    @csrf

                    {{-- Montant --}}
                    <div>

                        <x-input-label
                            for="amount"
                            value="Montant payé"
                            class="mb-1.5 text-sm font-semibold text-slate-700"
                        />

                        <div class="relative">

                            <x-text-input
                                id="amount"
                                name="amount"
                                type="number"
                                step="0.01"
                                min="0.01"
                                max="{{ $sale->total - $sale->amount_paid }}"
                                value="{{ old('amount', $sale->total - $sale->amount_paid) }}"
                                class="block w-full rounded-xl border-slate-300 py-3 pr-20 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500/20"
                                required
                                autofocus
                            />

                            <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-sm font-medium text-slate-400">
                                FCFA
                            </span>

                        </div>

                        <x-input-error
                            :messages="$errors->get('amount')"
                            class="mt-2"
                        />

                    </div>


                    {{-- Mode de paiement --}}
                    <div>

                        <x-input-label
                            for="payment_method"
                            value="Mode de paiement"
                            class="mb-1.5 text-sm font-semibold text-slate-700"
                        />

                        <select
                            id="payment_method"
                            name="payment_method"
                            class="block w-full rounded-xl border-slate-300 py-3 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500/20"
                            required
                        >
                            <option value="">Sélectionner un mode</option>

                            <option value="cash" @selected(old('payment_method') === 'cash')>
                                Espèces
                            </option>

                            <option value="wave" @selected(old('payment_method') === 'wave')>
                                Wave
                            </option>

                            <option value="orange_money" @selected(old('payment_method') === 'orange_money')>
                                Orange Money
                            </option>

                            <option value="card" @selected(old('payment_method') === 'card')>
                                Carte bancaire
                            </option>

                            <option value="other" @selected(old('payment_method') === 'other')>
                                Autre
                            </option>
                        </select>

                        <x-input-error
                            :messages="$errors->get('payment_method')"
                            class="mt-2"
                        />

                    </div>


                    {{-- Date --}}
                    <div>

                        <x-input-label
                            for="paid_at"
                            value="Date du paiement"
                            class="mb-1.5 text-sm font-semibold text-slate-700"
                        />

                        <x-text-input
                            id="paid_at"
                            name="paid_at"
                            type="datetime-local"
                            value="{{ old('paid_at', now()->format('Y-m-d\TH:i')) }}"
                            class="block w-full rounded-xl border-slate-300 py-3 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500/20"
                        />

                        <x-input-error
                            :messages="$errors->get('paid_at')"
                            class="mt-2"
                        />

                    </div>


                    {{-- Notes --}}
                    <div>

                        <x-input-label
                            for="notes"
                            value="Notes"
                            class="mb-1.5 text-sm font-semibold text-slate-700"
                        />

                        <textarea
                            id="notes"
                            name="notes"
                            rows="3"
                            class="block w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-sellia-500 focus:ring-sellia-500/20"
                            placeholder="Informations complémentaires..."
                        >{{ old('notes') }}</textarea>

                        <x-input-error
                            :messages="$errors->get('notes')"
                            class="mt-2"
                        />

                    </div>


                    {{-- Actions --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:justify-end">

                        <a
                            href="{{ route('sales.show', $sale) }}"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                        >
                            Annuler
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-sellia-700 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-sellia-700/20 transition hover:bg-sellia-800 focus:outline-none focus:ring-2 focus:ring-sellia-500 focus:ring-offset-2"
                        >
                            Enregistrer le paiement

                            <svg
                                class="h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 12h14m-6-6l6 6-6 6"
                                />
                            </svg>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
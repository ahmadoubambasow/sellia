<x-app-layout>

    <x-slot name="header">
        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500">
                <a
                    href="{{ route('customers.index') }}"
                    class="transition hover:text-sellia-700"
                >
                    Clients
                </a>

                <span>/</span>

                <span>Modifier</span>
            </div>

            <h2 class="mt-2 text-xl font-semibold tracking-tight text-slate-900">
                Modifier le client
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Mettez à jour les informations de {{ $customer->name }}.
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

            <form
                method="POST"
                action="{{ route('customers.update', $customer) }}"
            >
                @csrf
                @method('PUT')

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="p-6 sm:p-8">
                        <x-customers.form :customer="$customer" />
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 bg-slate-50 px-6 py-4 sm:flex-row sm:items-center sm:justify-end sm:px-8">

                        <a
                            href="{{ route('customers.index') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                        >
                            Annuler
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-sellia-700 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-sellia-800 focus:outline-none focus:ring-2 focus:ring-sellia-500 focus:ring-offset-2"
                        >
                            Enregistrer les modifications
                        </button>

                    </div>

                </div>
            </form>

        </div>
    </div>

</x-app-layout>
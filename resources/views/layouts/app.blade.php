<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SELLIA') }}</title>

        <meta
            name="description"
            content="{{ config('app.description', 'Solution simple et moderne de gestion commerciale') }}"
        >

        {{-- =========================================================
            TAILWIND CSS CDN
        ========================================================== --}}
        <script src="https://cdn.tailwindcss.com"></script>

        {{-- Configuration Tailwind --}}
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            sellia: {
                                50: '#eff6ff',
                                100: '#dbeafe',
                                500: '#2563EB',
                                600: '#1D4ED8',
                                700: '#1E3A8A',
                                800: '#1E40AF',
                            },

                            accent: {
                                500: '#14B8A6',
                                600: '#0D9488',
                            },
                        },
                    },
                },
            }
        </script>

        {{-- =========================================================
            CHART.JS
        ========================================================== --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        {{-- Styles supplémentaires --}}
        @stack('styles')

        <style>
            [x-cloak] {
                display: none !important;
            }

            @keyframes shrink {
                from {
                    transform: scaleX(1);
                }

                to {
                    transform: scaleX(0);
                }
            }
        </style>

    </head>

<body class="min-h-screen bg-slate-50 font-sans text-slate-900 antialiased">

    {{-- =========================================================
        MESSAGES FLASH
    ========================================================== --}}
    <x-flash-message />


    {{-- =========================================================
        NAVIGATION
    ========================================================== --}}
    @include('layouts.navigation')


    {{-- =========================================================
        CONTENU PRINCIPAL
        La sidebar desktop occupe 16rem.
        La topbar desktop commence après la sidebar.
    ========================================================== --}}
    <div class="min-h-screen pt-16 lg:pl-64 lg:pt-20">

        {{-- -----------------------------------------------------
            CONTENU SOUS LA TOPBAR
        ------------------------------------------------------ --}}
        <div class="lg:pt-20">

            {{-- Header de page --}}
            @isset($header)
                <header class="border-b border-slate-200 bg-white">

                    <div class="mx-auto max-w-[1600px] px-4 py-6 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>

                </header>
            @endisset


            {{-- -------------------------------------------------
                CONTENU
            -------------------------------------------------- --}}
            <main>

                <div class="mx-auto max-w-[1600px] px-4 py-6 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>

            </main>

        </div>

    </div>


    {{-- =========================================================
        ALPINE JS
    ========================================================== --}}
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>


    {{-- =========================================================
        SCRIPTS DES COMPOSANTS / PAGES
    ========================================================== --}}
    @stack('scripts')

    </body>

</html>

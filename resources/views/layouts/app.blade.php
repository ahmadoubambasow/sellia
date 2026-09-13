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

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
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

    <x-flash-message />
    
    <div class="min-h-screen">
        @include('layouts.navigation')

        @isset($header)
            <header class="border-b border-slate-200 bg-white">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>

</html>